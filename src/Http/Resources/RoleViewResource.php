<?php

namespace Ijodkor\Guard\Http\Resources;

use Ijodkor\Guard\Models\Rbac\Role;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RoleViewResource extends JsonResource {

    public function toArray(Request $request): array {
        /* @var Role $this */
        return [
            'id' => $this->id,
            'type' => $this->type,
            'name' => $this->name,
            'title' => $this->getTranslations('title'),
            'level' => $this->level,
            'created_at' => $this->created_at
        ];
    }
}
