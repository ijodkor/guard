<?php

namespace Ijodkor\Guard\Models;

use Ijodkor\Guard\Models\Rbac\UserRole;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property $id
 * @property $name
 * @property $short_name
 * @property $tin
 * @property $pin
 * @property $director
 * @property $address
 * @property $region_id
 *
 * @property Collection<User> $users
 * @property Collection<UserRole> $roles
 */
class Organization extends Model {
    use HasFactory, SoftDeletes;

    protected $table = 'users.organizations';

    protected $fillable = [
        'name', 'short_name', 'tin', 'pin', 'director', 'address', 'region_id',
        // 'position' -> order
    ];

    /** Relations */
    public function roles(): HasMany {
        return $this->hasMany(UserRole::class);
    }

    public function users(): HasManyThrough {
        return $this->hasManyThrough(User::class, UserRole::class, 'organization_id', 'id');
    }
}
