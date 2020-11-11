<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

use App\Post;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $posts = Post::all();

        return view('admin.posts.index', ['posts'=>$posts]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validatedData = $request->validate([
          'title' => ['required', 'max:180'],
          'slug' => ['required', 'max:180', 'unique:posts'],
          'image' => ['nullable', 'image'],
          'content' => ['required']
        ]);

        $newPost = new Post;
        $newPost->user_id = Auth::id();
        $newPost->title = $validatedData['title'];
        $newPost->slug = $validatedData['slug'];
        $newPost->content = $validatedData['content'];

        if (isset($validatedData['image'])) {
          $path = Storage::disk('public')->putFile('images', $validatedData['image']);
          $newPost->image = $path;
        }

        $newPost->save();

        return redirect()->route('admin.posts.show', $newPost->slug);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {

        $post = Post::where('slug', $slug)->first();

        return view('admin.posts.show', ['post'=>$post]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $post = Post::where('slug', $slug)->first();
        return view('admin.posts.edit', ['post'=>$post]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $slug)
    {
      $post = Post::where('slug', $slug)->first();

        $validatedData = $request->validate([
          'title' => ['required', 'max:180'],
          'slug' => ['required', 'max:180', Rule::unique("posts")->ignore($post)],
          'image' => ['nullable', 'image'],
          'content' => ['required']
        ]);

        // $post->user_id = Auth::id();
        $post->title = $validatedData['title'];
        $post->slug = $validatedData['slug'];
        $post->content = $validatedData['content'];

        if (isset($validatedData['image'])) {
          $path = Storage::disk('public')->putFile('images', $validatedData['image']);
          $post->image = $path;
        }

        $post->update();

        return redirect()->route('admin.posts.show', $post->slug);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
