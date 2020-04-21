<?php

namespace App\Contracts;

use App\Models\Attribute;
use App\Models\EAV;
use Illuminate\Database\Eloquent\Model;

abstract class EAVValue extends Model
{
    protected $fillable = [
        'value',
    ];

    public $timestamps = false;

    public function eavs()
    {
        return $this->morphMany(EAV::class, 'value');
    }

    public function attributes()
    {
        return $this->morphToMany(Attribute::class, 'value', 'attribute_value' );
    }

    protected static function booted()
    {
        parent::booted();

        static::deleting(function ($value) {
            $value->eavs()->delete();
        });
    }
}
