<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;

class AdminPanelController extends Controller
{
    public function index()
    {
        if (auth()->check()){
            $posts = Post::all()->sortBy('desc');
            $posts->load("tags");
            $tags = Tag::all();
            return view('panel' , compact('posts' , 'tags'));
        }else{
            return redirect()->route("login-admin");
        }
    }

    public function saveNewPost(Request $request)
    {
        if (!auth()->check()){
            return redirect()->route("login-admin");
        }

        $request->validate([
            'title_fa' => 'required|string' ,
            'title_en' => 'required|string' ,
            'description_fa' => 'required|string' ,
            'description_en' => 'required|string' ,
            'keywords_fa' => 'required|string' ,
            'keywords_en' => 'required|string' ,
            'body_fa' => 'required|string' ,
            'body_en' => 'required|string' ,
            'disable' => 'nullable|string' ,
            'slug' => 'nullable|string' ,
            'cover' => 'required|file' ,
            'tags' => 'required|exists:tags,id|array' ,
        ]);


        $cover = $request->file('cover');
        $name = pathinfo($cover->getClientOriginalName() , PATHINFO_FILENAME);
        $ext = $cover->getClientOriginalExtension();
        $new = $name . "_post_" . rand(0 , 9999999999) . "." . $ext;
        if(env('USE_LIARA_STORAGE')) {
            $file = $cover->storeAs("image/cover/post" , $new , 'liara');
            $path = env("STORAGE_URL") . $file;
        }else{
            $file = $cover->storeAs("image/cover/post" , $new , 'public_html');
            $path = url('files/' . $file)  ;
        }
        $disable = $request->has('disable') ? false : true ;
        $data = [
            'cover' => $path ,
            'title_fa' => $request->title_fa ,
            'title_en' => $request->title_en ,
            'caption_fa' => $request->description_fa ,
            'caption_en' => $request->description_en ,
            'keywords_fa' => $request->keywords_fa ,
            'keywords_en' => $request->keywords_en ,
            'body_fa' => $request->body_fa ,
            'body_en' => $request->body_en ,
            'disable' => $disable
        ];
        if ($request->has('slug')){
            $data['slug'] = $request->slug ;
        }
        $post = Post::create($data);
        $post->tags()->attach($request->tags);

        return redirect()->route('panel-admin');

    }

    public function deletePost(Post $post)
    {
        if (!auth()->check()){
            return redirect()->route("login-admin");
        }

        $post->delete();

        return back();
    }

    public function editPost(Post $post)
    {
        if (!auth()->check()){
            return redirect()->route("login-admin");
        }
        $post->load("tags");
        $tags = Tag::all();
        return view('edit-post' , compact('post' , 'tags'));
    }

    public function updatePost(Request $request , Post $post)
    {
        if (!auth()->check()){
            return redirect()->route("login-admin");
        }
        $request->validate([
            'title_fa' => 'required|string' ,
            'title_en' => 'required|string' ,
            'description_fa' => 'required|string' ,
            'description_en' => 'required|string' ,
            'keywords_fa' => 'required|string' ,
            'keywords_en' => 'required|string' ,
            'body_fa' => 'required|string' ,
            'body_en' => 'required|string' ,
            'disable' => 'nullable|string' ,
            'slug' => 'nullable|string' ,
            'cover' => 'nullable|file' ,
            'tags' => 'required|exists:tags,id|array' ,
        ]);

        $data = [];
        if ($request->hasFile('cover')) {
            $cover = $request->file('cover');
            $name = pathinfo($cover->getClientOriginalName(), PATHINFO_FILENAME);
            $ext = $cover->getClientOriginalExtension();
            $new = $name . "_post_" . rand(0, 9999999999) . "." . $ext;
            if (env('USE_LIARA_STORAGE')) {
                $file = $cover->storeAs("image/cover/post", $new, 'liara');
                $path = env("STORAGE_URL") . $file;
            } else {
                $file = $cover->storeAs("image/cover/post", $new, 'public_html');
                $path = url('files/' . $file);
            }
            $data['cover']= $path ;
        }
        $disable = $request->has('disable') ? false : true ;

        $data += [
            'title_fa' => $request->title_fa ,
            'title_en' => $request->title_en ,
            'caption_fa' => $request->description_fa ,
            'caption_en' => $request->description_en ,
            'keywords_fa' => $request->keywords_fa ,
            'keywords_en' => $request->keywords_en ,
            'body_fa' => $request->body_fa ,
            'body_en' => $request->body_en ,
            'disable' => $disable
        ];
        if ($request->has('slug')){
            $data['slug'] = $request->slug ;
        }
        $post->update($data);
        $post->tags()->sync($request->tags);

        return redirect()->route('panel-admin');

    }

