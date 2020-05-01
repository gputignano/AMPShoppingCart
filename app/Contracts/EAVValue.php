<?php

namespace App\Contracts;

use App\Models\Attribute;
use App\Models\EAV;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

abstract class EAVValue extends Model
{
    protected $fillable = [
        'value',
    ];

    public $timestamps = false;

    public static $hasDefaultValues = false;

    public function eavs()
    {
        return $this->morphMany(EAV::class, 'value');
    }

    public function attributes()
    {
        return $this->morphToMany(Attribute::class, 'value', 'attribute_value' );
    }

    abstract static function getInputBlade($product, $attribute);

    protected static function booted()
    {
        parent::booted();

        static::deleting(function ($value) {
            $value->eavs()->delete();
        });
    }

    public static function getValueId($product, $attribute, $value)
    {
        if (null == $value)
        {
            $eav = $product->eavs()->where('attribute_id', $attribute->id)->first();

            if (self::$hasDefaultValues)
            {
                optional(optional($eav)->value)->delete();
            }

            optional($eav)->delete();

            return null;
        }

        if (count($attribute->values) > 0) return $value;

        return self::updateOrCreate(
            ['id' => optional(optional($product->eavs()->where('attribute_id', $attribute->id)->first())->value)->id,],
            ['value' => $value,],
        )->id;
    }
}
