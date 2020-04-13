<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EAVString;
use Illuminate\Http\Request;

class EAVStringsController extends Controller
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
        $eAVString = EAVString::create($request->all());

        return response()->json([
            'created' => isset($eAVString),
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\EAVString  $eAVString
     * @return \Illuminate\Http\Response
     */
    public function show(EAVString $eavString)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\EAVString  $eAVString
     * @return \Illuminate\Http\Response
     */
    public function edit(EAVString $eavString)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\EAVString  $eAVString
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EAVString $eavString)
    {
        $updated = $eavString->update($request->all());

        return response()->json([
            'updated' => $updated,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\EAVString  $eAVString
     * @return \Illuminate\Http\Response
     */
    public function destroy(EAVString $eavString)
    {
        $deleted = $eavString->delete();

        return response()->json([
            'deleted' => $deleted,
        ]);
    }
}
