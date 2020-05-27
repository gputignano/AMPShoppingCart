<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Attribute extends Model
{
    protected $fillable = [
        'label', 'code', 'type',
    ];

    public $timestamps = false;

    public $casts = [
        'is_system' => 'boolean',
    ];

    public function setLabelAttribute($label)
    {
        $this->attributes['label'] = $label;
        $this->attributes['code'] = Str::slug($label);
    }

    // SCOPES
    public function scopeIsSystem($query, $flag)
    {
        return $query->where('is_system', $flag);
    }

    // RELATIONS
    public function attribute_sets()
    {
        return $this->belongsToMany(
            AttributeSet::class,
            'attribute_attribute_set',
            'attribute_id',
            'attribute_set_id',
            'id',
            'id',
            'attribute_sets',
        );
    }

    public function products()
    {
        return $this->belongsToMany(
            Product::class,
            'attributable',
            'attribute_id',
            'attributable_id',
            'id',
            'id',
            'products',
        )->as('attributable')->withPivot([
            'value_type',
            'value_id',
        ])->using(Attributable::class);
    }

    public function values()
    {
        return $this->morphedByMany(
            $this->type,
            'value',
            'attribute_value',
            'attribute_id',
            'value_id',
            'id',
            'id',
        );
    }
}
