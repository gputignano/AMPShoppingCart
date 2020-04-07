<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    protected $fillable = [
        'label', 'type',
    ];

    public $timestamps = false;

    public function attribute_sets()
    {
        return $this->belongsToMany(AttributeSet::class);
    }

    public function eavs()
    {
        return $this->hasMany(EAV::class);
    }

    public function attributables()
    {
        return $this->morphedByMany($this->type, 'attributable');
    }
}
