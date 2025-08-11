<?php 

namespace App\Services;

use App\Models\Position;

class PositionService
{
    private Position $position;

    public function setPosition(Position $position): self
    {
        $this->position = $position;
        return $this;
    }

    public function getObject(): Position
    {
        return $this->position->fresh();
    }

    public function create(array $data): self
    {
        Position::create($data);
        return $this;
    }

    public function update(array $data): self
    {
        $this->position->update($data);
        return $this;
    }

    public function delete(Position $position): self
    {
        $position->delete();
        return $this;
    }
}
