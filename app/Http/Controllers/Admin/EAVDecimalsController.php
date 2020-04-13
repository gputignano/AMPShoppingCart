<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EAVDecimal;
use Illuminate\Http\Request;

class EAVDecimalsController extends Controller
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
        $eavDecimal = EAVDecimal::create($request->all());

        return response()->json([
            'created' => isset($eavDecimal),
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\EAVDecimal  $eAVDecimal
     * @return \Illuminate\Http\Response
     */
    public function show(EAVDecimal $eavDecimal)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\EAVDecimal  $eAVDecimal
     * @return \Illuminate\Http\Response
     */
    public function edit(EAVDecimal $eavDecimal)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\EAVDecimal  $eAVDecimal
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EAVDecimal $eavDecimal)
    {
        $updated = $eavDecimal->update($request->all());

        return response()->json([
            'updated' => $updated,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\EAVDecimal  $eAVDecimal
     * @return \Illuminate\Http\Response
     */
    public function destroy(EAVDecimal $eavDecimal)
    {
        $deleted = $eavDecimal->delete();

        return response()->json([
            'deleted' => $deleted,
        ]);
    }
}
