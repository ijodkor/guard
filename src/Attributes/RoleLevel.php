<?php

namespace Ijodkor\Guard\Attributes;

use Attribute;

#[Attribute(Attribute::TARGET_ALL)]
class RoleLevel {
    public int $position;

    public function __construct(int $position = 0) {
        $this->position = $position;
    }
}
