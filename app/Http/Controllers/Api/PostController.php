<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    public function index()
    {

        $posts = Post::with('category')->get();
        //dd($posts);
        return response()->json([
            'status' => 'success',
            'message' => 'Ok',
            'results' => $posts
        ], 200);
    }

    public function show($slug)
    {
        $post = Post::where('slug', $slug)->with('category', 'tags')->first();
        if ($post) {
            return response()->json([
                'status' => 'success',
                'message' => 'Ok',
                'results' => $post
            ], 200);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Error'

            ], 404);
        }

    }
}
