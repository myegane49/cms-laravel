<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Post;

class PostController extends Controller
{
    public function index() {
        $posts = Post::all();
        return view('admin.posts.index', ['posts' => $posts]);
    }

    public function show(Post $post) {
        return view('blog-post', ['post' => $post]);
    }

    public function create() {
        return view('admin.posts.create');
    }

    // public function store(Request $request) {
    public function store(Request $request) {
        // dd(request()->all());
        // return $user = auth()->user();

        $inputs = request()->validate([
            'title' => 'required|min:8|max:255',
            // 'post_image' => 'file:jpeg', 
            // 'post_image' => 'mimes:jpeg,png', 
            'post_image' => 'file',
            'body' => 'required'
        ]);
        
        if (request('post_image')) {
            $inputs['post_image'] = request('post_image')->store('images');
        }

        auth()->user()->posts()->create($inputs);
        $request->session()->flash('message', 'Post was created!');
        // return back();
        return redirect()->route('post.index');

        // dd($request->post_image);
    }

    public function destroy(Post $post) {
        $post->delete();
        Session::flash('message', 'Post was deleted');
        return back();
    }
}
