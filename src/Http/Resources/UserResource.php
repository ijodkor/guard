<?php

namespace Ijodkor\Guard\Http\Resources;

use Ijodkor\Guard\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource {

    public function toArray(Request $request): array {
        /* @var User $this */
        // $organization = $this->organization;

        return [
            'id' => $this->id,
            'name' => $this->name,
            'pin' => $this->pin,
            'username' => $this->username,
            'organization' => [
                'id' => null,
                'tin' => null,
                'name' => null,
                'short_name' => null,
            ],
            'created_at' => $this->created_at
        ];
    }
}

