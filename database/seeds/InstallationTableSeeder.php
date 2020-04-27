<?php

use Illuminate\Database\Seeder;

class InstallationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // SEEDS BOOLEAN VALUES
        factory(App\Models\EAVBoolean::class)->create(['value' => false]);
        factory(App\Models\EAVBoolean::class)->create(['value' => true]);

        // SEEDS ENTITY TYPES
        factory(App\Models\EntityType::class)->create(['label' => App\Models\Category::class,]);
        factory(App\Models\EntityType::class)->create(['label' => App\Models\Page::class,]);
        factory(App\Models\EntityType::class)->create(['label' => App\Models\Product::class,]);
    }
}
