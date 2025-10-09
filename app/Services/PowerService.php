<?php

namespace App\Services;

use App\Models\Power;

class PowerService
{
    private Power $power;

    public function setPower(Power $power): self
    {
        $this->power = $power;
        return $this;
    }

    public function getObject(): Power
    {
        return $this->power->fresh();
    }

    public function create(array $data): self
    {
        $this->power = Power::create($data);
        return $this;
    }

    public function update(array $data): self
    {
        $this->power->update($data);
        return $this;
    }

    public function delete(Power $power): self
    {
        $power->delete();
        return $this;
    }
}
