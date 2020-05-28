<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class InstallationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create Home Page and rewrite
        $home = factory(App\Models\Page::class)->create(['name' => 'Home Page', 'description' => 'Home Page Description']);
        $home->rewrite()->create(['slug' => 'home', 'meta_title' => 'Home Page', 'meta_description' => 'Meta']);

        // Create Product Type attribute
        $product_type = factory(App\Models\Attribute::class)->create([
            'label' => $label = 'Product Type',
            'code' => Str::snake($label),
            'type' => App\Models\EAVSelect::class,
            'is_system' => true,
        ]);

        // Create default values for Attribute Tupe attribute
        $product_type->values()->saveMany([
            $product_type->type::create(['value' => 'simple']),
            $product_type->type::create(['value' => 'configurable']),
        ]);

        // Create Template attribute
        $product_type = factory(App\Models\Attribute::class)->create([
            'label' => $label = 'Template',
            'code' => Str::snake($label),
            'type' => App\Models\EAVString::class,
            'is_system' => true,
        ]);
    }
}
