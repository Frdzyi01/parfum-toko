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
                'name'        => 'Bleu De Chanel',
                'slug'        => 'bleu-de-chanel',
                'description' => 'Parfum pria dengan aroma woody aromatic yang segar dan sensual. Perpaduan citrus segar dengan cedarwood yang maskulin.',
                'price'       => 850000,
                'stock'       => 25,
                'category'    => 'Parfum Pria',
                'thumbnail'   => 'https://images.unsplash.com/photo-1594035910387-fea47794261f?q=80&w=600&auto=format&fit=crop',
                'status'      => 'active',
            ],
            [
                'name'        => 'YSL Black Opium',
                'slug'        => 'ysl-black-opium',
                'description' => 'Parfum wanita dengan aroma oriental floral. Perpaduan kopi hitam, vanilla, dan bunga putih yang sensual.',
                'price'       => 900000,
                'stock'       => 20,
                'category'    => 'Parfum Wanita',
                'thumbnail'   => 'https://images.unsplash.com/photo-1592945403244-b3fbafd7f539?q=80&w=600&auto=format&fit=crop',
                'status'      => 'active',
            ],
            [
                'name'        => 'Dior Sauvage',
                'slug'        => 'dior-sauvage',
                'description' => 'Parfum pria dengan aroma fresh spicy yang kuat dan tahan lama. Terinspirasi dari alam bebas yang luas.',
                'price'       => 800000,
                'stock'       => 30,
                'category'    => 'Parfum Pria',
                'thumbnail'   => 'https://images.unsplash.com/photo-1547887537-6158d64c35b3?q=80&w=600&auto=format&fit=crop',
                'status'      => 'active',
            ],
            [
                'name'        => 'Love Spell',
                'slug'        => 'love-spell',
                'description' => 'Parfum wanita dengan aroma fruity floral yang manis, ceria, dan menyegarkan. Sangat disukai oleh para wanita.',
                'price'       => 250000,
                'stock'       => 40,
                'category'    => 'Parfum Wanita',
                'thumbnail'   => 'https://images.unsplash.com/photo-1588405748373-122b2321bc31?q=80&w=600&auto=format&fit=crop',
                'status'      => 'active',
            ],
            [
                'name'        => 'Parfum Chanel No.5 EDP',
                'slug'        => 'parfum-chanel-no5-edp',
                'description' => 'Parfum ikonik dari Chanel dengan aroma floral aldehyde yang mewah. Cocok untuk penggunaan sehari-hari maupun acara spesial.',
                'price'       => 1850000,
                'stock'       => 25,
                'category'    => 'Parfum Wanita',
                'thumbnail'   => 'https://images.unsplash.com/photo-1523293182086-7651a899d37f?q=80&w=600&auto=format&fit=crop',
                'status'      => 'active',
            ],
            [
                'name'        => 'Jo Malone Lime Basil & Mandarin',
                'slug'        => 'jo-malone-lime-basil-mandarin',
                'description' => 'Aroma segar jeruk mandarin berpadu dengan basil dan cedar putih. Parfum unisex yang ringan dan menyegarkan.',
                'price'       => 2200000,
                'stock'       => 15,
                'category'    => 'Unisex',
                'thumbnail'   => 'https://images.unsplash.com/photo-1616949755610-8c9bbc08f138?q=80&w=600&auto=format&fit=crop',
                'status'      => 'active',
            ],
            [
                'name'        => 'Tom Ford Oud Wood EDP',
                'slug'        => 'tom-ford-oud-wood',
                'description' => 'Kayu oud yang eksotis berpadu dengan rosewood, cardamom, dan sandalwood. Parfum prestige dengan karakter unik.',
                'price'       => 3500000,
                'stock'       => 10,
                'category'    => 'Unisex',
                'thumbnail'   => 'https://images.unsplash.com/photo-1595425970377-c9703cf48b6d?q=80&w=600&auto=format&fit=crop',
                'status'      => 'active',
            ],
            [
                'name'        => 'Versace Eros EDT',
                'slug'        => 'versace-eros-edt',
                'description' => 'Parfum pria yang terinspirasi dari dewa cinta Yunani. Aroma mint, apel hijau, dan tonka bean yang powerful.',
                'price'       => 1200000,
                'stock'       => 35,
                'category'    => 'Parfum Pria',
                'thumbnail'   => 'https://images.unsplash.com/photo-1615396899839-c99c121888b0?q=80&w=600&auto=format&fit=crop',
                'status'      => 'active',
            ],
            [
                'name'        => 'Lancome La Vie Est Belle',
                'slug'        => 'lancome-la-vie-est-belle',
                'description' => 'Parfum wanita dengan aroma iris iris, patchouli, dan gourmand yang manis. Symbol kebebasan dan kebahagiaan.',
                'price'       => 1550000,
                'stock'       => 18,
                'category'    => 'Parfum Wanita',
                'thumbnail'   => 'https://images.unsplash.com/photo-1587300003388-59208cc962cb?q=80&w=600&auto=format&fit=crop',
                'status'      => 'active',
            ],
            [
                'name'        => 'Acqua di Gio Profumo',
                'slug'        => 'acqua-di-gio-profumo',
                'description' => 'Versi intensif dari Acqua di Gio. Aroma aquatic-fougère dengan sentuhan incense dan patchouli yang dalam.',
                'price'       => 1900000,
                'stock'       => 12,
                'category'    => 'Parfum Pria',
                'thumbnail'   => 'https://images.unsplash.com/photo-1608571423902-eed4a5ad8108?q=80&w=600&auto=format&fit=crop',
                'status'      => 'active',
            ],
            [
                'name'        => 'Maison Margiela Replica Jazz Club (Mini)',
                'slug'        => 'maison-margiela-jazz-club-mini',
                'description' => 'Ukuran travel/mini untuk kemudahan dibawa kemana saja. Aroma rum, tembakau, dan kayu yang hangat dan nostalgic.',
                'price'       => 300000,
                'stock'       => 8,
                'category'    => 'Mini Size',
                'thumbnail'   => 'https://images.unsplash.com/photo-1594035910387-fea47794261f?q=80&w=600&auto=format&fit=crop',
                'status'      => 'active',
            ],
        ];

        foreach ($products as $product) {
            Product::updateOrCreate(
                ['slug' => $product['slug']],
                $product
            );
        }
    }
}
