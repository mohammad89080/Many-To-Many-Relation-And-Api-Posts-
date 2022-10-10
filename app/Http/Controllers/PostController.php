<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Tag;
class PostController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     *
     *
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        //
        $posts=Post::orderBy('created_at','DESC')->get();
        return view('posts.index')->with('posts',$posts);
    }
    public function postsTrashed()
    {
        //
        $posts=Post::onlyTrashed()->where('user_id',Auth::id())->get();
        if($posts===null)
        {
            return redirect()->back();
        }

        return view("posts.trashed")->with('posts',$posts);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
     */
    public function create()
    {
        //
        $tags=Tag::all();
        if($tags->count()==0)
        {
            return redirect()->route('post.create');
        }
        return view('posts.create')->with('tags',$tags);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        //
        $this->validate($request,[

         'title'=> 'required',
         'content'=> 'required',
            'tags'=> 'required',
         'photo'=> 'required|image',

        ]);
        $photo=$request->photo;
        $newPhoto=time().$photo->getClientOriginalName();
        $photo->move('uploads/posts',$newPhoto);
        $post=Post::create([
            'user_id'=> Auth::id(),
            'title'=> $request->title,

            'content'=> $request->content,
            'photo'=> 'uploads/posts/'.$newPhoto,
            'slug'=>str_slug($request->title)

        ]);

        $post->tags()->attach($request->tags);
        return  redirect()->back();

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show($slug)
    {
        //
        $post=Post::where('slug',$slug)->first();
//        dd($post->all());
        return view('posts.show')->with('post',$post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
     */
    public function edit($id)
    {
        $tags=Tag::all();
        $post=Post::where('id',$id)->where('user_id',Auth::id())->first();
        if($post===null)
        {
            return redirect()->back();
        }


        return view('posts.edit')->with('post',$post)->with('tags',$tags);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request,$id)
    {
        $this->validate($request,[

            'title'=> 'required',
            'content'=> 'required',
//            'photo'=> 'required|image',

        ]);
//        dd($request->all());
        //
        $post=Post::find($id);
        if ($request->has('photo'))
        {
            $photo=$request->photo;
            $newPhoto=time().$photo->getClientOriginalName();
            $photo->move('uploads/posts',$newPhoto);
            $post->photo='uploads/posts/'.$newPhoto;

            $post->save();
        }
        $post->title=$request->title;
        $post->content=$request->content;
        $post->save();
        $post->tags()->sync($request->tags);

        return redirect()->back();

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        //
        $post=Post::where('id',$id)->where('user_id',Auth::id())->first();
        if($post===null)
        {
            return redirect()->back();
        }
        $post->delete();
        return redirect()->back();
    }
    public function hdelete($id)
    {
        //
        $post=Post::withTrashed($id)->where('id',$id)->first();
        $post->forceDelete();
        return redirect()->back();
    }
    public function restore($id)
    {
        //
        $post=Post::withTrashed($id)->where('id',$id)->first();
        $post->restore();
        return redirect()->back();
    }
}
