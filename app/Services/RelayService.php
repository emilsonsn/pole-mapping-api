<?php

namespace App\Services;

use App\Models\Relay;

class RelayService
{
    private Relay $relay;

    public function setRelay(Relay $relay): self
    {
        $this->relay = $relay;
        return $this;
    }

    public function getObject(): Relay
    {
        return $this->relay->fresh();
    }

    public function create(array $data): self
    {
        $this->relay = Relay::create($data);
        return $this;
    }

    public function update(array $data): self
    {
        $this->relay->update($data);
        return $this;
    }

    public function delete(Relay $relay): self
    {
        $relay->delete();
        return $this;
    }
}
