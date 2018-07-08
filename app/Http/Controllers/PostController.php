<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StorePostRequest;
use App\Post;
use App\Comment;
use App\Category;
use App\Tag;

class PostController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('posts.index', [
            'posts' => Post::onlyPublished()
            ->with(['user', 'comments', 'categories'])
            ->withCount('comments')
            ->latest()
            ->paginate(10),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.posts.create', [
            'categories' => Category::all(['id', 'name']),
            'tags' => Tag::all(['name'])
        ]);
    }

    /**
     * Store a newly created resource in storage.
     * 
     * @param  \App\Http\Requests\StorePostRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePostRequest $request)
    {
        $post = Post::create([
            'title' => $request->input('title'),
            'body' => $request->input('body'),
            'user_id' => auth()->id(),
            'published_at' => $request->has('draft') ? null : \Carbon\Carbon::now()
        ]);

        if ($request->hasFile('image')) {
            $request->file('image')->store('public/post');

            // Generate a random name for every file
            $image = $request->file('image')->hashName();

            $post->update(['image' => $image]);
        }

        if ($request->has('categories')) {
            $categories = $request->input('categories');
            $post->categories()->attach($categories);
        } else {
            $category = Category::where('name', Category::defaultCategory())->first()->id;
            $post->categories()->attach($category);
        }

        if ($request->has('tags')) {
            foreach ($request->input('tags') as $tag) {
                $tag = Tag::firstOrCreate(['name' => $tag]);
                $post->tags()->attach($tag);
            }
        }

        if ($request->has('draft')) {
            return redirect()->route('dashboard.posts.draft')->with('success', 'Post saved in drafts.');
        }

        return redirect()->route('posts.show', $post->id)->with('success', 'Post created.');
    }

    /**
     * Display the specified resource.
     * 
     * @param  \App\Post $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
    // Abort if the post is drafted and the user does not have the right to manage posts
        if (!$post->published_at) {
            if (!Auth::check() || !auth()->user()->hasPermissionTo('manage posts')) {
                abort(404);
            }
        }

        return view('posts.show', [
            'post' => Post::withCount('comments')->findOrFail($post->id),
            'previousPost' => Post::where('id', '<', $post->id)->first(),
            'nextPost' => Post::where('id', '>', $post->id)->first(),
            'comments' => Comment::with('user')->where('post_id', $post->id)->paginate(20),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     * 
     * @param  \App\Post $post
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit(Post $post)
    {
        $this->authorize('manage', $post);

        return view('dashboard.posts.edit', [
            'post' => Post::with(['tags', 'categories'])->findOrFail($post->id),
            'categories' => Category::latest()->get(['id', 'name']),
            'tags' => Tag::latest()->get(['id', 'name'])
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\StorePostRequest $request
     * @param  \App\Post $post
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(StorePostRequest $request, Post $post)
    {
        $this->authorize('manage', $post);

        $post->update([
            'title' => $request->input('title'),
            'body' => $request->input('body'),
            'published_at' => $request->has('draft') ? null : \Carbon\Carbon::now()
        ]);

        if ($post->image && $request->has('removed')) {
            $post->update(['image' => null]);
        }

        if ($request->hasFile('image')) {
            $request->file('image')->store('public/post');
            $image = $request->file('image')->hashName();
            $post->update(['image' => $image]);
        }

        if ($request->has('categories')) {
            $categories = $request->input('categories');
            $post->categories()->sync($categories);
        } else {
            $category = Category::where('name', Category::defaultCategory())->first()->id;
            $post->categories()->sync($category);
        }

        if ($request->has('tags')) {
            $post->tags()->detach();

            foreach ($request->input('tags') as $tag) {
                $tag = Tag::firstOrCreate(['name' => $tag]);
                $post->tags()->attach($tag);
            }
        }

        if ($request->has('draft')) {
            session()->flash('post_update', 'Post moved to drafts.');
            return redirect()->route('dashboard.posts.draft')->with('success', 'Post saved in drafts.');
        }

        // Flash alert message
        session()->flash('post_update', 'Post updated.');

        return redirect()->back()->with('success', 'Post updated.');
    }

    /**
     * Remove the specified resource from storage.
     * 
     * @param  \App\Post $post
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroy(Post $post)
    {
        $this->authorize('manage', $post);

        $post->delete();

        // Redirect back if the request came from drafts page
        // Otherwise redirect to posts page
        if (url()->previous() === route('dashboard.posts.draft')) {
            return redirect()->back()->with('success', 'Post moved to trash.');
        }
        return redirect()->route('dashboard.posts.index')->with('success', 'Post moved to trash.');
    }

    /**
     * Restore a post from trash.
     * 
     * @param  \App\Post $post
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function restore(Post $post)
    {
        $this->authorize('manage', $post);

        $post->restore();
        return redirect()->back()->with('success', 'Post restored.');
    }

    /**
     * Permanently delete a post.
     * 
     * @param  \App\Post $post
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function forceDelete(Post $post)
    {
        $this->authorize('manage', $post);

        Post::onlyTrashed()->find($post->id)->forceDelete();
        return redirect()->back()->with('success', 'Post deleted.');
    }

    /**
     * Permanently delete all posts.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function forceDeleteAll(Request $request)
    {
        $this->authorize('manage', Post::class);

        Post::onlyTrashed()->whereIn('id', $request->input('ids'))->forceDelete();
        return redirect()->back()->with('success', 'Trash empty.');
    }

}