    public function createNewPost()
    {
        if (!auth()->check()){
            return redirect()->route("login-admin");
        }

        $tags = Tag::all();
        return view('create-post' , compact('tags'));
    }

    public function createNewTag()
    {
        if (!auth()->check()){
            return redirect()->route("login-admin");
        }
        return view("create-tag");
    }

    public function saveNewTag(Request $request)
    {
        if (!auth()->check()){
            return redirect()->route("login-admin");
        }
        $request->validate([
            'label_fa' => 'required|unique:tags,label_fa' ,
            'label_en' => 'required|unique:tags,label_en' ,
            'slug' => 'required|unique:tags,slug' ,
            'caption_fa' => 'required|string' ,
            'caption_en' => 'required|string' ,
            'cover' => 'nullable|file' ,
        ]);

        $cover = $request->file('cover');
        $name = pathinfo($cover->getClientOriginalName(), PATHINFO_FILENAME);
        $ext = $cover->getClientOriginalExtension();
        $new = $name . "_tag_" . rand(0, 9999999999) . "." . $ext;
        if(env('USE_LIARA_STORAGE')) {
            $file = $cover->storeAs("image/cover/tag", $new, 'liara');
            $path = env("STORAGE_URL") . $file;
        } else {
            $file = $cover->storeAs("image/cover/tag", $new, 'public_html');
            $path = url('files/' . $file);
        }

        $data = [
            'label_fa' => $request->label_fa ,
            'label_en' => $request->label_en ,
            "slug" => $request->slug ,
            "caption_fa" => $request->caption_fa ,
            "caption_en" => $request->caption_en ,
            "img" => $path
        ];


        Tag::create($data);

        return redirect()->route('panel-admin');
    }

    public function deleteTag(Tag $tag)
    {
        if (!auth()->check()){
            return redirect()->route("login-admin");
        }

        $tag->delete();

        return back();
    }

    public function editTag(Tag $tag)
    {
        return view('edit-tag' , compact('tag'));
    }

    public function updateTag(Request $request , Tag $tag)
    {
        if (!auth()->check()){
            return redirect()->route("login-admin");
        }
        $request->validate([
            'label_fa' => ['required' , Rule::unique('tags' , 'label_fa')->ignore($tag->id)]  ,
            'label_en' => ['required' , Rule::unique('tags' , 'label_en')->ignore($tag->id)]  ,
            'slug' => ['required' , Rule::unique('tags' , 'slug')->ignore($tag->id)] ,
            'caption_fa' => 'required|string' ,
            'caption_en' => 'required|string' ,
            'cover' => 'nullable|file' ,
        ]);
        $data = [];
        if ($request->hasFile('cover')) {
            $cover = $request->file('cover');
            $name = pathinfo($cover->getClientOriginalName(), PATHINFO_FILENAME);
            $ext = $cover->getClientOriginalExtension();
            $new = $name . "_tag_" . rand(0, 9999999999) . "." . $ext;
            if(env('USE_LIARA_STORAGE')) {
                $file = $cover->storeAs("image/cover/tag", $new, 'liara');
                $path = env("STORAGE_URL") . $file;
            } else {
                $file = $cover->storeAs("image/cover/tag", $new, 'public_html');
                $path = url('files/' . $file);
            }
            $data['img']= $path ;
        }
        $data += [
            'label_fa' => $request->label_fa ,
            'label_en' => $request->label_en ,
            "slug" => $request->slug ,
            "caption_fa" => $request->caption_fa ,
            "caption_en" => $request->caption_en ,
        ];
        $tag->update($data);
        return redirect()->route('panel-admin');
    }

    public function upload(Request $request)
    {
        if (!auth()->check()){
            return redirect()->route("login-admin");
        }
        $request->validate([
            'file' => 'required|file'
        ]);

        $img = $request->file('file');
        $name = pathinfo($img->getClientOriginalName(), PATHINFO_FILENAME);
        $ext = $img->getClientOriginalExtension();
        $new = $name . "_image_" . rand(0, 9999999999) . "." . $ext;
        if(env('USE_LIARA_STORAGE')) {
            $file = $img->storeAs("image/upload", $new, 'liara');
            $path = env("STORAGE_URL") . $file;
        } else {
            $file = $img->storeAs("files/upload", $new, 'public_html');
            $path = url('files/' . $file);
        }
        Session::flash('fileImg' , $path);
        return back();
    }
}
