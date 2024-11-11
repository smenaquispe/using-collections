<?php

namespace App\Http\Controllers;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $posts = Post::all();
        return response()->json($posts);
    }

    public function insert(Request $request)
    {
        $post = new Post();
        
        $post->user_id = $request->input('user_id');
        $post->title = $request->input('title');
        $post->content = $request->input('content');
        $post->save();

        return response()->json($post);
    }

    public function afterById(Request $request)
    {
        $id = $request->input('id');

        $posts = Post::all();
        $postsAfterId = $posts->afterById($id);
        return response()->json($postsAfterId);
    }

    public function beforeById(Request $request)
    {
        $id = $request->input('id');

        $posts = Post::all();
        $postsBeforeId = $posts->beforeById($id);
        return response()->json($postsBeforeId);
    }

    public function chunkPosts(Request $request)
    {
        $size = intval($request->input('size'));
        $posts = Post::all();
        $chunkedPosts = $posts->chunk($size);
        return response()->json($chunkedPosts);
    }

    public function crossJoinWithUsers(Request $request)
    {
        $posts = Post::all();
        $users = User::all();
        $crossJoined = $posts->crossJoinWithUsers($users);
        return response()->json($crossJoined);
    }
}