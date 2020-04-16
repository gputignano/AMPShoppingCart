<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EntityType extends Model
{
    protected $fillable = [
        'label',
    ];

    public $timestamps = false;
}
