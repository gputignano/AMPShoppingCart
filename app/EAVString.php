<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EAVString extends Model
{
    protected $fillable = [
        'value',
    ];

    public $timestamps = false;

    public $table = 'eav_strings';

    public function eavs()
    {
        return $this->morphMany(EAV::class, 'value');
    }

    public function attribute()
    {
        return $this->morphToMany(Attribute::class, 'attributable');
    }
}
