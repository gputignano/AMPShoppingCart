<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class Entity extends Model
{
    public $table = 'entities';

    protected $fillable = [
        'name', 'description', 'type',
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
        return optional(optional(optional($this->attributes()->where('code', 'like', $key)->first())->attributable)->value)->value ? true : false;
    }

    public function getTemplate() : string
    {
        return $this->template ?? class_basename($this->type);
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

    protected static function booted()
    {
        parent::booted();

        static::creating(function ($entity) {
            $entity->forceFill([
                'type' => static::class,
            ]);
        });

        static::deleting(function ($entity) {
            $entity->rewrite()->delete();
        });

        static::addGlobalScope('type', function (Builder $builder) {
            $builder->where('type', static::class);
        });
    }
}
