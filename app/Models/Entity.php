<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Entity extends Model
{
    // public $table = 'entities';

    protected $fillable = [
        'parent_id', 'name', 'description',
    ];

    public $timestamps = false;

    public function __get($key)
    {
        return $this->getAttribute($key) ?? optional(optional(optional($this->attributes()->where('code', 'like', $key)->first())->attributable)->value)->value;
    }

    public function __set($key, $value)
    {
        // SKIP IF $KEY IS ALREADY A MODEL ATTRIBUTE OR RELATIONSHIP
        if ($this->getAttribute($key))
        {
            parent::__set($key, $value);

            return;
        }

        $attribute = Attribute::where('code', $key)->first();

        // SKIP IF ATTRIBUTE DOES NOT EXISTS
        if (null === $attribute) return;

        // NOW ATTRIBUTE EXISTS

        // VALUE IS NULL
        if (null === $value)
        {
            if (null !== $this->{$key})
            {
                // IF EAV* HAS NOT DEFAULT VALUES I NEED TO REMOVE THE VALUE
                if (! $attribute->type::$hasDefaultValues)
                {
                    $this->attributes()->where('code', $key)->first()->attributable->value->delete();
                }

                $this->attributes()->detach($attribute->id);
            }
        } else {
            if ($this->attributes()->where('code', $key)->count())
            { // UPDATE
                 if ($attribute->type::$hasDefaultValues)
                {
                    if ($attribute->type::find($value))
                        $this->attributes()->updateExistingPivot($attribute->id, [
                            'value_id' => $value,
                        ]);
                } else {
                    $this->attributes()->where('code', $key)->first()->attributable->value->update(['value' => $value]);
                }
            } else { // CREATE
                if ($attribute->type::$hasDefaultValues)
                {
                    $this->attributes()->attach($attribute->id, [
                        'value_type' => $attribute->type,
                        'value_id' => $value,
                    ]);
                } else {
                    $new_value = $attribute->type::create(['value' => $value]);

                    $this->attributes()->attach($attribute->id, [
                        'value_type' => $attribute->type,
                        'value_id' => $new_value->id,
                    ]);
                }
            }
        }
    }

    public function __isset($key) : bool
    {
        return $this->getAttribute($key) || optional(optional(optional($this->attributes()->where('code', 'like', $key)->first())->attributable)->value)->value ? true : false;
    }

    public function scopeWithRewrite($query)
    {
        return $query->has('rewrite');
    }

    // RELATIONS
    public function attributes()
    {
        return $this->belongsToMany(
            Attribute::class,
            'attributable',
            'attributable_id',
            'attribute_id',
            'id',
            'id',
            'attributes,'
        )->as('attributable')->withPivot([
            'value_type',
            'value_id',
        ])->using(Attributable::class);
    }

    public function rewrite()
    {
        return $this->morphOne(
            Rewrite::class,
            'rewrite',
            'entity_type',
            'entity_id',
            'id',
        );
    }

    public function children()
    {
        return $this->hasMany(
            $this,
            'parent_id',
            'id',
        );
    }

    public function parent()
    {
        return $this->belongsTo(
            $this,
            'parent_id',
            'id',
            'parent',
        );
    }

    protected static function booted()
    {
        parent::booted();

        static::deleting(function ($entity) {
            $entity->rewrite()->delete();
        });
    }
}
