<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    protected $fillable = [
        'label', 'type',
    ];

    public $timestamps = false;

    public function eavs()
    {
        return $this->hasMany(EAV::class);
    }

    public function entity_types()
    {
        return $this->belongsToMany(EntityType::class);
    }

    public function values()
    {
        return $this->morphedByMany($this->type, 'value', 'attribute_value');
    }
}
