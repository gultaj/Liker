<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Events\PostLiked;
use App\Post;

class PostLikeController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function store(Request $request, Post $post)
    {
        $this->authorize('like', $post);

        $like = $post->likes()->firstOrNew([
            'user_id' => $request->user()->id
        ]);
        if ($like->exists) {
            return response(null, 409);
        }

        $like->save();

        broadcast(new PostLiked($post, $request->user()))->toOthers();

        return response(null, 200);
    }
}
