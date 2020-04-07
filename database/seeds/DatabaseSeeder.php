<?php

use App\Attribute;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(AttributeSetsTableSeeder::class);
        $this->call(AttributesTableSeeder::class);
        $this->call(AttributeAttributeSetTableSeeder::class);
        $this->call(AttributablesTableSeeder::class);
    }
}
