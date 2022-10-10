<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Http\Resources\Post  as ResourcesPost;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Database\Eloquent\SoftDeletes;

class PostController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        //
        $post=Post::all();
        return $this->sendResponse(ResourcesPost::collection( $post),
            'All Post sent');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        //
        $input = $request->all();
        $validator = Validator::make($input , [
//
//            'id' => 'required',
//            'user_id'=> 'required',
            'title'=> 'required',
            'content'=> 'required',
            'photo'=> 'required',
//            'slug'=> 'required',
//            'deleted_at'=> $this->deleted_at,
//            'created_at'=> $this->created_at,
//            'updated_at'=> $this->updated_at,
        ]  );

        if ($validator->fails()) {
            return $this->sendError('Please validate error' ,$validator->errors() );
        }
        $user=Auth::user();
//        $product = Post::create($input);
        $product = Post::create([
            'user_id' =>$user->id,
            'title'=> $request->title,
            'content'=> $request->content,
            'photo'=> $request->photo,
            'slug'=>str_slug($request->title)

        ]);

        return $this->sendResponse(new ResourcesPost($product) ,'Post created successfully' );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        //
        $post= Post::find($id);
        if ( is_null($post) ) {
            return $this->sendError('Product not found'  );
        }
        return $this->sendResponse(new ResourcesPost($post) ,'Post found successfully' );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, Post $post)
    {
        //
        $input = $request->all();
        $validator = Validator::make($input , [
//            'name'=> 'required',
//            'id' => 'required',
//            'user_id'=> 'required',
            'title'=> 'required',
            'content'=> 'required',
            'photo'=> 'required',
//            'slug'=> 'required',
//            'deleted_at'=> $this->deleted_at,
//            'created_at'=> $this->created_at,
//            'updated_at'=> $this->updated_at,
        ]  );

        if ($validator->fails()) {
            return $this->sendError('Please validate error' ,$validator->errors() );
        }
//        $post->name = $input['name'];
        $user = Auth::user();
//        $post->id = $input['id'];
//        $post->id = $user->id;
//        $post->user_id = $input['user_id'];
        $post->user_id = $user->id;
        $post->title = $input['title'];
        $post->content = $input['content'];
        $post->photo = $input['photo'];
//        $post->slug = $input['slug'];
        $post->slug= str_slug($request->title);
//        $post->deleted_at = $input['deleted_at'];
//        $post->created_at = $input['created_at'];
//        $post->updated_at = $input['updated_at'];

        $post->save();
        return $this->sendResponse(new ResourcesPost($post) ,'Post updated successfully' );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Post $post)
    {
        //
        $post->delete();
        return $this->sendResponse(new ResourcesPost($post) ,'Post deleted successfully' );
    }
}
