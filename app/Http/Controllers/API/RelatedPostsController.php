<?php

namespace App\Http\Controllers\API;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;

class RelatedPostsController extends Controller
{
    public function index(Post $post)
    {
        $category = $post->category;
        $relatedPost = $category->posts()->where('id', '!=', $post->id)->latest()->take(3)->get();
        return PostResource::collection($relatedPost);
    }
}
