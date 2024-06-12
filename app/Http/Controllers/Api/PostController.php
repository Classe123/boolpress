<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Database\Eloquent\Builder;

class PostController extends Controller
{
    public function index(Request $request)
    {
        // if ($request->query('category')) {
        //     $posts = Post::with('category')->where('category_id', $request->query('category'))->paginate(4);
        // } else {
        //     $posts = Post::with('category')->paginate(4);
        // }
        $category = $request->query('category');
        $posts = Post::with('category')->when($category, function (Builder $query, string $category) {
            $query->where('category_id', $category);
        })->paginate(4);
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
