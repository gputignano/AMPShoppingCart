<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRewriteFormRequest;
use App\Http\Requests\UpdateRewriteFormRequest;
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
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRewriteFormRequest $request)
    {
        $rewrite = Rewrite::create($request->validated());

        return response()->json([
            'created' => isset($rewrite),
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Rewrite  $rewrite
     * @return \Illuminate\Http\Response
     */
    public function show(Rewrite $rewrite)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Rewrite  $rewrite
     * @return \Illuminate\Http\Response
     */
    public function edit(Rewrite $rewrite)
    {
        //
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
        $updated = $rewrite->update($request->all());

        return response()->json([
            'updated' => $updated,
        ]);
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
        ]);
    }
}
