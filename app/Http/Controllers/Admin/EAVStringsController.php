<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEAVStringFormRequest;
use App\Http\Requests\UpdateEAVStringFormRequest;
use App\Models\EAVString;

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
    public function store(StoreEAVStringFormRequest $request)
    {
        $eAVString = EAVString::create($request->all());

        return response()->json([
            'created' => isset($eAVString),
        ]);
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
    public function update(UpdateEAVStringFormRequest $request, EAVString $eavString)
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
