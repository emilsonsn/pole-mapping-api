<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $appends = ['photo_path'];


    protected $fillable = [
        'pole_id',
        'description',
        'status',
        'image_path',
    ];

    public function pole()
    {
        return $this->belongsTo(Pole::class);
    }

    public function getPhotoPathAttribute(): ?string
    {
        $value = $this->attributes['image_path'] ?? null;

        if (! $value) {
            return null;
        }

        $storagePath = storage_path('app/public/' . $value);
        $publicPath  = base_path('public_html/storage/' . $value);

        if (file_exists($storagePath)) {
            if (! file_exists(dirname($publicPath))) {
                mkdir(dirname($publicPath), 0755, true);
            }

            if (! file_exists($publicPath)) {
                copy($storagePath, $publicPath);
            }

            return asset('storage/' . $value);
        }

        return null;
    }

}
