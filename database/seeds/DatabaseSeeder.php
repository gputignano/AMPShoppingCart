<?php

use App\Models\Attribute;
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
        $this->call(AttributeValueTableSeeder::class);
        $this->call(ProductsTableSeeder::class);
        $this->call(PagesTableSeeder::class);
        $this->call(CategoriessTableSeeder::class);
        $this->call(AttributeSetProductTableSeeder::class);
        $this->call(RewritesTableSeeder::class);
        $this->call(CategoryProductTableSeeder::class);
        $this->call(EAVsTableSeeder::class);
    }
}
