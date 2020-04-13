<?php

namespace Tests\Feature;

use App\Models\Attribute;
use App\Models\Category;
use App\Models\EAV;
use App\Models\EAVBoolean;
use App\Models\EAVDecimal;
use App\Models\EAVInteger;
use App\Models\EAVString;
use App\Models\EAVText;
use App\Models\Page;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class EAVTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /** @test */
    public function an_eav_can_be_created()
    {
        $entity = factory($this->faker->randomElement([
            Category::class,
            Page::class,
            Product::class,
        ]))->create();
        $attribute = factory(Attribute::class)->create();
        $value = factory($this->faker->randomElement([
            EAVBoolean::class,
            EAVDecimal::class,
            EAVInteger::class,
            EAVString::class,
            EAVText::class,
        ]))->create();

        $response = $this->postJson(route('eavs.store'), [
            'entity_type' => get_class($entity),
            'entity_id' => $entity->id,
            'attribute_id' => $attribute->id,
            'value_type' => get_class($value),
            'value_id' => $value->id,
        ]);

        $response->assertStatus(201);
        $response->assertJson([
            'created' => true,
        ]);
    }

    /** @test */
    public function an_eav_can_be_updated()
    {
        $eav = factory(EAV::class)->create();
        $entity = factory($this->faker->randomElement([
            Category::class,
            Page::class,
            Product::class,
        ]))->create();
        $attribute = factory(Attribute::class)->create();
        $value = factory($this->faker->randomElement([
            EAVBoolean::class,
            EAVDecimal::class,
            EAVInteger::class,
            EAVString::class,
            EAVText::class,
        ]))->create();

        $response = $this->patchJson(route('eavs.update', $eav), [
            'entity_type' => get_class($entity),
            'entity_id' => $entity->id,
            'attribute_id' => $attribute->id,
            'value_type' => get_class($value),
            'value_id' => $value->id,
        ]);

        $response->assertStatus(200);
        $response->assertJson([
            'updated' => true,
        ]);
    }

    /** @test */
    public function an_eav_can_be_deleted()
    {
        $eav = factory(EAV::class)->create();

        $response = $this->deleteJson(route('eavs.destroy', $eav), [
            //
        ]);

        $response->assertStatus(200);
        $response->assertJson([
            'deleted' => true,
        ]);
    }
}
