<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EAV extends Model
{
    public $table = 'eavs';

    protected $fillable = [
        'attribute_id', 'product_id', 'valuable_type', 'valuable_id',
    ];

    public $timestamps = false;

    public function valuable()
    {
        return $this->morphTo();
    }

    public function attribute()
    {
        return $this->belongsTo(Attribute::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
