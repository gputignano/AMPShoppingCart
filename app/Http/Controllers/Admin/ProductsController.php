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
        DB::beginTransaction();

        $product = Product::create($request->validated('name'));

        $product->product_type = $request->product_type;
        $product->attribute_sets()->attach($request->product_type);

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
        // RETURNS ATTRIBUTABLES THAT HAVE CONFIGURABLE VALUE
        $attributables = Attributable::
            whereHasMorph(
            'value',
            [EAVString::class,],
            function (Builder $query) {
                $query->where('value', 'configurable');
            }
        )->
        pluck('attributable_id');

        return view('admin.product.' . $product->product_type . '.edit', compact('product', 'attributables'));
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

        if ($request->has('meta'))
        {
            $rewrite = Rewrite::updateOrCreate(
                [
                    'entity_id' => $product->id,
                ],
                [
                    'slug' => $request->meta['slug'] ? $request->meta['slug'] : Str::slug($request->meta['meta_title']),
                    'meta_title' => $request->meta['meta_title'],
                    'meta_description' => $request->meta['meta_description'],
                    'meta_robots' => $request->meta['meta_robots'],
                    'template' => 'aaa',
                    'entity_id' => $product->id,
                ],
            );
        }

        return response()->json([
            'updated' => $updated,
        ])->header('AMP-Redirect-To', route('admin.products.edit', $product));
    }

    public function updateAttributes(Request $request, Product $product)
    {
        // UPDATES PRODUCT'S ATTRIBUTES
        // foreach (EntityType::where('label', Product::class)->first()->attributes()->where('is_system', false)->get() as $attribute) {
        foreach ($product->attribute_sets()->first()->attributes as $attribute) {
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
