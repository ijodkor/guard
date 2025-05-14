<?php

namespace Ijodkor\Guard\Services;

use Exception;
use Ijodkor\Guard\Models\User;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

class UserService {

    public function all(array $params) {
        return User::query()
            ->when(Arr::get($params, 'username'), fn(Builder $query) => $query->where('username', $params['username']))
            ->when(Arr::get($params, 'pin'), fn(Builder $query) => $query->where('pin', $params['pin']))
            ->when(Arr::get($params, 'name'), fn(Builder $query) => $query->whereLike('name', '%' . $params['name'] . '%'))
            ->orderBy('id')
            ->paginate(Arr::get($params, 'limit', 20));
    }

    public function create(array $data): Model|User {
        return User::query()->create($data);
    }

    public function find(int $id): Model|User {
        return User::query()->findOrFail($id);
    }

    public function findByPin(int $pin): ?User {
        return User::query()
            ->where('pin', $pin)
            ->first();
    }

    public function update(int $id, array $data): Model|User {
        $model = $this->find($id);
        $model->update($data);
        return $model;
    }

    public function delete(int $id): void {
        $model = $this->find($id);
        $model->delete();
    }

    /**
     * @throws Exception
     */
    public function createUnnamed(array $data): User {
        $exist = User::query()->where('pin', $data['pin'])->exists();
        if ($exist) {
            throw new Exception("User already exist!");
        }

        return User::query()->create([
            ...$data,
            'name' => '',
            'username' => $data['pin']
        ]);
    }
}
