<?php

namespace Ijodkor\Guard\Models\Rbac;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property $id
 * @property $name
 * @property $created_at
 * @property $updated_at
 */
class Position extends Model {
    use HasFactory;

    protected $table = "rbac.positions";

    protected $fillable = ['name'];
}
