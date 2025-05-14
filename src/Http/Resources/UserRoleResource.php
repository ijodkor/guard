<?php

namespace Ijodkor\Guard\Http\Resources;

use Ijodkor\Guard\Models\Rbac\UserRole;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserRoleResource extends JsonResource {

    public function toArray(Request $request): array {
        /* @var UserRole $this */
        $role = $this->role;
        $region = $this->region;

        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'role' => [
                'id' => $this->role_id,
                'title' => $role->getTranslation('title', 'uz'),
            ],
            'region' => [
                'id' => $region?->id,
                'name' => $region?->names
            ],
            'organization' => $this->organization?->short_name,
            'created_at' => $this->created_at
        ];
    }
}
