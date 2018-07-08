<?php

namespace App\Policies;

use App\User;
use App\Post;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostPolicy
{
    use HandlesAuthorization;

    /**
     * Authorize all actions if the user has permission to manage posts.
     * 
     * @param \App\User $user
     * @param mixed $ability
     * @return boolean
     */
    public function before(User $user, $ability)
    {
        return true;
        if ($user->hasRole('admin')) {return true;}
        if ($user->hasPermissionTo('manage posts')) {
            return true;
        }
    }

    /**
     * Determine whether the user can manage the post.
     *
     * @param  \App\User  $user
     * @param  \App\Post  $post
     * @return boolean
     */
    public function manage(User $user, Post $post)
    {
        return $user->id === $post->user_id;
    }
}
