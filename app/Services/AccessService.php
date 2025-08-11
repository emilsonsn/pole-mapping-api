<?php

namespace App\Services;

use App\Models\Access;

class AccessService
{
    private Access $access;

    public function setAccess(Access $access): self
    {
        $this->access = $access;
        return $this;
    }

    public function getObject(): Access
    {
        return $this->access->fresh();
    }

    public function create(array $data): self
    {
        Access::create($data);
        return $this;
    }

    public function update(array $data): self
    {
        $this->access->update($data);
        return $this;
    }

    public function delete(Access $access): self
    {
        $access->delete();
        return $this;
    }
}
