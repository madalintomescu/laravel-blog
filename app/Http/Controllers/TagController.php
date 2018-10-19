<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tag;
use App\Post;
class TagController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.tags.index', [
            'tags' => Tag::withCount('posts')->latest()->paginate(10),
            'tagsCount' => Tag::count()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|unique:tags|max:255',
            'description' => 'nullable|string|max:255'
        ]);

        $tag = Tag::create([
            'name' => $request->input('name'),
            'description' => $request->input('description')
        ]);

        return redirect()->route('dashboard.tags.index')->with('success', 'Tag created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Tag $tag
     * @return \Illuminate\Http\Response
     */
    public function show(Tag $tag)
    {
        return view('posts.index', [
            'tag' => Tag::findOrFail($tag->id),
            'posts' => $tag->posts()->with(['user', 'categories'])->withCount('comments')->paginate(10)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Tag $tag
     * @return \Illuminate\Http\Response
     */
    public function edit(Tag $tag)
    {
        return view('dashboard.tags.edit', ['tag' => $tag]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Tag $tag
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tag $tag)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:255'
        ]);

        $tag->update($request->all());

        return redirect()->route('dashboard.tags.index')->with('success', 'Tag updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Tag $tag
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tag $tag)
    {
        $tag->delete();
        return redirect()->back()->with('success', 'Tag deleted.');
    }
}
