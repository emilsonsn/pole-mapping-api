<?php

namespace App\Services;

use App\Models\Reactor;

class ReactorService
{
    private Reactor $reactor;

    public function setReactor(Reactor $reactor): self
    {
        $this->reactor = $reactor;
        return $this;
    }

    public function getObject(): Reactor
    {
        return $this->reactor->fresh();
    }

    public function create(array $data): self
    {
        $this->reactor = Reactor::create($data);
        return $this;
    }

    public function update(array $data): self
    {
        $this->reactor->update($data);
        return $this;
    }

    public function delete(Reactor $reactor): self
    {
        $reactor->delete();
        return $this;
    }
}
