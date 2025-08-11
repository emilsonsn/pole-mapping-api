<?php 

namespace App\Services;

use App\Models\NetworkType;

class NetworkTypeService
{
    private NetworkType $networkType;

    public function setNetworkType(NetworkType $networkType): self
    {
        $this->networkType = $networkType;
        return $this;
    }

    public function getObject(): NetworkType
    {
        return $this->networkType->fresh();
    }

    public function create(array $data): self
    {
        NetworkType::create($data);
        return $this;
    }

    public function update(array $data): self
    {
        $this->networkType->update($data);
        return $this;
    }

    public function delete(NetworkType $networkType): self
    {
        $networkType->delete();
        return $this;
    }
}
