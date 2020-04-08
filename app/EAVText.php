<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EAVText extends Model
{
    protected $fillable = [
        'value',
    ];

    public $timestamps = false;

    public $table = 'eav_texts';

    public function eavs()
    {
        return $this->morphMany(EAV::class, 'value');
    }

    public function attributes()
    {
        return $this->morphToMany(Attribute::class, 'value', 'attribute_value');
    }
}
