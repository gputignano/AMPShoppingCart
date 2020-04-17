<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEAVTextFormRequest;
use App\Http\Requests\UpdateEAVTextFormRequest;
use App\Models\EAVText;

class EAVTextsController extends Controller
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
    public function store(StoreEAVTextFormRequest $request)
    {
        $eavText = EAVText::create($request->all());

        return response()->json([
            'created' => isset($eavText),
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\EAVText  $eAVText
     * @return \Illuminate\Http\Response
     */
    public function show(EAVText $eavText)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\EAVText  $eAVText
     * @return \Illuminate\Http\Response
     */
    public function edit(EAVText $eavText)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\EAVText  $eAVText
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateEAVTextFormRequest $request, EAVText $eavText)
    {
        $updated = $eavText->update($request->all());

        return response()->json([
            'updated' => $updated,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\EAVText  $eAVText
     * @return \Illuminate\Http\Response
     */
    public function destroy(EAVText $eavText)
    {
        $deleted = $eavText->delete();

        return response()->json([
            'deleted' => $deleted,
        ]);
    }
}
