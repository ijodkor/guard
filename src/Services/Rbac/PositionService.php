<?php

namespace Ijodkor\Guard\Services\Rbac;

use Ijodkor\Guard\Models\Rbac\Position;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class PositionService {
    public function all(): Collection {
        return Position::query()->get();
    }

    public function create(array $data): Model|Position {
        return Position::query()->create($data);
    }

    public function find(int $id): Model|Position {
        return Position::query()->findOrFail($id);
    }

    public function update(int $id, array $data): Model|Position {
        $model = $this->find($id);
        $model->update($data);
        return $model;
    }

    public function delete(int $id): void {
        $model = $this->find($id);
        $model->delete();
    }
}
