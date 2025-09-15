<?php

namespace App\Services;

use App\Models\Maintenance;
use App\Models\Pole;

class MaintenanceService
{
    private Maintenance $maintenance;

    public function setMaintenance(Maintenance $maintenance): self
    {
        $this->maintenance = $maintenance;
        return $this;
    }

    public function getObject(): Maintenance
    {
        return $this->maintenance->fresh();
    }

    public function create(array $data): self
    {
        $data['user_id'] = auth()->id();

        if (isset($data['photo']) && $data['photo'] instanceof \Illuminate\Http\UploadedFile) {
            $path = $data['photo']->store('maintenances', 'public'); 
            $data['photo_path'] = $path;
            unset($data['photo']);
        }

        $this->maintenance = Maintenance::create($data);

        return $this;
    }

    public function update(array $data): self
    {
        $this->maintenance->update($data);
        return $this;
    }

    public function delete(Maintenance $maintenance): self
    {
        $maintenance->delete();
        return $this;
    }
}
