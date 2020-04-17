<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEAVIntegerFormRequest;
use App\Http\Requests\UpdateEAVIntegerFormRequest;
use App\Models\EAVInteger;

class EAVIntegersController extends Controller
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
    public function store(StoreEAVIntegerFormRequest $request)
    {
        $eavInteger = EAVInteger::create($request->all());

        return response()->json([
            'created' => isset($eavInteger),
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\EAVInteger  $eAVInteger
     * @return \Illuminate\Http\Response
     */
    public function show(EAVInteger $eavInteger)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\EAVInteger  $eAVInteger
     * @return \Illuminate\Http\Response
     */
    public function edit(EAVInteger $eavInteger)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\EAVInteger  $eAVInteger
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateEAVIntegerFormRequest $request, EAVInteger $eavInteger)
    {
        $updated = $eavInteger->update($request->all());

        return response()->json([
            'updated' => $updated,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\EAVInteger  $eAVInteger
     * @return \Illuminate\Http\Response
     */
    public function destroy(EAVInteger $eavInteger)
    {
        $deleted = $eavInteger->delete();

        return response()->json([
            'deleted' => $deleted,
        ]);
    }
}
