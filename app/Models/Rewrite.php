<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rewrite extends Model
{
    protected $fillable = [
        'slug', 'meta_title', 'meta_description', 'meta_robots', 'template', 'enabled', 'rewritable_type', 'rewritable_id',
    ];

    public $timestamps = false;

    public function rewritable()
    {
        return $this->morphTo();
    }
}
