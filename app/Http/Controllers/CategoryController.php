<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;

class CategoryController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.categories.index', [
          'categories' => Category::withCount('posts')->latest()->paginate(10),
          'categoriesCount' => Category::count()
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
          'name' => 'required|string|unique:categories|max:255',
          'description' => 'nullable|string|max:255'
      ]);

        $category = Category::create([
          'name' => $request->input('name'),
      ]);

        if ($request->has('description')) {
          $category->fill(['description' => $request->input('description')]);
          $category->save();
      }

      return redirect()->route('dashboard.categories.index')->with('success', 'Category created.');
  }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        return view('posts.index', [
          'category' => Category::findOrFail($category->id),
          'posts' => $category->posts()->with('user')->withCount('comments')->paginate(10)
      ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('dashboard.categories.edit', [
          'category' => $category
      ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Category $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $this->validate($request, [
          'name' => 'required|string|max:255',
          'description' => 'nullable|string|max:255'
      ]);

        $category->update($request->all());

        return redirect()->route('dashboard.categories.index')->with('success', 'Category updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {

        foreach ($category->posts as $post) {
            if ($post->categories()->count() > 1) {
                $post->categories()->detach($category->id);
            } else {
                $post->categories()->sync(Category::where('name', Category::defaultCategory())->first()->id);
                echo "false";
            }
        }

        if ($category->name !== Category::where('name', Category::defaultCategory())->first()->name) {
            $category->delete();
        }

        return redirect()->back()->with('success', 'Category deleted.');
    }
}
