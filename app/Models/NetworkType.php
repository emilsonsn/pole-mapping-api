<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class NetworkType extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'value'
    ];

    public function poles(): HasMany
    {
        return $this->hasMany(Pole::class);
    }    
}
