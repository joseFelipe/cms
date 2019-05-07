<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\Posts\CreatePostsRequest;
use App\Post;
use Illuminate\Support\Facades\Storage;

class PostsController extends Controller
{
    public function index()
    {
        return view('posts.index')->with('posts', Post::all());
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(CreatePostsRequest $request)
    {
        $image = $request->image->store('posts');

        Post::create([
            'title' => $request->title,
            'description' => $request->description,
            'content' => $request->content,
            'image' => $image,
            'published_at' => $request->published_at
        ]);

        session()->flash('success', 'Post created successfully');
        return redirect(route('posts.index'));
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        
    }

    public function destroy($id)
    {
        $post = Post::withTrashed()->where('id', $id)->firstOrFail();
        
        if($post->trashed()) {
            $post->forceDelete();
            Storage::delete($post->image);
        } else {
            $post->delete();
        }

        session()->flash('success', 'Post deleted successfully');
        return redirect(route('posts.index'));
    }

    public function trashed() 
    {
        $trashed = Post::withTrashed()->get();

        return view('posts.index')->with('posts', $trashed);
    }
}
