<?php

namespace Ijodkor\Guard\Models\Rbac;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

/**
 * @property $id
 * @property $type
 * @property $name
 * @property $title
 * @property $level
 * @property $created_at
 * @property $updated_at
 */
class Role extends Model {
    use HasFactory, HasTranslations, SoftDeletes;

    protected $table = "rbac.roles";

    public array $translatable = ['title'];

    protected $fillable = ['type', 'name', 'title', 'level'];
}
