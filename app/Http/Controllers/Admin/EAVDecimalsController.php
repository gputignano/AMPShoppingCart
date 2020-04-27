<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEAVDecimalFormRequest;
use App\Http\Requests\UpdateEAVDecimalFormRequest;
use App\Models\EAVDecimal;
use Illuminate\Support\Facades\Log;

class EAVDecimalsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $eavDecimals = EAVDecimal::all();

        return view('admin.eavDecimal.index', compact('eavDecimals'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.eavDecimal.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreEAVDecimalFormRequest $request)
    {
        $eavDecimal = EAVDecimal::create($request->all());

        return response()->json([
            'created' => isset($eavDecimal),
        ])->header('AMP-Redirect-To', route('admin.eavDecimals.edit', $eavDecimal));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\EAVDecimal  $eAVDecimal
     * @return \Illuminate\Http\Response
     */
    public function show(EAVDecimal $eavDecimal)
    {
        return view('admin.eavDecimal.show', compact('eavDecimal'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\EAVDecimal  $eAVDecimal
     * @return \Illuminate\Http\Response
     */
    public function edit(EAVDecimal $eavDecimal)
    {
        return view('admin.eavDecimal.edit', compact('eavDecimal'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\EAVDecimal  $eAVDecimal
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateEAVDecimalFormRequest $request, EAVDecimal $eavDecimal)
    {
        Log::debug($request->all());
        $updated = $eavDecimal->update($request->all());

        return response()->json([
            'updated' => $updated,
        ])->header('AMP-Redirect-To', route('admin.eavDecimals.edit', $eavDecimal));
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
        ])->header('AMP-Redirect-To', route('admin.eavDecimals.index'));
    }
}
