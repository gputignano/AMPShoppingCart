<?php

namespace Tests\Unit;

use App\EAVText;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class EAVTextModelTest extends TestCase
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
    public function an_eav_text_can_be_created()
    {
        $this->assertCount(1, EAVText::all());
        $this->assertInstanceOf(EAVText::class, $this->eavText);
    }

    /** @test */
    public function an_eav_text_can_be_updated()
    {
        $this->eavText->update([
            'value' => $value = $this->faker->paragraph,
        ]);

        $this->assertEquals($value, $this->eavText->value);
    }

    /** @test */
    public function an_eav_text_can_be_deleted()
    {
        $this->eavText->delete();

        $this->assertDeleted($this->eavText);
    }

    /**
     * RELATIONS
     */

    /** @test */
    public function eav_text_has_eavs_relation()
    {
        // One to Many Polymorphic
        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Relations\MorphMany::class, $this->eavText->eavs());
    }

    /** @test */
    public function eav_text_has_attributes_relation()
    {
        // One to Many Polymorphic
        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Relations\MorphToMany::class, $this->eavText->attributes());
    }
}
