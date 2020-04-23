<?php

use App\Models\EAVBoolean;
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
        factory(EAVBoolean::class)->create(['value' => false]);
        factory(EAVBoolean::class)->create(['value' => true]);
    }
}
