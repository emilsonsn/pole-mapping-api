<?php

namespace App\Services;

use App\Models\Transformer;

class TransformerService
{
    private Transformer $transformer;

    public function setTransformer(Transformer $transformer): self
    {
        $this->transformer = $transformer;
        return $this;
    }

    public function getObject(): Transformer
    {
        return $this->transformer->fresh();
    }

    public function create(array $data): self
    {
        Transformer::create($data);
        return $this;
    }

    public function update(array $data): self
    {
        $this->transformer->update($data);
        return $this;
    }

    public function delete(Transformer $transformer): self
    {
        $transformer->delete();
        return $this;
    }
}
