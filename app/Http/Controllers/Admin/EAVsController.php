<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EAV;
use Illuminate\Http\Request;

class EAVsController extends Controller
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
        $eav = EAV::create($request->all());

        return response()->json([
            'created' => isset($eav),
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\EAV  $eav
     * @return \Illuminate\Http\Response
     */
    public function show(EAV $eav)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\EAV  $eav
     * @return \Illuminate\Http\Response
     */
    public function edit(EAV $eav)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\EAV  $eav
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EAV $eav)
    {
        $updated = $eav->update($request->all());

        return response()->json([
            'updated' => $updated,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\EAV  $eav
     * @return \Illuminate\Http\Response
     */
    public function destroy(EAV $eav)
    {
        $deleted = $eav->delete();

        return response()->json([
            'deleted' => $deleted,
        ]);
    }
}
