<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use App\Events\PostWasCreated;

class PostController extends Controller
{
    public function __contstruct()
    {
        $this->middleware(['auth']);
    }

    public function index(Request $request, Post $post)
    {
        return $post->with('user')->latest()->get();
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'body' => 'required'
        ]);

        $post = $request->user()->posts()->create([
            'body' => $request->body
        ]);

        broadcast(new PostWasCreated($post))->toOthers();

        return $post->load(['user']);
    }
}
