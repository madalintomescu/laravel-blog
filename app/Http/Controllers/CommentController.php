<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Comment;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.comments.index', [
          'comments' => Comment::with(['user', 'post'])->latest()->paginate(10),
          'commentsCount' => Comment::count()
      ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Post $post
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Post $post)
    {
        $this->validate($request, [
          'name' => 'sometimes|required|string|max:255',
          'email' => 'sometimes|required|email|max:255',
          'body' => 'required'
      ]);

        $comment = Comment::create([
          'name' => $request->input('name') ?? null,
          'email' => $request->input('email') ?? null,
          'body' => $request->input('body'),
          'post_id' => $post->id,
          'user_id' => Auth::id() ?? null
      ]);

        return back()->with('success', 'Comment added.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Comment $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        $comment->delete();
        return redirect()->back()->with('success', 'Comment deleted.');
    }

}
