<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductFormRequest;
use App\Http\Requests\UpdateProductFormRequest;
use App\Models\Attribute;
use App\Models\EAV;
use App\Models\Product;
use Illuminate\Support\Facades\Log;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();

        return view('admin.product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.product.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductFormRequest $request)
    {
        $product = Product::create($request->validated());

        return response()->json([
            'created' => isset($product),
        ])->header('AMP-Redirect-To', route('admin.products.show', $product));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return view('admin.product.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        return view('admin.product.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductFormRequest $request, Product $product)
    {
        Log::debug($request->input('attributes'));

        $updated = $product->update($request->validated());

        if ($request->input('attributes'))
        {
            foreach ($request->input('attributes') as $attribute => $value) {
                $attr = Attribute::find($attribute);
    
                EAV::updateOrCreate([
                    'entity_id' => $product->id,
                    'attribute_id' => $attr->id,
                ],
                [
                    'value_type' => $attr->type,
                    'value_id' => $value,
                ]);
            }
        }

        $product->categories()->sync($request->input('categories'));

        return response()->json([
            'updated' => $updated,
        ])->header('AMP-Redirect-To', route('admin.products.show', $product));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $deleted = $product->delete();

        return response()->json([
            'deleted' => $deleted,
        ])->header('AMP-Redirect-To', route('admin.products.index'));
    }
}
