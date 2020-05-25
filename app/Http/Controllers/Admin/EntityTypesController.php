<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEntityTypeFormRequest;
use App\Http\Requests\UpdateEntityTypeFormRequest;
use App\Models\EntityType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class EntityTypesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $entityTypes = EntityType::all();

        return view('admin.entityType.index', compact('entityTypes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.entityType.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreEntityTypeFormRequest $request)
    {
        $entityType = EntityType::create($request->all());

        return response()->json([
            'created' => isset($entityType),
        ])->header('AMP-Redirect-To', route('admin.entityTypes.edit', $entityType));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\EntityType  $entityType
     * @return \Illuminate\Http\Response
     */
    public function show(EntityType $entityType)
    {
        return view('admin.entityType.show', compact('entityType'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\EntityType  $entityType
     * @return \Illuminate\Http\Response
     */
    public function edit(EntityType $entityType)
    {
        return view('admin.entityType.edit', compact('entityType'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\EntityType  $entityType
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateEntityTypeFormRequest $request, EntityType $entityType)
    {
        $updated = $entityType->update($request->only('label'));

        $entityType->attributes()->sync($request->input('attributes'));

        return response()->json([
            'updated' => $updated,
        ])->header('AMP-Redirect-To', route('admin.entityTypes.edit', $entityType));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\EntityType  $entityType
     * @return \Illuminate\Http\Response
     */
    public function destroy(EntityType $entityType)
    {
        $deleted = $entityType->delete();

        return response()->json([
            'deleted' => $deleted,
        ])->header('AMP-Redirect-To', route('admin.entityTypes.index'));
    }
}
