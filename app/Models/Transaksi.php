<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Transaksi extends Model
{
    use HasFactory;

    protected $table = 'transaksi';

    protected $fillable = [
        'pengguna_id',
        'nomor_invoice',
        'total',
        'status',
        'catatan',
    ];

    protected $casts = [
        'total' => 'decimal:2',
    ];

    // Buat nomor invoice secara otomatis
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($transaksi) {
            if (empty($transaksi->nomor_invoice)) {
                $transaksi->nomor_invoice = static::buatNomorInvoice();
            }
        });
    }

    public static function buatNomorInvoice(): string
    {
        do {
            $invoice = 'INV-' . strtoupper(Str::random(4)) . '-' . date('Ymd');
        } while (static::where('nomor_invoice', $invoice)->exists());

        return $invoice;
    }

    // Relations
    public function pengguna()
    {
        return $this->belongsTo(Pengguna::class, 'pengguna_id');
    }

    public function item()
    {
        return $this->hasMany(DetailTransaksi::class, 'transaksi_id');
    }

    // Status label helper
    public function getLabelStatusAttribute(): string
    {
        return match ($this->status) {
            'pending'    => 'Pending',
            'processing' => 'Diproses',
            'completed'  => 'Selesai',
            'cancelled'  => 'Dibatalkan',
            default      => ucfirst($this->status),
        };
    }

    public function getBadgeStatusAttribute(): string
    {
        return match ($this->status) {
            'pending'    => 'warning',
            'processing' => 'info',
            'completed'  => 'success',
            'cancelled'  => 'danger',
            default      => 'secondary',
        };
    }

    public function getTotalFormatAttribute(): string
    {
        return 'Rp ' . number_format($this->total, 0, ',', '.');
    }
}
