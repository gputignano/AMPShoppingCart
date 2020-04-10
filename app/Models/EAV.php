<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EAV extends Model
{
    public $table = 'eavs';

    protected $fillable = [
        'entity_type', 'entity_id', 'attribute_id', 'value_type', 'value_id',
    ];

    public $timestamps = false;

    public function entity()
    {
        return $this->morphTo();
    }

    public function attribute()
    {
        return $this->belongsTo(Attribute::class);
    }

    public function value()
    {
        return $this->morphTo();
    }
}