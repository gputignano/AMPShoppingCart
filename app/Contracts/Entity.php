<?php

namespace App\Contracts;

use App\Models\Attribute;
use App\Models\EAV;
use App\Models\EntityType;
use App\Models\Rewrite;
use Illuminate\Database\Eloquent\Model;

abstract class Entity extends Model
{
    public $table = 'entities';

    protected $fillable = [
        'parent_id', 'name', 'type',
    ];

    public $timestamps = false;

    public function attributes()
    {
        return EntityType::where('label', get_class($this))->first()->belongsToMany(Attribute::class);
    }

    public function parent()
    {
        return $this->belongsTo($this, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany($this, 'parent_id');
    }

    public function eavs()
    {
        return $this->morphMany(EAV::class, 'entity');
    }

    public function rewrite()
    {
        return $this->morphOne(Rewrite::class, 'rewritable');
    }
}
