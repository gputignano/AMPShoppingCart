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
        return $this->belongsToMany(Attribute::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }
}
