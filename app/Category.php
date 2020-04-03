<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'category_id', 'name',
    ];

    public $timestamps = false;

    public function parent()
    {
        return $this->belongsTo($this, 'category_id');
    }

    public function children()
    {
        return $this->hasmany($this);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }

    public function rewrite()
    {
        return $this->morphOne(Rewrite::class, 'rewritable');
    }
}
