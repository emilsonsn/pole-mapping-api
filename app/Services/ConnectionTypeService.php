<?php

namespace App\Services;

use App\Models\ConnectionType;

class ConnectionTypeService
{
    private ConnectionType $connectionType;

    public function setConnectionType(ConnectionType $connectionType): self
    {
        $this->connectionType = $connectionType;
        return $this;
    }

    public function getObject(): ConnectionType
    {
        return $this->connectionType->fresh();
    }

    public function create(array $data): self
    {
        ConnectionType::create($data);
        return $this;
    }

    public function update(array $data): self
    {
        $this->connectionType->update($data);
        return $this;
    }

    public function delete(ConnectionType $connectionType): self
    {
        $connectionType->delete();
        return $this;
    }
}
