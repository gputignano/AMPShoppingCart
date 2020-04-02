<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $fillable = [
        'page_id', 'name',
    ];

    public $timestamps = false;

    public function parent()
    {
        return $this->belongsTo(Page::class, 'page_id');
    }

    public function children()
    {
        return $this->hasMany(Page::class);
    }

    public function rewrite()
    {
        return $this->morphOne(Rewrite::class, 'rewritable');
    }
}
