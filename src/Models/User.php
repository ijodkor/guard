<?php

namespace Ijodkor\Guard\Models;

use Ijodkor\Guard\Models\Rbac\UserRole;
use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as IAuthenticatable;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Tymon\JWTAuth\Contracts\JWTSubject;

/**
 * @property int $id
 * @property int $pin
 * @property string $name
 * @property string $username
 * @property string $password
 * @property string $email
 * @property string $created_at
 *
 * @property Collection<UserRole> $roles
 * @property Organization $organization
 */
class User extends Model implements IAuthenticatable, JWTSubject {
    use HasFactory, Authenticatable;

    protected $table = 'users.users';

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'pin',
        'username',
        'password',
        'email'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function getJWTIdentifier() {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims(): array {
        return [];
    }

    /** Relations */
    public function roles(): HasMany {
        return $this->hasMany(UserRole::class);
    }
}
