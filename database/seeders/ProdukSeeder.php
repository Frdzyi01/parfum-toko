<?php

namespace Database\Seeders;

use App\Models\Produk;
use Illuminate\Database\Seeder;

class ProdukSeeder extends Seeder
{
    public function run(): void
    {
        $produk = [
            [
                'nama'        => 'Bleu De Chanel',
                'slug'        => 'bleu-de-chanel',
                'deskripsi'   => 'Parfum pria dengan aroma woody aromatic yang segar dan sensual. Perpaduan citrus segar dengan cedarwood yang maskulin.',
                'harga'       => 850000,
                'stok'        => 25,
                'kategori'    => 'Parfum Pria',
                'gambar_mini' => 'https://images.unsplash.com/photo-1594035910387-fea47794261f?q=80&w=600&auto=format&fit=crop',
                'status'      => 'aktif',
            ],
            [
                'nama'        => 'YSL Black Opium',
                'slug'        => 'ysl-black-opium',
                'deskripsi'   => 'Parfum wanita dengan aroma oriental floral. Perpaduan kopi hitam, vanilla, dan bunga putih yang sensual.',
                'harga'       => 900000,
                'stok'        => 20,
                'kategori'    => 'Parfum Wanita',
                'gambar_mini' => 'https://images.unsplash.com/photo-1592945403244-b3fbafd7f539?q=80&w=600&auto=format&fit=crop',
                'status'      => 'aktif',
            ],
            [
                'nama'        => 'Dior Sauvage',
                'slug'        => 'dior-sauvage',
                'deskripsi'   => 'Parfum pria dengan aroma fresh spicy yang kuat dan tahan lama. Terinspirasi dari alam bebas yang luas.',
                'harga'       => 800000,
                'stok'        => 30,
                'kategori'    => 'Parfum Pria',
                'gambar_mini' => 'https://images.unsplash.com/photo-1547887537-6158d64c35b3?q=80&w=600&auto=format&fit=crop',
                'status'      => 'aktif',
            ],
            [
                'nama'        => 'Love Spell',
                'slug'        => 'love-spell',
                'deskripsi'   => 'Parfum wanita dengan aroma fruity floral yang manis, ceria, dan menyegarkan. Sangat disukai oleh para wanita.',
                'harga'       => 250000,
                'stok'        => 40,
                'kategori'    => 'Parfum Wanita',
                'gambar_mini' => 'https://images.unsplash.com/photo-1588405748373-122b2321bc31?q=80&w=600&auto=format&fit=crop',
                'status'      => 'aktif',
            ],
            [
                'nama'        => 'Jo Malone Lime Basil & Mandarin',
                'slug'        => 'jo-malone-lime-basil-mandarin',
                'deskripsi'   => 'Aroma segar jeruk mandarin berpadu dengan basil and cedar putih. Parfum unisex yang ringan dan menyegarkan.',
                'harga'       => 2200000,
                'stok'        => 15,
                'kategori'    => 'Unisex',
                'gambar_mini' => 'https://images.unsplash.com/photo-1616949755610-8c9bbc08f138?q=80&w=600&auto=format&fit=crop',
                'status'      => 'aktif',
            ],
        ];

        foreach ($produk as $item) {
            Produk::updateOrCreate(
                ['slug' => $item['slug']],
                $item
            );
        }
    }
}
