<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EAVValue extends Model
{
    protected $fillable = [
        'value',
    ];

    public $timestamps = false;

    public static $hasDefaultValues = false;

    public function attributable()
    {
        return $this->morphOne(
            Attributable::class,
            'value',
            'value_type',
            'value_id',
            'id',
        );
    }

    public function attributes()
    {
        return $this->morphToMany(
            Attribute::class,
            'value',
            'attribute_value',
            'value_id',
            'value_id',
            'id',
            'id',
            null,
        );
    }

    protected static function booted()
    {
        parent::booted();

        static::deleting(function ($value) {
            $value->attributable()->delete();
        });
    }

    public static function findOrCreate($product, $attribute, $value)
    {
        if ($attribute->type::$hasDefaultValues) return $value;

        return self::updateOrCreate(
            ['id' => optional(optional($product->attributables($attribute->id)->first())->value)->id,],
            ['value' => $value,],
        )->id;
    }
}
