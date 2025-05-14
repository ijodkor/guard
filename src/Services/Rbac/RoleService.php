<?php

namespace Ijodkor\Guard\Services\Rbac;


use Ijodkor\Guard\Exceptions\CommonMessageException;
use Ijodkor\Guard\Models\Rbac\Role;
use Illuminate\Database\Eloquent\Collection;

class RoleService {

    public function all(): Collection {
        return Role::query()
            ->orderBy('id')
            ->get();
    }

    public function get(): Collection {
        return Role::query()->get();
    }

    public function create(array $data): Role {
        return Role::query()->create($data);
    }

    public function find(int $id): Role {
        return Role::query()->findOrFail($id);
    }

    public function update(int $id, array $data): Role {
        $model = $this->find($id);
        if ($id == 1) {
            unset($data['type']);
            unset($data['level']);
        }

        $model->update($data);
        return $model;
    }

    /**
     * @throws CommonMessageException
     */
    public function delete(int $id): void {
        if ($id == 1) {
            throw new CommonMessageException("Primary role cannot be deleted");
        }

        $model = $this->find($id);
        $model->delete();
    }
}
