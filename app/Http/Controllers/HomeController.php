<?php

namespace App\Http\Controllers;

use App\Models\Video;
use App\Models\Category;
use App\Models\Skill;
use App\Models\Tag;
use App\Http\Requests\FrontEnd\Comments\Store;
use App\Models\Comments;
use App\Http\Requests\FrontEnd\Messages\Store as MessageStore;
use App\Models\Messages;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->only([
           'commentUpdate', 'commentStore'
        ]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $videos = Video::orderBy('id', 'desc')->paginate(30);
        return view('home', compact('videos'));
    }

    public function category($id)
    {
        $cat    = Category::findOrfail($id);
        $videos = Video::where('cat_id', $id)->orderBy('id', 'desc')->paginate(30);
        return view('front-end.category.index', compact('videos', 'cat'));
    }

    public function video($id)
    {
        $video    = Video::with('cat', 'skills', 'tags', 'user', 'comments.user')->findOrfail($id);
        return view('front-end.video.index', compact('video'));
    }
    
    public function skills($id)
    {
        $skill    = Skill::findOrfail($id);
        $videos   = Video::whereHas('skills', function($query) use ($id) {
            $query->where('skill_id', $id);
        })->orderBy('id', 'desc')->paginate(30);
        return view('front-end.skill.index', compact('videos', 'skill'));
    }
   
    public function tags($id)
    {
        $tag      = Tag::findOrfail($id);
        $videos   = Video::whereHas('tags', function($query) use ($id) {
            $query->where('tag_id', $id);
        })->orderBy('id', 'desc')->paginate(30);
        return view('front-end.tag.index', compact('videos', 'tag'));
    }

    public function commentUpdate($id, Store $request)
    {
        $comment = Comments::findOrfail($id);
        if ((auth()->user()->id == $comment->user_id) || auth()->user()->group == 'admin') {
            $comment->update(['comment' => $request->comment]);
        }
        return redirect()->route('front.video', ['id' => $comment->video_id, '#comments']);
    }
   
    public function commentStore($id, Store $request)
    {
        $video = Video::findOrfail($id);
        Comments::create([
            'user_id'  => auth()->user()->id,
            'video_id' => $video->id,
            'comment'  => $request->comment,
        ]);
        return redirect()->route('front.video', ['id' => $video->id, '#comments']);
    }
  
    public function messageStore(MessageStore $request)
    {
        Messages::create($request->all());
        return redirect()->route('frontend.landing');
    }

    public function welcome()
    {
        $videos = Video::orderBy('id', 'desc')->paginate(9);
        return view('welcome',  compact('videos'));
    }
}
