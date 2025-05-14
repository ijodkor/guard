<?php

namespace Ijodkor\Guard\Services;

use Ijodkor\Guard\Models\Organization;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Arr;

class OrganizationService {

    public function all(array $params) {
        $limit = Arr::get($params, 'limit', 20);
        $name = Arr::get($params, 'name');
        $tin = Arr::get($params, 'tin');

        return Organization::query()
            ->when($name, fn(Builder $q) => $q->whereLike('short_name', "%$name%"))
            ->when($tin, fn(Builder $q) => $q->whereLike('tin', "%$tin%"))
            ->paginate($limit);
    }

    public function create(array $data): Organization {
        return Organization::query()->create($data);
    }

    public function find(int $id): Organization {
        return Organization::query()->findOrFail($id);
    }

    public function get(?int $id): ?Organization {
        return $id ? Organization::query()->findOrFail($id) : null;
    }

    public function update(int $id, array $data): Organization {
        $model = $this->find($id);
        $model->update($data);
        return $model;
    }

    public function delete(int $id): void {
        $model = $this->find($id);
        $model->delete();
    }
}
