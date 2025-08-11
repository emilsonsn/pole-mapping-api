<?php 

namespace App\Services;

use App\Models\Paving;

class PavingService
{
    private Paving $paving;

    public function setPaving(Paving $paving): self
    {
        $this->paving = $paving;
        return $this;
    }

    public function getObject(): Paving
    {
        return $this->paving->fresh();
    }

    public function create(array $data): self
    {
        Paving::create($data);
        return $this;
    }

    public function update(array $data): self
    {
        $this->paving->update($data);
        return $this;
    }

    public function delete(Paving $paving): self
    {
        $paving->delete();
        return $this;
    }
}
