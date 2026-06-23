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
        'metode_pembayaran',
        'bukti_pembayaran',
        'dibayar_pada',
    ];

    protected $casts = [
        'total'         => 'decimal:2',
        'dibayar_pada'  => 'datetime',
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
        $nextId = (static::max('id') ?? 0) + 1;
        do {
            $invoice = 'INV-' . sprintf('%03d', $nextId) . '-' . date('d-m-Y');
            $nextId++;
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
            'pending'               => 'Pending',
            'menunggu_pembayaran'   => 'Menunggu Pembayaran',
            'dibayar'               => 'Dibayar',
            'processing'            => 'Diproses',
            'completed'             => 'Selesai',
            'cancelled'             => 'Dibatalkan',
            default                 => ucfirst($this->status),
        };
    }

    public function getBadgeStatusAttribute(): string
    {
        return match ($this->status) {
            'pending'               => 'warning',
            'menunggu_pembayaran'   => 'warning',
            'dibayar'               => 'primary',
            'processing'            => 'info',
            'completed'             => 'success',
            'cancelled'             => 'danger',
            default                 => 'secondary',
        };
    }

    public function getWarnaStatusAttribute(): string
    {
        return match ($this->status) {
            'pending'               => '#ffc107',
            'menunggu_pembayaran'   => '#ff9800',
            'dibayar'               => '#632c9b',
            'processing'            => '#17a2b8',
            'completed'             => '#28a745',
            'cancelled'             => '#dc3545',
            default                 => '#6c757d',
        };
    }

    public function getTotalFormatAttribute(): string
    {
        return 'Rp ' . number_format($this->total, 0, ',', '.');
    }

    // Helper: apakah bisa melakukan pembayaran
    public function apakahBisaBayar(): bool
    {
        return $this->status === 'menunggu_pembayaran';
    }

    // Helper: apakah sudah bayar
    public function apakahSudahBayar(): bool
    {
        return in_array($this->status, ['dibayar', 'processing', 'completed']);
    }

    // Helper: mendapatkan URL bukti pembayaran
    public function getBuktiPembayaranUrlAttribute(): ?string
    {
        if ($this->bukti_pembayaran) {
            return asset('storage/' . $this->bukti_pembayaran);
        }
        return null;
    }
}
