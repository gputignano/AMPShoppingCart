<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $fillable = [
        'parent_id', 'name',
    ];

    public $timestamps = false;
}
