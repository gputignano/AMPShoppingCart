<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class TableSchemaTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function users_table_has_expected_columns()
    {
        $this->assertTrue(
            Schema::hasColumns('users', $fields = [
                'id',
                'email',
                'email_verified_at',
                'password',
                'remember_token',
                'created_at',
                'updated_at',
            ])
        );

        $this->assertCount(count($fields), Schema::getColumnListing('users'));
    }

    /** @test */
    public function attributes_table_has_expected_columns()
    {
        $this->assertTrue(
            Schema::hasColumns('attributes', $fields = [
                'id',
                'label',
                'code',
                'type',
                'is_system',
                'is_visible_on_front',
            ])
        );

        $this->assertCount(count($fields), Schema::getColumnListing('attributes'));
    }

    /** @test */
    public function attribute_sets_table_has_expected_columns()
    {
        $this->assertTrue(
            Schema::hasColumns('attribute_sets', $fields = [
                'id',
                'label',
            ])
        );

        $this->assertCount(count($fields), Schema::getColumnListing('attribute_sets'));
    }

    /** @test */
    public function eav_booleans_table_has_expected_columns()
    {
        $this->assertTrue(
            Schema::hasColumns('eav_booleans', $fields = [
                'id',
                'value',
            ])
        );

        $this->assertCount(count($fields), Schema::getColumnListing('eav_booleans'));
    }

    /** @test */
    public function eav_decimals_table_has_expected_columns()
    {
        $this->assertTrue(
            Schema::hasColumns('eav_decimals', $fields = [
                'id',
                'value',
            ])
        );

        $this->assertCount(count($fields), Schema::getColumnListing('eav_decimals'));
    }

    /** @test */
    public function eav_integers_table_has_expected_columns()
    {
        $this->assertTrue(
            Schema::hasColumns('eav_integers', $fields = [
                'id',
                'value',
            ])
        );

        $this->assertCount(count($fields), Schema::getColumnListing('eav_integers'));
    }

    /** @test */
    public function eav_strings_table_has_expected_columns()
    {
        $this->assertTrue(
            Schema::hasColumns('eav_strings', $fields = [
                'id',
                'value',
            ])
        );

        $this->assertCount(count($fields), Schema::getColumnListing('eav_strings'));
    }

    /** @test */
    public function eav_texts_table_has_expected_columns()
    {
        $this->assertTrue(
            Schema::hasColumns('eav_texts', $fields = [
                'id',
                'value',
            ])
        );

        $this->assertCount(count($fields), Schema::getColumnListing('eav_texts'));
    }

    /** @test */
    public function attribute_value_table_has_expected_columns()
    {
        $this->assertTrue(
            Schema::hasColumns('attribute_value', $fields = [
                'attribute_id',
                'value_type',
                'value_id',
            ])
        );
    }

    /** @test */
    public function categories_table_has_expected_columns()
    {
        $this->assertTrue(
            Schema::hasColumns('categories', $fields = [
                'id',
                'parent_id',
                'name',
                'description',
            ])
        );

        $this->assertCount(count($fields), Schema::getColumnListing('categories'));
    }

    /** @test */
    public function pages_table_has_expected_columns()
    {
        $this->assertTrue(
            Schema::hasColumns('pages', $fields = [
                'id',
                'parent_id',
                'name',
                'description',
            ])
        );

        $this->assertCount(count($fields), Schema::getColumnListing('pages'));
    }

    /** @test */
    public function products_table_has_expected_columns()
    {
        $this->assertTrue(
            Schema::hasColumns('products', $fields = [
                'id',
                'parent_id',
                'name',
                'description',
                'type',
                'attribute_set_id',
            ])
        );

        $this->assertCount(count($fields), Schema::getColumnListing('products'));
    }

    /** @test */
    public function rewrites_table_has_expected_columns()
    {
        $this->assertTrue(
            Schema::hasColumns('rewrites', $fields = [
                'id',
                'slug',
                'meta_title',
                'meta_description',
                'meta_robots',
                'entity_type',
                'entity_id',
                'is_active',
            ])
        );

        $this->assertCount(count($fields), Schema::getColumnListing('rewrites'));
    }

    /** @test */
    public function category_product_table_has_expected_columns()
    {
        $this->assertTrue(
            Schema::hasColumns('category_product', $fields = [
                'category_id',
                'product_id',
            ])
        );

        $this->assertCount(count($fields), Schema::getColumnListing('category_product'));
    }

    /** @test */
    public function attributable_table_has_expected_columns()
    {
        $this->assertTrue(
            Schema::hasColumns('attributable', $fields = [
                'attributable_id',
                'attribute_id',
                'value_type',
                'value_id',
            ])
        );

        $this->assertCount(count($fields), Schema::getColumnListing('attributable'));
    }

    /** @test */
    public function orders_table_has_expected_columns()
    {
        $this->assertTrue(
            Schema::hasColumns('orders', $fields = [
                'id',
                'user_id',
                'created_at',
                'updated_at',
            ])
        );

        $this->assertCount(count($fields), Schema::getColumnListing('orders'));
    }

    /** @test */
    public function order_details_table_has_expected_columns()
    {
        $this->assertTrue(
            Schema::hasColumns('order_details', $fields = [
                'id',
                'order_id',
                'code',
                'name',
                'price',
                'quantity',
            ])
        );

        $this->assertCount(count($fields), Schema::getColumnListing('order_details'));
    }
}
