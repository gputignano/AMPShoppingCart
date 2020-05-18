<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductFormRequest;
use App\Http\Requests\UpdateProductFormRequest;
use App\Models\Attribute;
use App\Models\EAV;
use App\Models\EAVString;
use App\Models\EntityType;
use App\Models\Product;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
        DB::beginTransaction();

        $product = Product::create($request->validated('name'));

        $product->product_type = $request->product_type;

        // If present set attribute_variant attribute
        if (null != $request->input('attribute_variants'))
        {
            $product->attribute_variant = json_encode($request->input('attribute_variants'));
        }

        DB::commit();

        return response()->json([
            'created' => isset($product),
        ])->header('AMP-Redirect-To', route('admin.products.edit', $product));
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
        // RETURNS EAVS THAT HAVE CONFIGURABLE VALUE
        $eavs = EAV::
            whereHasMorph(
            'value',
            [EAVString::class,],
            function (Builder $query) {
                $query->where('value', 'configurable');
            }
        )->
        pluck('entity_id');

        return view('admin.product.' . $product->product_type . '.edit', compact('product', 'eavs'));
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

        return response()->json([
            'updated' => $updated,
        ])->header('AMP-Redirect-To', route('admin.products.edit', $product));
    }

    public function updateAttributes(Request $request, Product $product)
    {
        // UPDATES PRODUCT'S ATTRIBUTES
        foreach (EntityType::where('label', Product::class)->first()->attributes()->where('is_system', false)->get() as $attribute) {

            $value = $request->input('attributes')[$attribute->id] ?? null;

            $product->{$attribute->label} = $request->input('attributes')[$attribute->id] ?? null;
        }

        return response()->json([
            'updated' => 'OK',
        ])->header('AMP-Redirect-To', route('admin.products.edit', $product));
    }

    public function updateCategories(Request $request, Product $product)
    {
        // UPDATES CATEGORIES
        $product->categories()->sync($request->input('categories'));

        return response()->json([
            'updated' => 'OK',
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
