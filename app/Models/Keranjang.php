<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Keranjang extends Model
{
    use HasFactory;

    protected $table = 'keranjang';

    protected $fillable = ['pengguna_id'];

    // Relations
    public function pengguna()
    {
        return $this->belongsTo(Pengguna::class, 'pengguna_id');
    }

    public function item()
    {
        return $this->hasMany(ItemKeranjang::class, 'keranjang_id');
    }

    // Ambil total belanja di keranjang
    public function ambilTotal(): float
    {
        return $this->item->sum('subtotal');
    }

    // Hitung jumlah item di keranjang
    public function hitungJumlah(): int
    {
        return $this->item->sum('jumlah');
    }
}
