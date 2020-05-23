<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAttributeSetFormRequest;
use App\Http\Requests\UpdateAttributeSetFormRequest;
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
        $attributeSets = AttributeSet::all();

        return view('admin.attributeSet.index', compact('attributeSets'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.attributeSet.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAttributeSetFormRequest $request)
    {
        $attributeSet = AttributeSet::create($request->validated());

        return response()->json([
            'created' => true,
        ])->header('AMP-Redirect-To', route('admin.attributeSets.edit', $attributeSet));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AttributeSet  $attributeSet
     * @return \Illuminate\Http\Response
     */
    public function show(AttributeSet $attributeSet)
    {
        return view('admin.attributeSet.show', compact('attributeSet'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AttributeSet  $attributeSet
     * @return \Illuminate\Http\Response
     */
    public function edit(AttributeSet $attributeSet)
    {
        return view('admin.attributeSet.edit', compact('attributeSet'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AttributeSet  $attributeSet
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAttributeSetFormRequest $request, AttributeSet $attributeSet)
    {
        if ($request->has('label')) {
            $updated = $attributeSet->update($request->validated());

            return response()->json([
                'updated' => $updated,
            ])->header('AMP-Redirect-To', route('admin.attributeSets.edit', $attributeSet));
        }

        $attributeSet->attributes()->sync($request->input('attributes'));

        return response()->json([
            'updated' => 'ok',
        ])->header('AMP-Redirect-To', route('admin.attributeSets.edit', $attributeSet));
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
        ])->header('AMP-Redirect-To', route('admin.attributeSets.index'));
    }
}
