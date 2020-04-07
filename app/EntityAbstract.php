<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

abstract class EntityAbstract extends Model
{
    public $table = 'entities';

    protected $fillable = [
        'parent_id', 'name', 'type',
    ];

    public $timestamps = false;

    protected static function booted()
    {
        //
    }
}
