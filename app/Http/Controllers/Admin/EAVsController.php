<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attribute;
use App\Models\EAV;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

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
        // Log::debug($request->all());
        // $entity_type = $request->entity_type;
        // $entity_id = $request->entity_id;

        // Log::debug('entity_type: ' . $request->entity_type);
        // Log::debug('entity_id: ' . $request->entity_id);

        // foreach ($request->input('attribute') as $attribute => $value) {
        //     $attribute_id = $attribute;
        //     $value_type = Attribute::find($attribute)->type;
        //     $value_id = $value;

        //     Log::debug('attribute_id: ' . $attribute);
        //     Log::debug('value_type: ' . Attribute::find($attribute)->type);
        //     Log::debug('value_id: ' . $value);

        //     $eav = EAV::create([
        //         'entity_type' => $entity_type,
        //         'entity_id' => $entity_id,
        //         'attribute_id' => $attribute_id,
        //         'value_type' => $value_type,
        //         'value_id' => $value_id,
        //     ]);
        // }

        $eav = EAV::create($request->all());

        return response()->json([
            'created' => isset($eav),
        ]);
    }

    public function storeMany(Request $request)
    {
        Log::debug($request->all());
        $entity_type = $request->entity_type;
        $entity_id = $request->entity_id;

        Log::debug('entity_type: ' . $request->entity_type);
        Log::debug('entity_id: ' . $request->entity_id);

        foreach ($request->input('attribute') as $attribute => $value) {
            $attribute_id = $attribute;
            $value_type = Attribute::find($attribute)->type;
            $value_id = $value;

            Log::debug('attribute_id: ' . $attribute);
            Log::debug('value_type: ' . Attribute::find($attribute)->type);
            Log::debug('value_id: ' . $value);

            $eav = EAV::create([
                'entity_type' => $entity_type,
                'entity_id' => $entity_id,
                'attribute_id' => $attribute_id,
                'value_type' => $value_type,
                'value_id' => $value_id,
            ]);
        }

        return response()->json([
            'created' => isset($eav),
        ]);
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
