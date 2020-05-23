<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AttributeSet extends Model
{
    protected $fillable = [
        'label',
    ];

    public $timestamps = false;

    public function attributes()
    {
        return $this->belongsToMany(
            Attribute::class,
            'attribute_attribute_set',
            'attribute_set_id',
            'attribute_id',
            'id',
            'id',
            'attributes',
        );
    }
}
