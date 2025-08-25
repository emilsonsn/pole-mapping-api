<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

/**
 * @property int $user_id
 */
class Maintenance extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'latitude',
        'longitude',
        'address',
        'neighborhood',
        'city',
        'photo_path',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function getPhotoPathAttribute($value): ?string
    {
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
