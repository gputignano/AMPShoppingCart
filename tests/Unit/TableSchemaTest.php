<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class TableSchemaTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function users_table_has_expected_columns()
    {
        $this->assertCount(7, Schema::getColumnListing('users'));

        $this->assertTrue(
            Schema::hasColumns('users', [
                'id',
                // 'name',
                'email',
                'email_verified_at',
                'password',
                'remember_token',
                'created_at',
                'updated_at',
            ])
        );
    }

    /** @test */
    public function attribute_sets_table_has_expected_columns()
    {
        $this->assertTrue(
            Schema::hasColumns('attribute_sets', [
                'id',
                'label',
            ])
        );
    }

    /** @test */
    public function attributes_table_has_expected_columns()
    {
        $this->assertTrue(
            Schema::hasColumns('attributes', [
                'id',
                'label',
                'type',
            ])
        );
    }

    /** @test */
    public function attribute_attribute_set_table_has_expected_columns()
    {
        $this->assertTrue(
            Schema::hasColumns('attribute_attribute_set', [
                'attribute_id',
                'attribute_set_id',
            ])
        );
    }

    /** @test */
    public function product_attribute_value_strings_table_has_expected_columns()
    {
        $this->assertTrue(
            Schema::hasColumns('product_attribute_value_strings', [
                'id',
                'attribute_id',
                'value',
            ])
        );
    }

    /** @test */
    public function products_table_has_expected_columns()
    {
        $this->assertTrue(
            Schema::hasColumns('products', [
                'id',
                'parent_id',
                'attribute_set_id',
                'name',
                'code',
                'price',
                'quantity',
            ])
        );
    }

    /** @test */
    public function pages_table_has_expected_columns()
    {
        $this->assertTrue(
            Schema::hasColumns('pages', [
                'id',
                'parent_id',
                'name',
            ])
        );
    }

    /** @test */
    public function categories_table_has_expected_columns()
    {
        $this->assertTrue(
            Schema::hasColumns('categories', [
                'id',
                'parent_id',
                'name',
            ])
        );
    }

    /** @test */
    public function rewrites_table_has_expected_columns()
    {
        $this->assertTrue(
            Schema::hasColumns('rewrites', [
                'id',
                'slug',
                'title',
                'description',
                'robots',
                'template',
                'enabled',
                'rewritable_type',
                'rewritable_id',
            ])
        );
    }

    /** @test */
    public function category_product_has_expected_columns()
    {
        $this->assertTrue(
            Schema::hasColumns('category_product', [
                'category_id',
                'product_id',
            ])
        );
    }

    /** @test */
    public function attribute_product_has_expected_columns()
    {
        $this->assertTrue(
            Schema::hasColumns('attribute_product', [
                'attribute_id',
                'product_id',
                'valuable_type',
                'valuable_id',
            ])
        );
    }

    /** @test */
    public function orders_table_has_expected_columns()
    {
        $this->assertTrue(
            Schema::hasColumns('orders', [
                'id',
                'user_id',
                'created_at',
                'updated_at',
            ])
        );
    }

    /** @test */
    public function order_details_table_has_expected_columns()
    {
        $this->assertTrue(
            Schema::hasColumns('order_details', [
                'id',
                'order_id',
                'code',
                'name',
                'price',
                'quantity',
            ])
        );
    }
}
