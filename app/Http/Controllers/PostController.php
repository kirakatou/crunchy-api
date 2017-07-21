<?php

namespace App\Http\Controllers;

use Auth;
use Storage;
use App\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::paginate();
        return $posts;
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
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'image' => 'image|required',
            'taste' => 'numeric|required',
            'price' => 'numeric|required',
            'service' => 'numeric|required',
        ]);
        if($request->hasFile('image')){
            if($request->image->isValid()){
                $path = $request->image->store('public/post/' . Auth::user()->id);
                $post = new Post();
                $post->user()->associate(Auth::user()->id);
                $post->merchant()->associate($request->merchant_id);
                $post->path = $path;
                $post->description = $request->description;
                $post->taste = $request->taste;
                $post->price = $request->price;
                $post->service = $request->service;
                $post->save();
                return $post;
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
