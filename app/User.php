<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use Notifiable;
    use HasRoles;

    /**
     * Default avatar image name for users.
     */
    const DEFAULT_AVATAR = 'no-image.png';

    /**
     * The name of the default role for new users.
     */
    const DEFAULT_ROLE = 'user';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'avatar'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token'
    ];

    /**
     * Check if the user has the default avatar image.
     * @return boolean
     */
    public static function userHasDefaultAvatar(): bool
    {
        return auth()->user()->avatar === User::DEFAULT_AVATAR;
    }

    /**
     * Get the posts that belongs to user.
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function posts()
    {
        return $this->hasMany('App\Post');
    }

    /**
     * Get the comments that belongs to user.
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments()
    {
        return $this->hasMany('App\Comment');
    }
}
