<?php

namespace Ijodkor\Guard\Http\Resources;

use Ijodkor\Guard\Models\Rbac\Position;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PositionResource extends JsonResource {

    public function toArray(Request $request): array {
        /* @var Position $this */
        return [
            'id' => $this->id,
            'name' => $this->name
        ];
    }
}
