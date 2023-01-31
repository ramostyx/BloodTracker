<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Address;
use App\Models\TemporaryFile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\View\View
     */
    public function edit(Request $request)
    {

        $rol = $request->user()->role;

        if ($rol == "center") {
            return view('profile.center-profile', [
                'user' => $request->user(),
            ]);
        } else {
            return view('profile.doner-profil', [
                'user' => $request->user(),
            ]);
        }

    }

    /**
     * Update the user's profile information.
     *
     * @param \App\Http\Requests\ProfileUpdateRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ProfileUpdateRequest $request, $user_id)
    {
        $request->user()->fill($request->validated());
        //$request->user()->Address->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();
        // Update the address information
        $address = Address::where('addressable_id', $user_id)->first();
        $address->street = $request->input('street');
        $address->city = $request->input('city');
        $address->country = $request->input('country');
        $address->province = $request->input('province');
        $address->zipCode = $request->input('zipCode');
        $address->save();


        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current-password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }


    public function updatePassword(Request $request)
    {
        # Validation
        $request->validate([
            'current_password' => 'required|min:6|max:100',
            'new_password' => 'required|min:6|max:100',
            'new_password_confirmation' => 'required|same:new_password',
        ]);

        $user = auth()->user();
        if (Hash::check($request->current_password, $user->password)) {

            $user->update([
                'password' => bcrypt($request->new_password)
            ]);
            return redirect()->back()->with('success', 'Password updated');
        } else {
            return redirect()->back()->with('error', 'Old password does not matched');
        }
    }

    public function imageChange(Request $request)
    {
        if ($request->profile) {
            $folder = $request->profile;
            $tempFile = TemporaryFile::where('folder', $folder)->first();
            mkdir('storage/profile/photos/' . $tempFile->folder);
            File::move('storage/profiles/tmp/' . $tempFile->folder . '/' . $tempFile->filename, 'storage/profile/photos/' . $tempFile->folder . '/' . $tempFile->filename);
            rmdir('storage/profiles/tmp/' . $tempFile->folder);
            Auth::user()->update(['profileImage' => asset('storage/profile/photos/' . $tempFile->folder . '/' . $tempFile->filename)]);
            $tempFile->delete();
        }
        return back();
    }
}
