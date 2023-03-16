<?php

namespace App\Http\Controllers\API;

use App\Models\Post;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class PostController extends Controller
{
    public function indexPostUser()
    {
        return PostResource::collection(
            Post::where("user_id" , auth()->user()->id)->latest()->paginate(2)->withQueryString()
        );
    }

    public function indexPostBlog(Request $request)
    {
        if($request->category){
            return PostResource::collection(
               Category::where("name" , $request->category)->firstOrFail()->posts()->latest()->paginate(2)->withQueryString()
            );
        } else if($request->search){
            return PostResource::collection(
                Post::where('title' , 'like',"%" . $request->search . "%")
                ->orWhere('body' , 'like', "%" . $request->search . "%")
                ->latest()->paginate(2)->withQueryString()
            );
        }

        return PostResource::collection(
            Post::latest()->paginate(2)->withQueryString()
        );
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

    public function showFront(Post $post)
    {
        return new PostResource($post);
    }

    public function showDashboard(Post $post)
    {
        // if($post->user_id != auth()->user()->id) {
        //     return abort(403, 'You are not authorized to update this post');
        // }

        return new PostResource($post);

    }

    public function update(Request $request, Post $post)
    {
        if($post->user_id != auth()->user()->id) {
            return abort(403, 'You are not authorized to update this post');
        }

        $request->validate([
            'title' => 'required',
            'file' => 'nullable | image',
            'body' => 'required',
            'category_id' => 'required'
        ]);

        $title = $request->title;
        $category_id = $request->category_id;


        $slug = Str::slug($title, '-') . '-' . $post->id;
        $body = $request->input('body');

        if ($request->file('file')) {
            File::delete($post->imagePath);
            $imagePath = 'storage/' . $request->file('file')->store('postsImages', 'public');
            $post->imagePath = $imagePath;
        }

        // update and save post
        $post->update([
            'title' => $title,
            'category_id' => $category_id,
            'slug' => $slug,
            'body' => $body,
        ]);
    }

    public function destroy(Post $post)
    {
        return $post->delete();
    }

    // public function search(Request $request)
    // {
    //     $search = $request->input('search');
    //     $posts = Post::where('title', 'like', '%' . $search . '%')->paginate(2)->withQueryString();
    //     return $posts;
    // }
}