<?php


namespace App\Http\Controllers\BloodTransferCenter;

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Donor\DonorController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\Posts\CampaignController;
use App\Http\Controllers\Posts\CommentController;
use App\Http\Controllers\Posts\PostController;
use App\Http\Controllers\Posts\RequestController;

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\BloodTransferCenter\BloodCenterController;
use App\Http\Controllers\BloodTransferCenter\BloodDonationController;
use App\Http\Controllers\BloodTransferCenter\BloodRequestController;
use App\Http\Controllers\Donor\DonorController;
use App\Http\Controllers\DonorsControllers;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\Posts\CampaignController;
use App\Http\Controllers\Posts\CommentController;
use App\Http\Controllers\Posts\PostController;
use App\Http\Controllers\Posts\RequestController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UploadController;
use App\Models\BloodRequest;
use App\Models\Client;
use App\Models\Donor;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


//Route::get('/', function () {
//    return view('welcome');
//});
Route::get('/', function () {
    return view('home');
})->name('home');
Route::get('/categories', function () {
    return view('categories');
})->name('categories');

Route::get('/blogs', function () {
    return view('blog');
})->name('blog');

Route::get('/blogs/page1', function () {
    return view('blog-page1');
})->name('blog1');

Route::get('/blogs/page2', function () {
    return view('blog-page2');
})->name('blog2');

Route::get('/blogs/page3', function () {
    return view('blog-page3');
})->name('blog3');

Route::get('/certificate', function () {
    return view('certification');
})->name('certificate');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile/{user_id}', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/profile', [ProfileController::class, 'updatePassword'])->name('update-password');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/profile/image', [ProfileController::class, 'imageChange'])->name('profile.change');
    Route::post('/upload', [UploadController::class, 'store'])->name('upload');
    Route::post('posts/{post}/comments/create', [CommentController::class, 'store'])->name('comment.make');
    Route::post('posts/comments/{comment}/reply', [CommentController::class, 'reply'])->name('comment.reply');
    Route::delete('posts/comments/{comment}', [CommentController::class, 'destroy'])->name('comment.destroy');
    Route::post('posts/{post}/like', [PostController::class, 'like'])->name('post.like');
    Route::post('posts/{post}/unlike', [PostController::class, 'unlike'])->name('post.unlike');
    Route::post('posts/{post}/save', [PostController::class, 'save'])->name('post.save');
    Route::post('posts/{post}/unsave', [PostController::class, 'unsave'])->name('post.unsave');
//Notifications
    Route::get('/Notifications', [NotificationController::class, 'index'])->name('notifications');
    Route::post('/mark-as-read', [NotificationController::class, 'markNotification'])->name('markNotification');


});

//blood Transfer Centers Routes
Route::middleware(['auth', 'role:center'])->group(function () {
    Route::resource('/centers/bloodRequest', \App\Http\Controllers\BloodTransferCenter\BloodRequestController::class)->only(['destroy']);;
    Route::resource('/centers/bloodDonation', \App\Http\Controllers\BloodTransferCenter\BloodDonationController::class)->only(['destroy']);;
    Route::get('/centers/bloodStock', [\App\Http\Controllers\BloodTransferCenter\BloodStockController::class, 'bloodStock'])->name('bloodStock');
    Route::get('/clients', function () {
        $search = request('q');
        return Client::where('name', 'like', '%' . $search . '%')->get();
    });
    Route::get('/donors', function () {
        $search = request('q');
        $donors = \App\Models\Donor::whereHas('user', function ($query) use ($search) {
            $query->where('name', 'like', '%' . $search . '%');
        })->get();
        return $donors->map(function ($donor) {
            return ['id' => $donor->id, 'name' => $donor->user->name];
        });
    });

    Route::post('centers/donations/logNew', [BloodDonationController::class, 'StoreNew'])->name('donations.storeNew');
    Route::post('centers/donations/logExisting', [BloodDonationController::class, 'StoreExisting'])->name('donations.storeExisting');
    Route::post('centers/requests/logNew', [BloodRequestController::class, 'StoreNew'])->name('requests.storeNew');
    Route::post('centers/requests/logExisting', [BloodRequestController::class, 'StoreExisting'])->name('requests.storeExisting');
    Route::get('posts/campaigns/{campaign}/participants', [CampaignController::class, 'participants'])->name('campaign.participants');

});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::delete('/admin/{center_id}', [AdminController::class, 'destroy']);
    Route::get('/center/create', [BloodCenterController::class, 'create'])->name('create-center');
    Route::post('/center/creation', [BloodCenterController::class, 'store']);
    Route::delete('/admin/{center_id}', [AdminController::class, 'destroy']);
    Route::get('/admin/create_center', [BloodCenterController::class, 'create'])->name('create-center');
    Route::post('/admin/center_creation', [BloodCenterController::class, 'store']);
    Route::get('/admin/create_donor', [DonorsControllers::class, 'create']);
    Route::post('/admin/donor_creation', [DonorsControllers::class, 'store']);
});

Route::get('/test', function () {
    return view('posts.Campaigns.show');
});

Route::get('/donors/{donor}', function (Donor $donor) {
    return $donor;
});

Route::middleware(['auth', 'role:donor'])->group(function () {
    Route::post('posts/campaigns/{campaign}/join', [CampaignController::class, 'join'])->name('campaign.join');
    Route::post('posts/campaigns/{campaign}/leave', [CampaignController::class, 'leave'])->name('campaign.leave');
    Route::get('/donors/donations/history', [DonorController::class, 'history'])->name('donor.history');

});

Route::resource('posts/campaigns', CampaignController::class);
Route::resource('posts/requests', RequestController::class);
Route::get('posts/attachments/{attachment}', [UploadController::class, 'download'])->name('download');
Route::delete('posts/attachments/{attachment}', [UploadController::class, 'destroyAttachment'])->name('attachment.destroy');


require __DIR__ . '/auth.php';
