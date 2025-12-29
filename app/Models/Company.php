<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $table = 'companies';

    protected $fillable = [
        'name',
        'trade_name',
        'cnpj',
        'state_registration',
        'municipal_registration',
        'email',
        'phone',
        'website',
        'address',
        'address_number',
        'address_neighborhood',
        'address_city',
        'address_state',
        'address_zipcode',
        'municipality_id',
        'service_mode'
    ];

    public function municipality()
    {
        return $this->belongsTo(Municipality::class);
    }
        
    public function users()
    {
        return $this->morphMany(User::class, 'holder');
    }
}
