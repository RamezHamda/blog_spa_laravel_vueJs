<?php

namespace App\Http\Controllers\API;

use App\Models\Post;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;

class PostController extends Controller
{
    public function index()
    {
        return PostResource::collection(Post::latest()->get());
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'file' => 'required | image',
            'body' => 'required',
            'category_id' => 'required'
        ]);

        $title = $request->title;
        $category_id = $request->category_id;

        if (!Post::count()) {
            $postId = 1;
        } else {
            $postId = Post::latest()->first()->id + 1;
        }

        $slug = Str::slug($title, '-') . '-' . $postId;
        $user_id = auth()->user()->id;
        $body = $request->input('body');
        $imagePath = 'storage/' . $request->file('file')->store('postsImages', 'public');

        // create and save post
        Post::create([
            'title' => $title,
            'category_id' => $category_id,
            'slug' => $slug,
            'user_id' => $user_id,
            'body' => $body,
            'imagePath' => $imagePath
        ]);
    }

    public function show(Post $post)
    {
        // return PostResource::collection(Post::where('slug', $post->slug)->get());
        return new PostResource($post);
    }

    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title' => 'required',
            'body' => 'required',
            'category_id' => 'required',
            'file' => 'image|required'
        ]);

        $title = $request->title;
        $category_id = $request->category_id;

        if (!Post::count()) {
            $postId = 1;
        } else {
            $postId = Post::latest()->first()->id + 1;
        }

        $slug = Str::slug($title, '-') . '-' . $postId;
        $user_id = auth()->user()->id;
        $body = $request->input('body');

        if ($request->hasFile('file')) {
            $imagePath = 'storage/' . $request->file('file')->store('postsImages', 'public');
        } else {
            $imagePath = $post->imagePath;
        }

        $post->update([
            'title' => $title,
            'category_id' => $category_id,
            'slug' => $slug,
            'user_id' => $user_id,
            'body' => $body,
            'imagePath' => $imagePath
        ]);
    }

    public function destroy(Post $post)
    {
        return $post->delete();
    }

    // public function search(Request $request)
    // {
    //     $search = $request->input('search');
    //     $posts = Post::where('title', 'like', '%' . $search . '%')->get();
    //     return $posts;
    // }
}