<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\{Builder, Model};

class PaymentInstallments extends Model
{
    use HasFactory;

    public function sale(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Sale::class);
    }

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // Método para verificar se todas as parcelas foram pagas
    public function scopeAllPaid(Builder $query, int $saleId): bool
    {
        return $query->where('sale_id', $saleId)->where('status', '!=', 'PAGO')->doesntExist();
    }
}
