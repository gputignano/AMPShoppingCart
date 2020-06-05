<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductFormRequest;
use App\Http\Requests\UpdateProductFormRequest;
use App\Models\Attributable;
use App\Models\EAVString;
use App\Models\Product;
use App\Models\Rewrite;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

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
        ])->header('AMP-Redirect-To', route('admin.products.edit', $product));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        return view('admin.product.edit', [
            'entity' => $product,
        ]);
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
        // UPDATES PRODUCT FIELS
        $updated = $product->update($request->validated());

        // UPDATES PRODUCT'S ATTRIBUTES
        if ($request->has('attributes'))
        {
            foreach ($product->attribute_set->attributes as $attribute) {
                $product->{$attribute->code} = $request->input('attributes')[$attribute->id] ?? null;
            }
        }

        // UPDATES CATEGORIES
        if ($request->has('categories'))
        {
            $product->categories()->sync($request->input('categories'));
        }

        return response()->json([
            'updated' => $updated,
        ])->header('AMP-Redirect-To', route('admin.products.edit', $product));
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
