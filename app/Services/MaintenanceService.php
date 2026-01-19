<?php

namespace App\Services;

use App\Helpers\LogHelper;
use App\Models\Maintenance;
use Intervention\Image\Laravel\Facades\Image;

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
            $absolutePath = storage_path('app/public/' . $path);

            $this->addFooterToImage($absolutePath, $data);

            $data['photo_path'] = $path;
            unset($data['photo']);
        }

        $this->maintenance = Maintenance::create($data);

        LogHelper::save(
            description: 'Manutenção criada',
            changes: $this->maintenance->getAttributes()
        );

        return $this;
    }

    public function update(array $data): self
    {
        if (isset($data['conclusion_photo']) && $data['conclusion_photo'] instanceof \Illuminate\Http\UploadedFile) {
            $path = $data['conclusion_photo']->store('maintenances', 'public'); 
            $absolutePath = storage_path('app/public/' . $path);

            $this->addFooterToImage($absolutePath, $data);

            $data['conclusion_photo_path'] = $path;
            $data['status'] = Maintenance::STATUS_FINISHED;
            
            unset($data['conclusion_photo']);
        }

        $this->maintenance->update($data);

        LogHelper::save(
            description: 'Manutenção atualizada',
            changes: $this->maintenance->getAttributes()
        );

        return $this;
    }

    public function delete(Maintenance $maintenance): self
    {
        $maintenanceAttributes = $maintenance->getAttributes();

        $maintenance->delete();

        LogHelper::save(
            description: 'Manutenção deletada',
            changes: $maintenanceAttributes
        );

        return $this;
    }

    public function addFooterToImage(string $filePath, array $data): void
    {
        $img = Image::read($filePath);

        $footerText = now()->format('d-m-Y H:i:s') . "\n"
            . ($data['address'] ?? '') . ', ' . ($data['neighborhood'] ?? '') . ', ' . ($data['city'] ?? '') . "\n"
            . 'Latitude: ' . ($data['latitude'] ?? '-') . "\n"
            . 'Longitude: ' . ($data['longitude'] ?? '-');

        $imgHeight = $img->height();

        $fontSize = max(16, intval($imgHeight * 0.02));
        $offsetY  = max(100, intval($imgHeight * 0.10));

        $img->text($footerText, 20, $imgHeight - $offsetY, function ($font) use ($fontSize) {
            $fontPath = collect(glob(public_path('fonts/arial/*.{ttf,TTF}'), GLOB_BRACE))->first();
            if ($fontPath) {
                $font->filename($fontPath);
            }
            $font->size($fontSize);
            $font->color('#ffff00');
            $font->align('left');
            $font->valign('top');
        });

        $img->save($filePath, quality: 90);
    }
}
