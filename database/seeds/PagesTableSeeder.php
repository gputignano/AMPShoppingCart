<?php

use App\Models\Page;
use Illuminate\Database\Seeder;

class PagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Page::create([
            'id' => 6,
            'parent_id' => 0,
            'name' => 'home',
            'type' => 'page',
        ]);

        Page::create([
            'id' => 7,
            'parent_id' => 0,
            'name' => 'Contacts',
            'type' => 'page',
        ]);
    }
}
