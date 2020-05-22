<?php

namespace Tests\Feature;

use App\Models\Attributable;
use App\Models\Attribute;
use App\Models\EAVBoolean;
use App\Models\EAVDecimal;
use App\Models\EAVInteger;
use App\Models\EAVSelect;
use App\Models\EAVString;
use App\Models\EAVText;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductSetterTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /**
     * @test
     *
     * @return void
     */
    public function a_boolean_attribute_can_be_set_updated_and_deleted()
    {
        $attribute = factory(Attribute::class)->create([
            'type' => EAVBoolean::class,
        ]);

        $product = factory(Product::class)->create();

        // SETTING
        $product->{$attribute->label} = true;

        $this->assertTrue(true, $product->{$attribute->label});
        $this->assertCount(1, Attributable::all());
        $this->assertCount(1, EAVBoolean::all());

        // UPDATING
        // boolean attribute is true or null

        // DELETING
        $product->{$attribute->label} = null;

        $this->assertNull($product->{$attribute->label});
        $this->assertCount(0, Attributable::all());
        $this->assertCount(0, EAVBoolean::all());
    }

    /**
     * @test
     *
     * @return void
     */
    public function a_decimal_attribute_can_be_set_updated_and_deleted()
    {
        $attribute = factory(Attribute::class)->create([
            'type' => EAVDecimal::class,
        ]);
 
        $product = factory(Product::class)->create();

        // SETTING
        $product->{$attribute->label} = $value = $this->faker->randomFloat(6, 0, 9999);

        $this->assertEquals($value, $product->{$attribute->label});
        $this->assertCount(1, Attributable::all());
        $this->assertCount(1, EAVDecimal::all());

        // UPDATING
        $product->{$attribute->label} = $new_value = $this->faker->randomFloat(6, 0, 9999);

        $this->assertEquals($new_value, $product->{$attribute->label});
        $this->assertCount(1, Attributable::all());
        $this->assertCount(1, EAVDecimal::all());

        // DELETING
        $product->{$attribute->label} = null;

        $this->assertNull($product->{$attribute->label});
        $this->assertCount(0, Attributable::all());
        $this->assertCount(0, EAVDecimal::all());
    }

    /**
     * @test
     *
     * @return void
     */
    public function an_integer_attribute_can_be_set_updated_and_deleted()
    {
        $attribute = factory(Attribute::class)->create([
            'type' => EAVInteger::class,
        ]);
        $product = factory(Product::class)->create();

        // SETTING
        $product->{$attribute->label} = $value = $this->faker->randomNumber();

        $this->assertEquals($value, $product->{$attribute->label});
        $this->assertCount(1, Attributable::all());
        $this->assertCount(1, EAVInteger::all());

        // UPDATING
        $product->{$attribute->label} = $new_value = $this->faker->randomNumber();

        $this->assertEquals($new_value, $product->{$attribute->label});
        $this->assertCount(1, Attributable::all());
        $this->assertCount(1, EAVInteger::all());

        // DELETING
        $product->{$attribute->label} = null;

        $this->assertNull($product->{$attribute->label});
        $this->assertCount(0, Attributable::all());
        $this->assertCount(0, EAVInteger::all());
    }

    /**
     * @test
     *
     * @return void
     */
    public function a_select_attribute_can_be_set_updated_and_deleted()
    {
        $attribute = factory(Attribute::class)->create([
            'type' => EAVSelect::class,
        ]);

        $eav_select_one = factory($attribute->type)->create();
        $eav_select_two = factory($attribute->type)->create();

        $product = factory(Product::class)->create();

        // SETTING
        $product->{$attribute->label} = $eav_select_one->id;

        $this->assertEquals($eav_select_one->value, $product->{$attribute->label});
        $this->assertCount(1, Attributable::all());
        $this->assertCount(2, EAVSelect::all());

        // UPDATING
        $product->{$attribute->label} = $eav_select_two->id;

        $this->assertEquals($eav_select_two->value, $product->{$attribute->label});
        $this->assertCount(1, Attributable::all());
        $this->assertCount(2, EAVSelect::all());

        // DELETING
        $product->{$attribute->label} = null;

        $this->assertNull($product->{$attribute->label});
        $this->assertCount(0, Attributable::all());
        $this->assertCount(2, EAVSelect::all());
    }

    /**
     * @test
     *
     * @return void
     */
    public function a_string_attribute_can_be_set_updated_and_deleted()
    {
        $attribute = factory(Attribute::class)->create([
            'type' => EAVString::class,
        ]);

        $product = factory(Product::class)->create();

        // SETTING
        $product->{$attribute->label} = $value = $this->faker->sentence;

        $this->assertEquals($value, $product->{$attribute->label});
        $this->assertCount(1, Attributable::all());
        $this->assertCount(1, EAVString::all());

        // UPDATING
        $product->{$attribute->label} = $new_value = $this->faker->sentence;

        $this->assertEquals($new_value, $product->{$attribute->label});
        $this->assertCount(1, Attributable::all());
        $this->assertCount(1, EAVString::all());

        // DELETING
        $product->{$attribute->label} = null;

        $this->assertNull($product->{$attribute->label});
        $this->assertCount(0, Attributable::all());
        $this->assertCount(0, EAVString::all());
    }

    /**
     * @test
     *
     * @return void
     */
    public function a_text_attribute_can_be_set_updated_and_deleted()
    {
        $attribute = factory(Attribute::class)->create([
            'type' => EAVText::class,
        ]);

        $product = factory(Product::class)->create();

        // SETTING
        $product->{$attribute->label} = $value = $this->faker->paragraph;

        $this->assertEquals($value, $product->{$attribute->label});
        $this->assertCount(1, Attributable::all());
        $this->assertCount(1, EAVText::all());

        // UPDATING
        $product->{$attribute->label} = $new_value = $this->faker->paragraph;

        $this->assertEquals($new_value, $product->{$attribute->label});
        $this->assertCount(1, Attributable::all());
        $this->assertCount(1, EAVText::all());

        // DELETING
        $product->{$attribute->label} = null;

        $this->assertNull($product->{$attribute->label});
        $this->assertCount(0, Attributable::all());
        $this->assertCount(0, EAVText::all());
    }
}
