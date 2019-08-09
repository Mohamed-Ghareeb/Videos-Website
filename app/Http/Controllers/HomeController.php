<?php

namespace App\Http\Controllers;

use App\Models\Video;
use App\Models\Category;
use App\Models\Skill;
use App\Models\Tag;
use App\Models\User;
use App\Models\Page;
use App\Models\Comments;
use App\Models\Messages;
use App\Http\Requests\FrontEnd\Messages\Store as MessageStore;
use App\Http\Requests\FrontEnd\Users\Store;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only([
           'commentUpdate', 'commentStore' , 'updateProfile'
        ]);
    }

    public function index()
    {
        $videos = Video::orderBy('id', 'desc');
        if (request()->has('search') && request()->get('search') != '') {
            $videos = $videos->where('name', 'like', '%' . request()->get('search') . '%');
        }       
        $videos = $videos->paginate(30);
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
        $videos         = Video::orderBy('id', 'desc')->paginate(9);
        $videos_count   = Video::count();
        $comments_count = Comments::count();
        $tags_count     = Tag::count();
        return view('welcome',  compact('videos', 'videos_count', 'comments_count', 'tags_count'));
    }

    public function page($id, $slug = null)
    {
        $page = Page::findOrfail($id);
        return view('front-end.page.index', compact('page'));
    }

    public function profile($id, $slug = null)
    {
        $user = User::findOrfail($id);
        return view('front-end.profile.index', compact('user'));
    }
   
    public function updateProfile(Store $request)
    {
        $user  = User::findOrfail(auth()->user()->id);
        $array = [];

        if ($request->email != $user->email) {
            $email = User::where('email', $request->email)->first();
            if ($email == null) {
                $array['email'] = $request->email;
            }
        }

        if ($request->name != $user->name) {
            $array['name'] = $request->name;
        }
      
        if ($request->password != '') {
            $array['password'] = Hash::make($request->password);
        }

        if (!empty($array)) {
            $user->update($array);
        }

        return redirect()->route('front.profile', ['id' => $user->id, 'slug' => slug($user->name)]);
    }
}
