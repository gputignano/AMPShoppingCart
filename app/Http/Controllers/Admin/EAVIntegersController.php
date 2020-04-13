<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EAVInteger;
use Illuminate\Http\Request;

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
    public function store(Request $request)
    {
        $eavInteger = EAVInteger::create($request->all());

        return response()->json([
            'created' => isset($eavInteger),
        ], 201);
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
    public function update(Request $request, EAVInteger $eavInteger)
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
