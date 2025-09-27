<?php

namespace Database\Seeders\Products;

use App\Models\Products\Groups\ProductGroup;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $groups = [
            'کیف',
            'جانماز',
            'جامهری',
            'سجاده',
            'پرچم',
            'شال',
            'ابرپرچم',
            'پرچم تشریفات',
            'ریسه',
            'پرچم دستی',
            'کتیبه',
            'کیف جانماز',
            'حمایل',
            'کاور دستمال کاغذی',
            'جامدادی',
            'سفره',
            'ریسه',
            'قاب',
            'کجراه',
            'هدیه',
            'رومیزی',
            'پیشونی بند',
            'کنارایفونی',
        ];

        foreach ($groups as $name) {
            ProductGroup::updateOrCreate(['name' => $name]);
        }
    }
}
