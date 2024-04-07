<?php

namespace App\Http\Controllers;

use App\Events\PostCreated;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostRequest;
use App\Jobs\ChangePost;
use App\Jobs\UploadBigFile;
use App\Mail\PostCreatedToEmail;
use App\Models\Category;
use App\Models\Post;
use App\Notifications\PostDeleted;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Auth middleware for Post constructor
     */
    public function __construct()
    {
        // $this->middleware('auth')->except(['index','show']);
        $this->authorizeResource(Post::class,'post');
    }
    /**
     * Display a listing of the resource
     */
    public function index()
    {
        // $posts = Post::latest()->get();
        $posts = Cache::remember('posts', now()->addSeconds(30), function () {
            return Post::latest()->get();
        });
        return view('posts.index', ['posts' => $posts]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("posts.create",["categories"=>Category::all()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request)
    {
        if ($request->hasFile('photo')) {
            $name = $request->file("photo")->getClientOriginalName();
            $path = $request->file("photo")->storeAs('photo-store', $name);
        }
        $post = Post::create([
            "user_id"=>auth()->user()->id,
            "category_id"=>$request->category_id,
            "title" => $request->title,
            "short_content" => $request->short_content,
            "photo" => $path,
            "content" => $request->content,
        ]);
        PostCreated::dispatch($post);
        ChangePost::dispatch($post)->onQueue('uploading');
        // Mail::to($request->user())->send(new PostCreatedToEmail($post));
        auth()->user()->notify(new PostDeleted($post));
        return redirect(route("posts.index"));
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        // dd($post);
        return view("posts.show", [
            'post' => $post,
            'categories'=>Category::all(),
            'recent_posts' => Post::latest()->get()->except($post->id)->take(5)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        // if(!Gate::allows('update-post',$post)){
        //     abort(403);
        // }

        Gate::authorize('update',$post);

        return view("posts.edit", ["post" => $post]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StorePostRequest $request, Post $post)
    {
        Gate::authorize('update',$post);
        if ($request->hasFile('photo')) {

            if (isset($post->photo)) {
                Storage::delete($post->photo);
            }
            $name = $request->file('photo')->getClientOriginalName();
            $path = $request->file('photo')->storeAs('photo-store', $name);
        }

        $post->update([
            'title' => $request->title,
            'short_content' => $request->short_content,
            'content' => $request->content,
            'photo' => $path ?? $post->photo
        ]);
        return redirect(route("posts.show", ["post" => $post->id]));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        Gate::authorize('delete',$post);
        $post->comments()->delete();
        $post->delete();
        Storage::delete($post->photo);
        return redirect(route("posts.index"));
    }
}
