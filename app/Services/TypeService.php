<?php

namespace App\Services;

use App\Models\Type;

class TypeService
{
    private Type $type;

    public function setType(Type $type){
        $this->type = $type;
        return $this;
    }

    public function getObject(): Type
    {
        return $this->type->fresh();
    }

    public function create(array $data): self
    {
        Type::create($data);
        return $this;
    }

    public function update(array $data): self
    {
        $this->type->update($data);
        return $this;
    }

    public function delete(Type $type): self
    {
        $type->delete();
        return $this;
    }
}
