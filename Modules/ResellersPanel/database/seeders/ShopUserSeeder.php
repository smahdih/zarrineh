<?php

namespace Modules\ResellersPanel\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\ResellersPanel\Models\ShopUser;

class ShopUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'first_name' => 'سید مهدی',
                'last_name' => 'هاشمیان',
                'gender' => 'MALE',
                'national_id' => '0923422765',
                'phone' => '09365329797',
                'email' => 'shop1@gmail.com',
                'address' => '',
                'password' => bcrypt('password'),
                'password_changed' => 1,
                'is_owner' => 1,
                'shop_id' => 1,
            ],
            [
                'first_name' => 'علیرضا',
                'last_name' => 'رمضانی',
                'gender' => 'MALE',
                'national_id' => '4430629145',
                'phone' => '09156599936',
                'email' => 'shop2@gmail.com',
                'address' => '',
                'password' => bcrypt('password'),
                'is_owner' => 1,
                'shop_id' => 2,
            ],
        ];

        foreach ($users as $user) {
            ShopUser::firstOrCreate($user);
        }
    }
}
