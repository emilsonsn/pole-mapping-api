<?php

namespace App\Models;

use App\Traits\SyncNameValue;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Relay extends Model
{
    use HasFactory, SyncNameValue;

    protected $fillable = [
        'name',
        'value'
    ];

    public function poles(): HasMany
    {
        return $this->hasMany(Pole::class);
    }       
}
