<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\TagResource;
use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function all(Request $request)
    {
        if ($request->token != env('ADMIN_TOKEN')){
            return response()->json([
                "error" => "Unauthorized"
            ] , 401);
        }
        $tags = Tag::all();
        $tags->load('posts');
        return TagResource::collection($tags);
    }

    public function get(Tag $tag , Request $request)
    {
        if ($request->token != env('ADMIN_TOKEN')){
            return response()->json([
                "error" => "Unauthorized"
            ] , 401);
        }
        return TagResource::make($tag);
    }
}
