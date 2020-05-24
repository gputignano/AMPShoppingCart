<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Rewrite extends Model
{
    protected $fillable = [
        'slug', 'meta_title', 'meta_description', 'meta_robots', 'entity_id',
    ];

    public $timestamps = false;

    public function entity()
    {
        return $this->belongsTo(
            BaseEntity::class,
            'entity_id',
            'id',
            'entity',
        );
    }
}
