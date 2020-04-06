<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EAVBoolean extends Model
{
    protected $fillable = [
        'value',
    ];

    public $timestamps = false;

    public $table = 'eav_booleans';

    public function eavs()
    {
        return $this->morphMany(EAV::class, 'value_eavable');
    }
}