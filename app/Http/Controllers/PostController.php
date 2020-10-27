<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Post;

class PostController extends Controller
{
    public function index() {
        // $posts = Post::all();
        // $posts = auth()->user()->posts;
        $posts = auth()->user()->posts()->paginate(5);
        return view('admin.posts.index', ['posts' => $posts]);
    }

    public function show(Post $post) {
        return view('blog-post', ['post' => $post]);
    }

    public function create() {
        $this->authorize('create', Post::class);
        return view('admin.posts.create');
    }

    // public function store() {
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
        $this->authorize('delete', $post);

        // if (auth()->user()->id == $post->user_id) {
            $post->delete();
            Session::flash('message', 'Post was deleted');
            return back();
        // }
    }

    public function edit(Post $post) {
        $this->authorize('view', $post);

        // if (auth()->user()->can('view', $post)) {
        //     return view('admin.posts.edit', ['post' => $post]);
        // }

        return view('admin.posts.edit', ['post' => $post]);
    }

    public function update(Post $post) {
        $inputs = request()->validate([
            'title' => 'required|min:8|max:255',
            'post_image' => 'file',
            'body' => 'required'
        ]);

        if (request('post_image')) {
            $inputs['post_image'] = request('post_image')->store('images');
            $post->post_image = $inputs['post_image'];
        }

        $post->title = $inputs['title'];
        $post->body = $inputs['body'];

        $this->authorize('update', $post);
        // auth()->user()->posts()->save($posts);
        $post->save();
        // $post->update();
        session()->flash('message', 'Post was updated!');
        return redirect()->route('post.index');
    }
}
