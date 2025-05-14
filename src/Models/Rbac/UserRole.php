<?php

namespace Ijodkor\Guard\Models\Rbac;

use Ijodkor\Guard\Models\Organization;
use Ijodkor\Guard\Models\Region;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property $id
 * @property $user_id
 * @property $role_id
 * @property $created_at
 * @property $updated_at
 * @property string $region_id
 * @property string $organization_id
 *
 * @property Role $role
 * @property Region $region
 * @property Position $position
 * @property Organization $organization
 */
class UserRole extends Model {
    use HasFactory;

    protected $table = 'rbac.user_roles';

    protected $fillable = ['user_id', 'role_id', 'region_id', 'position_id', 'organization_id'];

    public function role(): BelongsTo {
        return $this->belongsTo(Role::class);
    }

    public function region(): BelongsTo {
        return $this->belongsTo(Region::class);
    }

    public function position(): BelongsTo {
        return $this->belongsTo(Position::class);
    }

    public function organization(): BelongsTo {
        return $this->belongsTo(Organization::class);
    }
}
