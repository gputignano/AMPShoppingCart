<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rewrite extends Model
{
    protected $fillable = [
        'slug', 'meta_title', 'meta_description', 'meta_robots', 'template', 'enabled', 'entity_id',
    ];

    public $timestamps = false;

    public function entity()
    {
        return $this->belongsTo(
            Entity::class,
            'entity_id',
            'id',
            'entity',
        );
    }
}
