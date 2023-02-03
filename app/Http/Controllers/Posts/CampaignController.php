<?php

namespace App\Http\Controllers\Posts;

use App\Events\JoinCampaignEvent;
use App\Events\LeaveCampaignEvent;
use App\Http\Controllers\Controller;
use App\Models\Attachment;
use App\Models\Campaign;
use App\Models\DonorCampaign;
use App\Models\Post;
use App\Models\TemporaryFile;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

class CampaignController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $campaigns= Campaign::all();
        return view('posts.Campaigns.index',compact('campaigns'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.Campaigns.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'title' => ['required', 'string'],
            'description' => ['required', 'string'],
            'startDate' => ['required'],
            'endDate' => ['required'],
            'location' => ['required', 'string', 'max:20'],
            'attachment' => ['required'],
            'thumbnail' => ['required'],
        ]);

        $post=Post::create([
            'blood_transfer_center_id' =>Auth::user()->bloodtransfercenter->id,
            'title'=>$request->title,
            'body'=>$request->description,
            'thumbnail'=>''
        ]);
        Campaign::create([
            'post_id'=>$post->id,
            'startDate'=>$request->startDate,
            'endDate'=>$request->endDate,
            'location' =>$request->location
        ]);

        foreach ($request->attachment as $file) {
            $tempFile = TemporaryFile::where('folder', $file)->first();
            mkdir('storage/posts/campaigns/attachments/'.$tempFile->folder);
            File::move('storage/attachments/tmp/'.$tempFile->folder.'/'.$tempFile->filename,'storage/posts/campaigns/attachments/' . $tempFile->folder.'/'.$tempFile->filename);
            rmdir('storage/attachments/tmp/'. $tempFile->folder);
            Attachment::create([
                'post_id'=>$post->id,
                'filename' =>$tempFile->filename,
                'type' => $tempFile->type,
                'path' => 'posts/campaigns/attachments/' . $tempFile->folder.'/'.$tempFile->filename,
            ]);
            $tempFile->delete();
        }
        $folder = $request->thumbnail;
        $tempFile = TemporaryFile::where('folder', $folder)->first();
        mkdir('storage/posts//campaigns/thumbnails/'.$tempFile->folder);
        File::move('storage/attachments/tmp/'.$tempFile->folder.'/'.$tempFile->filename,'storage/posts/campaigns/thumbnails/' . $tempFile->folder.'/'.$tempFile->filename);
        rmdir('storage/attachments/tmp/' . $tempFile->folder);
        $post->update(['thumbnail'=>asset('storage/posts/campaigns/thumbnails/' . $tempFile->folder.'/'.$tempFile->filename)]);
        $tempFile->delete();

        return Redirect::route('campaigns.index'); return back();

    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Campaign $campaign
     * @return \Illuminate\Http\Response
     */
    public function show(Campaign $campaign)
    {
        return view('posts.Campaigns.show',compact('campaign'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Campaign $campaign
     * @return \Illuminate\Http\Response
     */
    public function edit(Campaign $campaign)
    {
        return view('posts.Campaigns.edit',compact('campaign'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Campaign $campaign
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Campaign $campaign)
    {
        $request->validate([
            'title' => ['string'],
            'description' => ['string'],
            'startDate' => [],
            'endDate' => [],
            'location' => ['string', 'max:20'],
            'attachment' => [],
            'thumbnail' => [],
        ]);


        $campaign->post->update([
            'title'=>$request->title,
            'body'=>$request->description,
        ]);
        $campaign->update([
            'startDate'=>$request->startDate,
            'endDate'=>$request->endDate,
            'location' =>$request->location
        ]);

        if($request->attachment)
        {
            foreach ($request->attachment as $file) {
                $tempFile = TemporaryFile::where('folder', $file)->first();
                mkdir('storage/posts/campaigns/attachments/'.$tempFile->folder);
                File::move('storage/attachments/tmp/'.$tempFile->folder.'/'.$tempFile->filename,'storage/posts/campaigns/attachments/' . $tempFile->folder.'/'.$tempFile->filename);
                rmdir('storage/attachments/tmp/'. $tempFile->folder);
                Attachment::create([
                    'post_id'=>$campaign->post->id,
                    'filename' =>$tempFile->filename,
                    'type' => $tempFile->type,
                    'path' => 'posts/campaigns/attachments/' . $tempFile->folder.'/'.$tempFile->filename,
                ]);
                $tempFile->delete();
            }
        }

        if($request->thumbnail)
        {
            $folder = $request->thumbnail;
            $tempFile = TemporaryFile::where('folder', $folder)->first();
            mkdir('storage/posts//campaigns/thumbnails/'.$tempFile->folder);
            File::move('storage/attachments/tmp/'.$tempFile->folder.'/'.$tempFile->filename,'storage/posts/campaigns/thumbnails/' . $tempFile->folder.'/'.$tempFile->filename);
            rmdir('storage/attachments/tmp/' . $tempFile->folder);
            $campaign->post->update(['thumbnail'=>asset('storage/posts/campaigns/thumbnails/' . $tempFile->folder.'/'.$tempFile->filename)]);
            $tempFile->delete();
        }


        return Redirect::route('campaigns.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Campaign $campaign
     * @return \Illuminate\Http\Response
     */
    public function destroy(Campaign $campaign)
    {
        $campaign->delete();
        return back();
    }

    public function join(Campaign $campaign)
    {
        DonorCampaign::create([
            'campaign_id'=> $campaign->id,
            'donor_id'=> Auth::user()->donor->id
        ]);
        event(new JoinCampaignEvent(Auth::user()->donor,$campaign));
        return back();
    }
    public function leave(Campaign $campaign)
    {
        DonorCampaign::where('campaign_id',$campaign->id)->where('donor_id',Auth::user()->donor->id)->first()->delete();
        event(new LeaveCampaignEvent(Auth::user()->donor,$campaign));
        return back();
    }
    public function participants(Campaign $campaign)
    {
        $participants=$campaign->donors;
        return view('posts.Campaigns.participants',compact('participants'));
    }
}
