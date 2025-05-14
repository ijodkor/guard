<?php

namespace Ijodkor\Guard\Http\Resources;

use Ijodkor\Guard\Models\Organization;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrganizationResource extends JsonResource {

    public function toArray(Request $request): array {
        /* @var Organization $this */

        return [
            'id' => $this->id,
            'name' => $this->name,
            'short_name' => $this->short_name,
            'tin' => $this->tin,
            'pin' => $this->pin,
            'director' => $this->director,
            'address' => $this->address,
            'region_id' => $this->region_id
        ];
    }
}
