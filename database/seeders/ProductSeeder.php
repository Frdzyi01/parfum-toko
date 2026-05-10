<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            [
                'name'        => 'Parfum Chanel No.5 EDP',
                'slug'        => 'parfum-chanel-no5-edp',
                'description' => 'Parfum ikonik dari Chanel dengan aroma floral aldehyde yang mewah. Cocok untuk penggunaan sehari-hari maupun acara spesial.',
                'price'       => 1850000,
                'stock'       => 25,
                'status'      => 'active',
            ],
            [
                'name'        => 'Dior Sauvage EDT',
                'slug'        => 'dior-sauvage-edt',
                'description' => 'Parfum pria dengan aroma fresh spicy yang kuat dan tahan lama. Terinspirasi dari alam bebas yang luas.',
                'price'       => 1650000,
                'stock'       => 30,
                'status'      => 'active',
            ],
            [
                'name'        => 'Jo Malone Lime Basil & Mandarin',
                'slug'        => 'jo-malone-lime-basil-mandarin',
                'description' => 'Aroma segar jeruk mandarin berpadu dengan basil dan cedar putih. Parfum unisex yang ringan dan menyegarkan.',
                'price'       => 2200000,
                'stock'       => 15,
                'status'      => 'active',
            ],
            [
                'name'        => 'Yves Saint Laurent Black Opium',
                'slug'        => 'ysl-black-opium',
                'description' => 'Parfum wanita dengan aroma oriental floral. Perpaduan kopi hitam, vanilla, dan bunga putih yang sensual.',
                'price'       => 1750000,
                'stock'       => 20,
                'status'      => 'active',
            ],
            [
                'name'        => 'Tom Ford Oud Wood EDP',
                'slug'        => 'tom-ford-oud-wood',
                'description' => 'Kayu oud yang eksotis berpadu dengan rosewood, cardamom, dan sandalwood. Parfum prestige dengan karakter unik.',
                'price'       => 3500000,
                'stock'       => 10,
                'status'      => 'active',
            ],
            [
                'name'        => 'Versace Eros EDT',
                'slug'        => 'versace-eros-edt',
                'description' => 'Parfum pria yang terinspirasi dari dewa cinta Yunani. Aroma mint, apel hijau, dan tonka bean yang powerful.',
                'price'       => 1200000,
                'stock'       => 35,
                'status'      => 'active',
            ],
            [
                'name'        => 'Lancome La Vie Est Belle',
                'slug'        => 'lancome-la-vie-est-belle',
                'description' => 'Parfum wanita dengan aroma iris iris, patchouli, dan gourmand yang manis. Symbol kebebasan dan kebahagiaan.',
                'price'       => 1550000,
                'stock'       => 18,
                'status'      => 'active',
            ],
            [
                'name'        => 'Acqua di Gio Profumo',
                'slug'        => 'acqua-di-gio-profumo',
                'description' => 'Versi intensif dari Acqua di Gio. Aroma aquatic-fougère dengan sentuhan incense dan patchouli yang dalam.',
                'price'       => 1900000,
                'stock'       => 12,
                'status'      => 'active',
            ],
            [
                'name'        => 'Maison Margiela Replica Jazz Club',
                'slug'        => 'maison-margiela-jazz-club',
                'description' => 'Terinspirasi dari suasana jazz club New York. Aroma rum, tembakau, dan kayu yang hangat dan nostalgic.',
                'price'       => 2800000,
                'stock'       => 8,
                'status'      => 'active',
            ],
        ];

        foreach ($products as $product) {
            Product::firstOrCreate(
                ['slug' => $product['slug']],
                $product
            );
        }
    }
}
