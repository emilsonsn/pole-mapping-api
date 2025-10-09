<?php

namespace App\Services;

use App\Models\Characteristic;

class CharacteristicService
{
    private Characteristic $characteristic;

    public function setCharacteristic(Characteristic $characteristic): self
    {
        $this->characteristic = $characteristic;
        return $this;
    }

    public function getObject(): Characteristic
    {
        return $this->characteristic->fresh();
    }

    public function create(array $data): self
    {
        $this->characteristic = Characteristic::create($data);
        return $this;
    }

    public function update(array $data): self
    {
        $this->characteristic->update($data);
        return $this;
    }

    public function delete(Characteristic $characteristic): self
    {
        $characteristic->delete();
        return $this;
    }
}
