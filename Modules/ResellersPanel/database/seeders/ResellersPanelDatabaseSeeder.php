<?php

namespace Modules\ResellersPanel\Database\Seeders;

use Illuminate\Database\Seeder;

class ResellersPanelDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->call([ShopSeeder::class, ShopUserSeeder::class]);
    }
}
