<?php

namespace Tests\Feature;

use App\Models\Attribute;
use App\Models\EAVString;
use App\Models\Category;
use App\Models\EAV;
use App\Models\EAVBoolean;
use App\Models\EAVDecimal;
use App\Models\EAVInteger;
use App\Models\EAVSelect;
use App\Models\EAVText;
use App\Models\Product;
use App\Models\Rewrite;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    protected $product;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed('InstallationTableSeeder');

        $this->product = factory(Product::class)->create();

        $this->product->rewrite()->save(factory(Rewrite::class)->make());
    }

    /** @test */
    public function a_user_can_view_product_index()
    {
        $response = $this->get(route('admin.products.index'));

        $response->assertStatus(200);

        $response->assertViewIs('admin.product.index');

        $response->assertSee('<h1>All Products</h1>', false);
    }

    /** @test */
    public function a_user_can_view_product_create()
    {
        $response = $this->get(route('admin.products.create'));

        $response->assertStatus(200);

        $response->assertViewIs('admin.product.create');

        $response->assertSee('<h1>Create Product</h1>', false);
    }

    /** @test */
    public function a_user_can_view_product_show()
    {
        $response = $this->get(route('admin.products.show', $this->product));

        $response->assertStatus(200);

        $response->assertViewIs('admin.product.show');

        $response->assertSee('<h1>' . e($this->product->name) . '</h1>', false);
    }

    /** @test */
    public function a_user_can_view_product_simple_edit()
    {
        $this->product->attributes()->attach(1, ['value_type' => EAVSelect::class, 'value_id' => 1]);

        $response = $this->get(route('admin.products.edit', $this->product));

        $response->assertStatus(200);

        $response->assertViewIs('admin.product.simple.edit');

        $response->assertSee('<h1>Edit ' . e($this->product->name) . '</h1>', false);
    }

    /** @test */
    public function a_user_can_view_product_configurable_edit()
    {
        $this->product->attributes()->attach(1, ['value_type' => EAVSelect::class, 'value_id' => 2]);

        $response = $this->get(route('admin.products.edit', $this->product));

        $response->assertStatus(200);

        $response->assertViewIs('admin.product.configurable.edit');

        $response->assertSee('<h1>Edit ' . e($this->product->name) . '</h1>', false);
    }

    /** @test */
    public function a_product_can_be_created()
    {
        $response = $this->postJson(route('admin.products.store'), [
            'parent_id' => '',
            'name' => $this->faker->sentence,
            'product_type' => 'simple',
        ]);

        $response->assertStatus(200);

        $response->assertJson([
            'created' => true,
        ]);
    }

    /** @test */
    public function name_is_required_when_creating_a_new_product()
    {
        $response = $this->postJson(route('admin.products.store'), [
            'parent_id' => '',
            // 'name' => $this->faker->sentence,
            'product_type' => $this->faker->word,
        ]);

        $response->assertExactJson([
            'errors' => [
                [
                    'name' => 'name',
                    'message' => ['The name field is required.'],
                ],
            ]
        ]);
    }

    /** @test */
    public function a_product_can_be_updated()
    {
        $response = $this->patchJson(route('admin.products.update', $this->product), [
            'parent_id' => null,
            'name' => $this->faker->sentence,
        ]);

        $response->assertStatus(200);

        $response->assertJson([
            'updated' => true,
        ]);
    }

    /** @test */
    public function name_is_required_when_updating_a_new_product()
    {
        $response = $this->patchJson(route('admin.products.update', $this->product), [
            'parent_id' => null,
            // 'name' => $this->faker->sentence,
        ]);

        $response->assertExactJson([
            'errors' => [
                [
                    'name' => 'name',
                    'message' => ['The name field is required.'],
                ],
            ]
        ]);
    }

    /** @test */
    public function a_product_can_be_deleted()
    {
        $response = $this->deleteJson(route('admin.products.destroy', $this->product), [
            //
        ]);

        $response->assertStatus(200);

        $response->assertJson([
            'deleted' => true,
        ]);
    }

    /** @test */
    public function when_a_parent_product_is_deleted_children_relation_is_deleted()
    {
        $children = $this->product->children()->save(factory(Product::class)->make());

        $this->product->delete();

        $this->assertDeleted($this->product);

        $this->assertDeleted($children);
    }

    /** @test */
    public function when_a_product_is_deleted_eavs_relation_is_deleted()
    {
        $eav = $this->product->eavs()->save(factory(Eav::class)->make());

        $this->product->delete();

        $this->assertDeleted($this->product);

        $this->assertDeleted($eav);
    }

    /** @test */
    public function when_a_product_is_deleted_categories_relation_is_detached()
    {
        $category = $this->product->categories()->save(factory(Category::class)->make());

        $this->product->delete();

        $this->assertDeleted($this->product);

        $this->assertNotNull($category->fresh());

        $this->assertCount(0, $this->product->categories);
    }

    /** @test */
    public function when_a_product_is_deleted_rewrite_relation_is_deleted()
    {
        $rewrite = $this->product->rewrite()->save(factory(Rewrite::class)->make());

        $this->product->delete();

        $this->assertDeleted($this->product);

        $this->assertDeleted($rewrite);
    }

    /** @test */
    public function a_product_has_dynamic_attributes()
    {
        foreach ([EAVBoolean::class, EAVDecimal::class, EAVInteger::class, EAVString::class, EAVText::class] as $valueType) {
            $this->product->attributes()->attach([
                factory(Attribute::class)->create(['type' => $valueType])->id => [
                    'value_type' => $valueType,
                    'value_id' => factory($valueType)->create()->id,
                ],
            ]);
        }

        foreach ($this->product->refresh()->attributes as $attribute) {
            $this->assertEquals($attribute->pivot->value->value, $this->product->{$attribute->code});
        }
    }
    
    /**
     * RELATIONS
     */

    /** @test */
    public function product_has_parent_relation()
    {
        // Many to One
        $this->product->parent_id = factory(Product::class)->create()->id;
        $this->assertInstanceOf(Product::class, $this->product->parent);

        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Relations\BelongsTo::class, $this->product->parent());
    }

    /** @test */
    public function product_has_children_relation()
    {
        // One to Many
        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Collection::class, $this->product->children);

        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Relations\HasMany::class, $this->product->children());
    }

    /** @test */
    public function product_has_eavs_relation()
    { 
        // One to Many Polymorphic
        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Collection::class, $this->product->eavs);

        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Relations\HasMany::class, $this->product->eavs());
    }

    /** @test */
    public function product_has_categories_relation()
    {
        // Many to Many
        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Collection::class, $this->product->categories);

        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Relations\BelongsToMany::class, $this->product->categories());
    }

    /** @test */
    public function product_has_rewrite_relation()
    {
        // One to One Polymorphic
        $this->assertInstanceOf(Rewrite::class, $this->product->rewrite);

        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Relations\HasOne::class, $this->product->rewrite());
    }
}
