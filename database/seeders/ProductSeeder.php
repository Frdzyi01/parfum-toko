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
                'name'        => 'Jo Malone Lime Basil & Mandarin',
                'slug'        => 'jo-malone-lime-basil-mandarin',
                'description' => 'Aroma segar jeruk mandarin berpadu dengan basil and cedar putih. Parfum unisex yang ringan dan menyegarkan.',
                'price'       => 2200000,
                'stock'       => 15,
                'category'    => 'Unisex',
                'thumbnail'   => 'https://images.unsplash.com/photo-1616949755610-8c9bbc08f138?q=80&w=600&auto=format&fit=crop',
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
