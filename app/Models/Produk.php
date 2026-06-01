<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Produk extends Model
{
    use HasFactory;

    protected $table = 'produk';

    protected $fillable = [
        'nama',
        'slug',
        'deskripsi',
        'harga',
        'stok',
        'gambar_mini',
        'status',
        'kategori',
    ];

    protected $casts = [
        'harga' => 'decimal:2',
        'stok'  => 'integer',
    ];

    // Generate slug otomatis sebelum membuat produk baru
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($produk) {
            if (empty($produk->slug)) {
                $produk->slug = static::buatUniqueSlug($produk->nama);
            }
        });

        static::updating(function ($produk) {
            if ($produk->isDirty('nama') && empty($produk->getOriginal('slug'))) {
                $produk->slug = static::buatUniqueSlug($produk->nama);
            }
        });
    }

    public static function buatUniqueSlug(string $nama): string
    {
        $slug = Str::slug($nama);
        $count = static::whereRaw("slug RLIKE '^{$slug}(-[0-9]+)?$'")->count();
        return $count ? "{$slug}-{$count}" : $slug;
    }

    // Scopes
    public function scopeAktif($query)
    {
        return $query->where('status', 'aktif');
    }

    public function scopeAdaStok($query)
    {
        return $query->where('stok', '>', 0);
    }

    // Relations
    public function itemKeranjang()
    {
        return $this->hasMany(ItemKeranjang::class, 'produk_id');
    }

    public function detailTransaksi()
    {
        return $this->hasMany(DetailTransaksi::class, 'produk_id');
    }

    // Helpers
    public function apakahAktif(): bool
    {
        return $this->status === 'aktif';
    }

    public function apakahAdaStok(): bool
    {
        return $this->stok > 0;
    }

    public function getGambarMiniUrlAttribute(): string
    {
        if ($this->gambar_mini) {
            if (filter_var($this->gambar_mini, FILTER_VALIDATE_URL)) {
                return $this->gambar_mini;
            }
            return asset('storage/' . $this->gambar_mini);
        }
        return asset('template-landing/img/product/fp-1.jpg');
    }

    public function getHargaFormatAttribute(): string
    {
        return 'Rp ' . number_format($this->harga, 0, ',', '.');
    }
}
