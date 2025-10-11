<?php

namespace Modules\ResellersPanel\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\ResellersPanel\Models\Shop;

class ShopSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $shops = [
            [
                'name' => 'shop 1',
            ],
            [
                'name' => 'shop 2',
            ],
        ];

        foreach ($shops as $shop) {
            Shop::create($shop);
        }
    }
}
