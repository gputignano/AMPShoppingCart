<?php

namespace App\Contracts;

use Illuminate\Database\Eloquent\Model;

abstract class Entity extends Model
{
    public $table = 'entities';

    protected $fillable = [
        'parent_id', 'name', 'type',
    ];

    public $timestamps = false;
}
