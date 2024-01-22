<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function all(Request $request)
    {
        if ($request->token != env('ADMIN_TOKEN')){
            return response()->json([
                "error" => "Unauthorized"
            ] , 401);
        }
        $posts = Post::all();
        $posts->load('tags');
        return response()->json(
            PostResource::collection($posts) , 200
        );
    }

    public function get(Post $post , Request $request)
    {
        if ($request->token != env('ADMIN_TOKEN')){
            return response()->json([
                "error" => "Unauthorized"
            ] , 401);
        }
        return PostResource::make($post);
    }

    public function last(Request $request)
    {
        if ($request->token != env('ADMIN_TOKEN')){
            return response()->json([
                "error" => "Unauthorized"
            ] , 401);
        }
        $posts = Post::all()->sortByDesc('id')->take(5);
        $posts->load('tags');
        return response()->json(
            PostResource::collection($posts) , 200
        );
    }
}
