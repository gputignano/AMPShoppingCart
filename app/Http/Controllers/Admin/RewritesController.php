<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRewriteFormRequest;
use App\Http\Requests\UpdateRewriteFormRequest;
use App\Models\Category;
use App\Models\Entity;
use App\Models\Rewrite;

class RewritesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rewrites = Rewrite::all();

        return view('admin.rewrite.index', compact('rewrites'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.rewrite.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRewriteFormRequest $request)
    {
        $entity = Entity::withoutGlobalScopes()->find($request->entity_id);

        $rewrite = Rewrite::create(array_merge([
            'entity_type' => $entity->type,
        ], $request->validated()));

        return response()->json([
            'created' => isset($rewrite),
        ])->header('AMP-Redirect-To', route('admin.rewrites.edit', $rewrite));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Rewrite  $rewrite
     * @return \Illuminate\Http\Response
     */
    public function show(Rewrite $rewrite)
    {
        return view('admin.rewrite.show', compact('rewrite'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Rewrite  $rewrite
     * @return \Illuminate\Http\Response
     */
    public function edit(Rewrite $rewrite)
    {
        return view('admin.rewrite.edit', compact('rewrite'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Rewrite  $rewrite
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRewriteFormRequest $request, Rewrite $rewrite)
    {
        $entity = Entity::withoutGlobalScopes()->find($request->entity_id);

        $updated = $rewrite->update(array_merge([
            'entity_type' => $entity->type,
        ], $request->validated()));

        return response()->json([
            'updated' => $updated,
        ])->header('AMP-Redirect-To', route('admin.rewrites.edit', $rewrite));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Rewrite  $rewrite
     * @return \Illuminate\Http\Response
     */
    public function destroy(Rewrite $rewrite)
    {
        $deleted = $rewrite->delete();

        return response()->json([
            'deleted' => $deleted,
        ])->header('AMP-Redirect-To', route('admin.rewrites.index'));
    }
}
