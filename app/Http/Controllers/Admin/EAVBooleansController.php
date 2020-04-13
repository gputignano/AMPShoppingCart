<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EAVBoolean;
use Illuminate\Http\Request;

class EAVBooleansController extends Controller
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
        $eavBoolean = EAVBoolean::create($request->all());

        return response()->json([
            'created' => isset($eavBoolean),
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\EAVBoolean  $eAVBoolean
     * @return \Illuminate\Http\Response
     */
    public function show(EAVBoolean $eavBoolean)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\EAVBoolean  $eAVBoolean
     * @return \Illuminate\Http\Response
     */
    public function edit(EAVBoolean $eavBoolean)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\EAVBoolean  $eAVBoolean
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EAVBoolean $eavBoolean)
    {
        $updated = $eavBoolean->update($request->all());

        return response()->json([
            'updated' => $updated,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\EAVBoolean  $eAVBoolean
     * @return \Illuminate\Http\Response
     */
    public function destroy(EAVBoolean $eavBoolean)
    {
        $deleted = $eavBoolean->delete();

        return response()->json([
            'deleted' => $deleted,
        ]);
    }
}
