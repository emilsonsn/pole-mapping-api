<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pole extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'latitude',
        'longitude',
        'address',
        'neighborhood',
        'city',
        'type_id',
        'remote_management_relay',
        'paving_id',
        'position_id',
        'network_type_id',
        'connection_type_id',
        'transformer_id',
        'access_id',
        'luminaire_quantity',
        'qrcode',
        'characteristic_id',
        'arm_id',
        'lamp_id',
        'power_id',
        'reactor_id',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function type(): BelongsTo
    {
        return $this->belongsTo(Type::class);
    }

    public function paving(): BelongsTo
    {
        return $this->belongsTo(Paving::class);
    }

    public function position(): BelongsTo
    {
        return $this->belongsTo(Position::class);
    }

    public function networkType(): BelongsTo
    {
        return $this->belongsTo(NetworkType::class);
    }

    public function connectionType(): BelongsTo
    {
        return $this->belongsTo(ConnectionType::class);
    }

    public function transformer(): BelongsTo
    {
        return $this->belongsTo(Transformer::class);
    }

    public function access(): BelongsTo
    {
        return $this->belongsTo(Access::class);
    }

    // Novos relacionamentos
    public function characteristic(): BelongsTo
    {
        return $this->belongsTo(Characteristic::class);
    }

    public function arm(): BelongsTo
    {
        return $this->belongsTo(Arm::class);
    }

    public function lamp(): BelongsTo
    {
        return $this->belongsTo(Lamp::class);
    }

    public function power(): BelongsTo
    {
        return $this->belongsTo(Power::class);
    }

    public function reactor(): BelongsTo
    {
        return $this->belongsTo(Reactor::class);
    }
}
