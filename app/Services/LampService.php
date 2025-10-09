<?php

namespace App\Services;

use App\Models\Lamp;

class LampService
{
    private Lamp $lamp;

    public function setLamp(Lamp $lamp): self
    {
        $this->lamp = $lamp;
        return $this;
    }

    public function getObject(): Lamp
    {
        return $this->lamp->fresh();
    }

    public function create(array $data): self
    {
        $this->lamp = Lamp::create($data);
        return $this;
    }

    public function update(array $data): self
    {
        $this->lamp->update($data);
        return $this;
    }

    public function delete(Lamp $lamp): self
    {
        $lamp->delete();
        return $this;
    }
}
