<?php

namespace Ijodkor\Guard\Services\Rbac;

use Ijodkor\Guard\Exceptions\CommonMessageException;
use Ijodkor\Guard\Models\Rbac\UserRole;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Arr;

class UserRoleService {

    public function all(): Collection {
        return UserRole::query()->get();
    }

    /**
     * @throws CommonMessageException
     */
    public function create(array $data): UserRole {
        if (Arr::get($data, 'region_id') == null) {
            $data['region_id'] = 17;
        }

        if (Arr::get($data, 'position_id') == null) {
            unset($data['position_id']);
        }

        $exist = UserRole::query()
            ->where('user_id', Arr::get($data, 'user_id'))
            ->where('role_id', Arr::get($data, 'role_id'))
            ->where('organization_id', Arr::get($data, 'organization_id'))
            ->where('region_id', Arr::get($data, 'region_id'))
            ->exists();

        if ($exist) {
            throw new CommonMessageException("User has already such role!");
        }

        return UserRole::query()->create($data);
    }

    public function find(int $id): UserRole {
        return UserRole::query()->findOrFail($id);
    }

    public function update(int $id, array $data): UserRole {
        $model = $this->find($id);
        $model->update($data);
        return $model;
    }

    public function delete(int $id): void {
        $model = $this->find($id);
        $model->delete();
    }
}
