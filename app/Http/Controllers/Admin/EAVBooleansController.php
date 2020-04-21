<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEavBooleanFormController;
use App\Http\Requests\UpdateEAVBooleanFormRequest;
use App\Models\EAVBoolean;

class EAVBooleansController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $eavBooleans = EAVBoolean::all();

        return view('admin.eavBoolean.index', compact('eavBooleans'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.eavBoolean.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreEavBooleanFormController $request)
    {
        $eavBoolean = EAVBoolean::create($request->input());

        return response()->json([
            'created' => isset($eavBoolean),
        ])->header('AMP-Redirect-To', route('admin.eavBooleans.show', $eavBoolean));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\EAVBoolean  $eAVBoolean
     * @return \Illuminate\Http\Response
     */
    public function show(EAVBoolean $eavBoolean)
    {
        return view('admin.eavBoolean.show', compact('eavBoolean'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\EAVBoolean  $eAVBoolean
     * @return \Illuminate\Http\Response
     */
    public function edit(EAVBoolean $eavBoolean)
    {
        return view('admin.eavBoolean.edit', compact('eavBoolean'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\EAVBoolean  $eAVBoolean
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateEAVBooleanFormRequest $request, EAVBoolean $eavBoolean)
    {
        $updated = $eavBoolean->update($request->input());

        return response()->json([
            'updated' => $updated,
        ])->header('AMP-Redirect-To', route('admin.eavBooleans.show', $eavBoolean));
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
        ])->header('AMP-Redirect-To', route('admin.eavBooleans.index'));
    }
}
