<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

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
}
