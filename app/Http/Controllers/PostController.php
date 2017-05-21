<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Post;
use Illuminate\Support\Facades\DB;

use App\Events\ChartEvent;

class PostController extends Controller
{
    public function __construct()
    {
        
    }

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

        $userPosts = $this->userPosts();

        broadcast(new ChartEvent($userPosts))->toOthers();

        return response()->json(['operation' => true]); 
    }

    public function charts()
    {
        return view('post.charts');
    }

    public function userPosts()
    {
        $users = DB::table('posts')
                ->select('users.name', DB::raw('sum(posts.votes) as votes'))
                ->join('users', 'posts.user_id', '=', 'users.id')
                ->groupBy('users.name')
                ->get();
        return $users;
    }
}
