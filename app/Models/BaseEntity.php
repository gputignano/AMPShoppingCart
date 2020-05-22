<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class BaseEntity extends Model
{
    public $table = 'entities';

    protected $fillable = [
        'parent_id', 'name', 'description', 'type',
    ];

    public $timestamps = false;

    public function __get($key)
    {
        return $this->getAttribute($key) ?? optional(optional(optional($this->attributes()->where('code', 'like', $key)->first())->eav)->value)->value;
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
                    $this->attributes()->where('code', $key)->first()->eav->value->delete();
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
                    $this->attributes()->where('code', $key)->first()->eav->value->update(['value' => $value]);
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

    public function attributes()
    {
        return $this->belongsToMany(
            Attribute::class,
            'attributable',
            'entity_id',
            'attribute_id',
            'id',
            'id',
            'attributes,'
        )->as('eav')->withPivot([
            'value_type',
            'value_id',
        ])->using(Attributable::class);
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

    public function children()
    {
        return $this->hasMany(
            $this,
            'parent_id',
            'id',
        );
    }

    public function eavs($attribute_id = null)
    {
        return $this->hasMany(
            Attributable::class,
            'entity_id',
            'id',
        )
        ->when($attribute_id, function ($query, $attribute_id) {
            return $query->where('attribute_id', $attribute_id );
        });
    }

    public function rewrite()
    {
        return $this->hasOne(
            Rewrite::class,
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

        static::addGlobalScope('type', function (Builder $builder) {
            $builder->where('type', static::class);
        });
    }
}
