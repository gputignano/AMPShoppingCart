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
    public function attributes_table_has_expected_columns()
    {
        $this->assertTrue(
            Schema::hasColumns('attributes', $fields = [
                'id',
                'label',
                'type',
            ])
        );

        $this->assertCount(count($fields), Schema::getColumnListing('attributes'));
    }

    /** @test */
    public function attribute_attribute_set_table_has_expected_columns()
    {
        $this->assertTrue(
            Schema::hasColumns('attribute_attribute_set', $fields = [
                'attribute_id',
                'attribute_set_id',
            ])
        );

        $this->assertCount(count($fields), Schema::getColumnListing('attribute_attribute_set'));
    }

    /** @test */
    public function product_attribute_value_strings_table_has_expected_columns()
    {
        $this->assertTrue(
            Schema::hasColumns('product_attribute_value_strings', $fields = [
                'id',
                'attribute_id',
                'value',
            ])
        );

        $this->assertCount(count($fields), Schema::getColumnListing('product_attribute_value_strings'));
    }

    /** @test */
    public function products_table_has_expected_columns()
    {
        $this->assertTrue(
            Schema::hasColumns('products', $fields = [
                'id',
                'parent_id',
                'attribute_set_id',
                'name',
                'code',
                'price',
                'quantity',
            ])
        );

        $this->assertCount(count($fields), Schema::getColumnListing('products'));
    }

    /** @test */
    public function pages_table_has_expected_columns()
    {
        $this->assertTrue(
            Schema::hasColumns('pages', $fields = [
                'id',
                'parent_id',
                'name',
            ])
        );

        $this->assertCount(count($fields), Schema::getColumnListing('pages'));
    }

    /** @test */
    public function categories_table_has_expected_columns()
    {
        $this->assertTrue(
            Schema::hasColumns('categories', $fields = [
                'id',
                'parent_id',
                'name',
            ])
        );

        $this->assertCount(count($fields), Schema::getColumnListing('categories'));
    }

    /** @test */
    public function rewrites_table_has_expected_columns()
    {
        $this->assertTrue(
            Schema::hasColumns('rewrites', $fields = [
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

        $this->assertCount(count($fields), Schema::getColumnListing('rewrites'));
    }

    /** @test */
    public function category_product_has_expected_columns()
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
    public function attribute_product_has_expected_columns()
    {
        $this->assertTrue(
            Schema::hasColumns('attribute_product', $fields = [
                'id',
                'attribute_id',
                'product_id',
                'valuable_type',
                'valuable_id',
            ])
        );

        $this->assertCount(count($fields), Schema::getColumnListing('attribute_product'));
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
