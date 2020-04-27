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
        $eavStrings = EAVString::all();

        return view('admin.eavString.index', compact('eavStrings'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.eavString.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreEAVStringFormRequest $request)
    {
        $eavString = EAVString::create($request->all());

        return response()->json([
            'created' => isset($eavString),
        ])->header('AMP-Redirect-To', route('admin.eavStrings.edit', $eavString));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\EAVString  $eAVString
     * @return \Illuminate\Http\Response
     */
    public function show(EAVString $eavString)
    {
        return view('admin.eavString.show', compact('eavString'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\EAVString  $eAVString
     * @return \Illuminate\Http\Response
     */
    public function edit(EAVString $eavString)
    {
        return view('admin.eavString.edit', compact('eavString'));
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
        ])->header('AMP-Redirect-To', route('admin.eavStrings.edit', $eavString));
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
        ])->header('AMP-Redirect-To', route('admin.eavStrings.index'));
    }
}
