<?php

namespace App\Services;

use App\Models\Pole;
use Illuminate\Http\UploadedFile;

class PoleService
{
    private Pole $pole;

    public function setPole(Pole $pole): self
    {
        $this->pole = $pole;
        return $this;
    }

    public function getObject(): Pole
    {
        return $this->pole->fresh([
            'type',
            'paving',
            'position',
            'networkType',
            'connectionType',
            'transformer',
            'access',
        ]);
    }

    public function create(array $data): self
    {
        $data['user_id'] = auth()->id();
        
        if (isset($data['remote_management_relay']) && $data['remote_management_relay'] instanceof UploadedFile) {
            $path = $data['remote_management_relay']->store('poles/remote-management', 'public');
            unset($data['remote_management_relay']);
            $data['remote_management_relay_path'] = $path;
        }

        $this->pole = Pole::create($data);

        return $this;
    }

    public function update(array $data): self
    {
        $this->pole->update($data);
        return $this;
    }

    public function delete(Pole $pole): self
    {
        $pole->delete();
        return $this;
    }
}
