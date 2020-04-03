<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EAV extends Model
{
    public $table = 'eavs';

    protected $fillable = [
        'entity_eavable_type', 'entity_eavable_id', 'attribute_id', 'value_eavable_type', 'valuae_eavble_id',
    ];

    public $timestamps = false;

    public function entity_eavable()
    {
        return $this->morphTo();
    }

    public function attribute()
    {
        return $this->belongsTo(Attribute::class);
    }

    public function value_eavable()
    {
        return $this->morphTo();
    }
}
