<?php

namespace App\Services;

use App\Models\Arm;

class ArmService
{
    private Arm $arm;

    public function setArm(Arm $arm): self
    {
        $this->arm = $arm;
        return $this;
    }

    public function getObject(): Arm
    {
        return $this->arm->fresh();
    }

    public function create(array $data): self
    {
        Arm::create($data);
        return $this;
    }

    public function update(array $data): self
    {
        $this->arm->update($data);
        return $this;
    }

    public function delete(Arm $arm): self
    {
        $arm->delete();
        return $this;
    }
}
