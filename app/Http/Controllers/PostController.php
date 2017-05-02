<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Post;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with('user')->paginate(10);
        return view('post.index', compact('posts'));
    }

    public function vote(Request $request)
    {
        $id = $request->input('id');
        $post = Post::find($id);
        $post->votes = (int)($post->votes + 1);
        $post->save();
        return response()->json(['operation' => true]); 
    }
}
