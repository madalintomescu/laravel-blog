<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserProfileController extends Controller
{

    /**
     * Display the user posts.
     * 
     * @param  \App\User $user
     * @return \Illuminate\Http\Response
     */
    public function posts(User $user)
    {
        return view('users.posts', [
            'user' => User::withCount('posts')->findOrFail($user->id),
            'posts' => $user->posts()->latest()->paginate(5)
        ]);
    }

    /**
     * Display the user comments.
     * 
     * @param  \App\User $user
     * @return \Illuminate\Http\Response
     */
    public function comments(User $user)
    {
        return view('users.comments', [
            'user' => User::with('comments.post')->withCount('comments')->findOrFail($user->id),
            'comments' => $user->comments()->latest()->paginate(5)
        ]);
    }
}
