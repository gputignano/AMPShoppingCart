<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rewrite extends Model
{
    protected $fillable = [
        'slug', 'title', 'description', 'robots', 'template', 'enabled', 'rewritable_type', 'rewritable_id',
    ];

    public $timestamps = false;

    public function rewritable()
    {
        return $this->morphTo();
    }
}