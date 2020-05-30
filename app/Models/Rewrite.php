<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Rewrite extends Model
{
    protected $fillable = [
        'slug', 'meta_title', 'meta_description', 'meta_robots', 'entity_type', 'entity_id', 'is_active',
    ];

    public $timestamps = false;

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function getLastSlugAttribute()
    {
        return Str::afterLast($this->slug, '/');
    }

    public function setSlugAttribute($slug)
    {
        $parent_slug = $this->entity->parent->rewrite->slug ?? '';

        $this->attributes['slug'] = $parent_slug ? $parent_slug . '/' . $slug : $slug;
    }

    // RELATIONS
    public function entity()
    {
        return $this->morphTo(
            'entity',
            'entity_type',
            'entity_id',
            'id',
        );
    }

    protected static function booted()
    {
        parent::booted();

        static::saved(function ($rewrite) {
            if (null != $rewrite->entity)
            {
                foreach ($rewrite->entity->children as $children) {
                    if ($children->rewrite) $children->rewrite->update([
                        'slug' => $children->rewrite->last_slug,
                    ]);
                }
            }
        });
    }
}
