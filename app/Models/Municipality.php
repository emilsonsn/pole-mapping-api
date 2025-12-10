<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Municipality extends Model
{
    protected $table = 'municipalities';

    protected $fillable = [
        'name',
        'cnpj',
        'state',
        'ibge_code',
        'email',
        'phone',
        'website',
        'address',
        'address_number',
        'address_neighborhood',
        'address_zipcode',
    ];

    public function users()
    {
        return $this->morphMany(User::class, 'holder');
    }
}
