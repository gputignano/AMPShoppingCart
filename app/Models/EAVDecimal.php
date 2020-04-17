<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EAVDecimal extends Model
{
    protected $fillable = [
        'value',
    ];

    public $timestamps = false;

    public $table = 'eav_decimals';

    public function eavs()
    {
        return $this->morphMany(EAV::class, 'value');
    }

    public function attributes()
    {
        return $this->morphToMany(Attribute::class, 'value', 'attribute_value');
    }

    protected static function booted()
    {
        parent::booted();

        static::deleting(function ($value) {
            $value->eavs()->delete();
            $value->attributes()->delete();
        });
    }
}
