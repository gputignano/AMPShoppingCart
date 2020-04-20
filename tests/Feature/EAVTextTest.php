<?php

namespace Tests\Feature;

use App\Models\EAV;
use App\Models\EAVText;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class EAVTextTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    protected $eavText;

    protected function setUp(): void
    {
        parent::setUp();

        $this->eavText = factory(EAVText::class)->create();
    }

    /** @test */
    public function a_user_can_view_eav_text_index()
    {
        $response = $this->get(route('admin.eavTexts.index'));

        $response->assertStatus(200);

        $response->assertViewIs('admin.eavText.index');

        $response->assertSee('<h1>All EAVTexts</h1>', false);
    }

    /** @test */
    public function a_user_can_view_eav_text_create()
    {
        $response = $this->get(route('admin.eavTexts.create'));

        $response->assertStatus(200);

        $response->assertViewIs('admin.eavText.create');

        $response->assertSee('<h1>Create EAVText</h1>', false);
    }

    /** @test */
    public function a_user_can_view_eav_text_show()
    {
        $response = $this->get(route('admin.eavTexts.show', $this->eavText));

        $response->assertStatus(200);

        $response->assertViewIs('admin.eavText.show');

        $response->assertSee('<h1>Show EAVText</h1>', false);
    }

    /** @test */
    public function a_user_can_view_eav_text_edit()
    {
        $response = $this->get(route('admin.eavTexts.edit', $this->eavText));

        $response->assertStatus(200);

        $response->assertViewIs('admin.eavText.edit');

        $response->assertSee('<h1>Edit EAVText</h1>', false);
    }

    /** @test */
    public function an_eav_text_can_be_created()
    {
        $response = $this->postJson(route('admin.eavTexts.store'), [
            'value' => $this->faker->sentence,
        ]);

        $response->assertStatus(200);

        $response->assertJson([
            'created' => true,
        ]);
    }

    /** @test */
    public function value_is_required_when_creating_a_new_eav_text()
    {
        $response = $this->postJson(route('admin.eavTexts.store'), [
            // 'value' => $this->faker->sentence,
        ]);

        $response->assertExactJson([
            'errors' => [
                [
                    'name' => 'value',
                    'message' => ['The value field is required.'],
                ],
            ]
        ]);
    }

    /** @test */
    public function an_eav_text_can_be_updated()
    {
        $response = $this->patchJson(route('admin.eavTexts.update', $this->eavText), [
            'value' => $this->faker->sentence,
        ]);

        $response->assertStatus(200);

        $response->assertJson([
            'updated' => true,
        ]);
    }

    /** @test */
    public function value_is_required_when_updating_a_new_eav_text()
    {
        $response = $this->patchJson(route('admin.eavTexts.update', $this->eavText), [
            // 'value' => $this->faker->sentence,
        ]);

        $response->assertExactJson([
            'errors' => [
                [
                    'name' => 'value',
                    'message' => ['The value field is required.'],
                ],
            ]
        ]);
    }

    /** @test */
    public function an_eav_text_can_be_deleted()
    {
        $response = $this->deleteJson(route('admin.eavTexts.destroy', $this->eavText), [
            //
        ]);

        $response->assertStatus(200);

        $response->assertJson([
            'deleted' => true,
        ]);
    }

    /** @test */
    public function when_an_eav_text_is_deleted_eavs_relation_is_updated()
    {
        $eav = $this->eavText->eavs()->save(factory(EAV::class)->make());

        $this->eavText->delete();

        $this->assertDeleted($this->eavText);

        $this->assertDeleted($eav);
    }

    /**
     * RELATIONS
     */

    /** @test */
    public function eav_text_has_eavs_relation()
    {
        // One to Many Polymorphic
        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Collection::class, $this->eavText->eavs);

        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Relations\MorphMany::class, $this->eavText->eavs());
    }

    /** @test */
    public function eav_text_has_attributes_relation()
    {
        // One to Many Polymorphic
        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Collection::class, $this->eavText->attributes);

        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Relations\MorphToMany::class, $this->eavText->attributes());
    }
}
