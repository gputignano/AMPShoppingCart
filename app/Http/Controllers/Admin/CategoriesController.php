<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategoryFormRequest;
use App\Http\Requests\UpdateCategoryFormRequest;
use App\Models\Category;
use App\Models\Rewrite;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();

        return view('admin.category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCategoryFormRequest $request)
    {
        $category = Category::create($request->validated());

        return response()->json([
            'created' => isset($category),
        ])->header('AMP-Redirect-To', route('admin.categories.edit', $category));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        return view('admin.category.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('admin.category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCategoryFormRequest $request, Category $category)
    {
        $updated = $category->update($request->validated());

        // if ($request->has('meta'))
        // {
        //     $rewrite = Rewrite::updateOrCreate(
        //         [
        //             'entity_id' => $category->id,
        //         ],
        //         [
        //             'slug' => $request->meta['slug'] ? $request->meta['slug'] : Str::slug($request->meta['meta_title']),
        //             'meta_title' => $request->meta['meta_title'],
        //             'meta_description' => $request->meta['meta_description'],
        //             'meta_robots' => $request->meta['meta_robots'],
        //             'entity_type' => get_class($category),
        //             'entity_id' => $category->id,
        //         ],
        //     );
        // }

        return response()->json([
            'updated' => $updated,
        ])->header('AMP-Redirect-To', route('admin.categories.edit', $category));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $deleted = $category->delete();

        return response()->json([
            'deleted' => $deleted,
        ])->header('AMP-Redirect-To', route('admin.categories.index'));
    }
}
