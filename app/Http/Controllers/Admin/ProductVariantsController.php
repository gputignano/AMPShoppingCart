<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attribute;
use App\Models\EAVString;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class ProductVariantsController extends Controller
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
        $parent = Product::find($request->parent_id)->first();

        $variant = Product::create([
            'parent_id' => $request->parent_id ?? null,
            'name' => $parent->name,
        ]);

        $variant->eavs()->create([
            'attribute_id' => 1,
            'value_type' => EAVString::class,
            'value_id' => 3,
        ]);

        foreach ($request->input('attributes') as $attribute_id => $value) {
            $attribute = Attribute::find($attribute_id);

            if (!$attribute->type::$hasDefaultValues)
            {
                Log::debug('Not Default:' . $attribute->type);
                $value = $attribute->type::create([
                    'value' => $value,
                ])->id;
            }

            $variant->eavs()->create([
                'attribute_id' => $attribute->id,
                'value_type' => $attribute->type,
                'value_id' => $value,
            ]);
        }

        return response()->json([
            'message' => 'ok',
        ])->header('AMP-Redirect-To', route('admin.products.edit', $parent));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }
}
