<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AttributeSet;
use Illuminate\Http\Request;

class AttributeSetsController extends Controller
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
    public function store(Request $request)
    {
        $attributeSet = AttributeSet::create($request->all());

        return response()->json([
            'created' => isset($attributeSet),
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AttributeSet  $attributeSet
     * @return \Illuminate\Http\Response
     */
    public function show(AttributeSet $attributeSet)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AttributeSet  $attributeSet
     * @return \Illuminate\Http\Response
     */
    public function edit(AttributeSet $attributeSet)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AttributeSet  $attributeSet
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AttributeSet $attributeSet)
    {
        $updated = $attributeSet->update($request->all());

        return response()->json([
            'updated' => $updated,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AttributeSet  $attributeSet
     * @return \Illuminate\Http\Response
     */
    public function destroy(AttributeSet $attributeSet)
    {
        $deleted = $attributeSet->delete();

        return response()->json([
            'deleted' => $deleted,
        ]);
    }
}
