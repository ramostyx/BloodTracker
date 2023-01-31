<?php

namespace App\Http\Controllers;

use App\Models\Attachment;
use App\Models\TemporaryFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UploadController extends Controller
{
    public function store(Request $request){


        if($request->hasFile('attachment'))
        {
            $folder = uniqid().'_'.now()->timestamp;
            foreach($request->file('attachment') as $file)
            {
                $filename=$file->getClientOriginalName();
                $path='attachments/tmp/'.$folder;
                $file->storeAs($path,$filename);
                TemporaryFile::create(['folder'=>$folder,'filename'=>$filename,'type'=>$file->getClientOriginalExtension()]);
            }
            return $folder;
        }elseif ($request->hasFile('thumbnail')){
            $folder = uniqid().'-'.now()->timestamp;
            $file=$request->file('thumbnail');
            $filename=$file->getClientOriginalName();
            $path='attachments/tmp/'.$folder;
            $file->storeAs($path,$filename);
            TemporaryFile::create(['folder'=>$folder,'filename'=>$filename,'type'=>$file->getClientOriginalExtension()]);
            return $folder;
        }elseif ($request->hasFile('profile'))
        {
            $folder = uniqid().'-'.now()->timestamp;
            $file=$request->file('profile');
            $filename=$file->getClientOriginalName();
            $path='profiles/tmp/'.$folder;
            $file->storeAs($path,$filename);
            TemporaryFile::create(['folder'=>$folder,'filename'=>$filename,'type'=>$file->getClientOriginalExtension()]);
            return $folder;
        }
        return '';
    }

    public function destroyAttachment(Attachment $attachment)
    {
        Storage::delete($attachment->path);
        $attachment->delete();
        return back()->with('success','Attachment deleted successfully');
    }

    public function download(Attachment $attachment)
    {
        return Storage::disk('public')->download($attachment->path);
    }
}
