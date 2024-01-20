<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    //

    public function index()
    {
        $posts = Post::latest()->paginate(5);

        return view('posts.index', compact('posts'));
    }

    // create posts
    public function create()
    {
        return view('posts.create');
    }

    // store posts
    public function store(Request $request)
    {
        // validate form
        $this->validate($request, [
            'image' => 'required|image|mimes:jpeg,jpg,png,gif,svg|max:2048',
            'title' => 'required|min:5',
            'content' => 'required|min:10'
        ]);

        // upload image
        $image = $request->file('image');
        $image->storeAs('public/posts', $image->hashName());

        // create posts
        Post::create([
            'image' => $image->hashName(),
            'title' => $request->title,
            'content' => $request->content
        ]);

        // redirect to index
        return redirect()->route('posts.index')->with(['success' => 'Data Berhasil Disimpan']);
    }

    // post detail
    public function show($id)
    {
        $post = Post::find($id);

        return view('posts.show', compact('post'));
    }

    // edit data post
    public function edit(Post $post)
    {
        return view('posts.edit', compact('post'));
    }

    // update data post
    public function update(Request $request, Post $post)
    {
        // validate form
        $this->validate($request, [
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'title' => 'required|min:5',
            'content' => 'required|min:10'
        ]);

        if($request->hasFile('image')){
            // upload new image
            $image = $request->file('image');
            $image->storeAs('public/posts/', $image->hashName());

            Storage::delete('public/posts/'.$post->image);

            // update post new image
            $post->update([
                'image' => $image->hashName(),
                'title' => $request->title,
                'content' => $request->content,
            ]);
        } else {
            $post->update([
                'title' => $request->title,
                'content' => $request->content,
            ]);
        }

        return redirect()->route('posts.index')->with(['success' => 'Data Berhasil Diubah']);
    }

    // hapus data post
    public function destroy(Post $post)
    {
        // delete image public
        Storage::delete('public/posts/'.$post->image);

        // delete to database
        $post->delete();

        return redirect()->route('posts.index')->with(['success' => 'Data Post Berhasil Dihapus']);
    }
}
