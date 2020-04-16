<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEntityTypeFormRequest;
use App\Http\Requests\UpdateEntityTypeFormRequest;
use App\Models\EntityType;

class EntityTypesController extends Controller
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
    public function store(StoreEntityTypeFormRequest $request)
    {
        $entityType = EntityType::create($request->all());

        return response()->json([
            'created' => isset($entityType),
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\EntityType  $entityType
     * @return \Illuminate\Http\Response
     */
    public function show(EntityType $entityType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\EntityType  $entityType
     * @return \Illuminate\Http\Response
     */
    public function edit(EntityType $entityType)
    {
        //
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
        $updated = $entityType->update($request->all());

        return response()->json([
            'updated' => $updated,
        ]);
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
        ]);
    }
}
