<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attributable;
use Illuminate\Http\Request;

class AttributableController extends Controller
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
        $attributable = Attributable::create($request->all());

        return response()->json([
            'created' => isset($attributable),
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Attributable  $attributable
     * @return \Illuminate\Http\Response
     */
    public function show(Attributable $attributable)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Attributable  $attributable
     * @return \Illuminate\Http\Response
     */
    public function edit(Attributable $attributable)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Attributable  $attributable
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Attributable $attributable)
    {
        $updated = $attributable->update($request->all());

        return response()->json([
            'updated' => $updated,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Attributable  $attributable
     * @return \Illuminate\Http\Response
     */
    public function destroy(Attributable $attributable)
    {
        $deleted = $attributable->delete();

        return response()->json([
            'deleted' => $deleted,
        ]);
    }
}
