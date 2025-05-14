<?php

namespace Ijodkor\Guard\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Translatable\HasTranslations;

/**
 * @property $id
 * @property $parent_id
 * @property $name
 * @property $names
 * @property $position
 *
 * @property Region $parent
 */
class Region extends Model {
    use HasFactory, HasTranslations;

    protected $fillable = ['id', 'parent_id', 'position', 'name', 'names'];

    public array $translatable = ['names'];

    public function parent(): BelongsTo {
        return $this->belongsTo(Region::class, 'parent_id');
    }
}
