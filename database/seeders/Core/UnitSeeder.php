<?php

namespace Database\Seeders\Core;

use App\Models\Core\Unit;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $units = [
            // طول
            [
                'name' => 'متر',
                'symbol_fa' => 'م',
                'symbol_en' => 'm',
            ],
            [
                'name' => 'سانتی‌متر',
                'symbol_fa' => 'س.م',
                'symbol_en' => 'cm',
            ],
            [
                'name' => 'میلی‌متر',
                'symbol_fa' => 'م.م',
                'symbol_en' => 'mm',
            ],
            [
                'name' => 'یارد',
                'symbol_fa' => 'یارد',
                'symbol_en' => 'yd',
            ],
            [
                'name' => 'اینچ',
                'symbol_fa' => 'اینچ',
                'symbol_en' => 'in',
            ],

            // مساحت
            [
                'name' => 'متر مربع',
                'symbol_fa' => 'متر²',
                'symbol_en' => 'm²',
            ],
            [
                'name' => 'سانتی‌متر مربع',
                'symbol_fa' => 'س.م²',
                'symbol_en' => 'cm²',
            ],
            [
                'name' => 'یارد مربع',
                'symbol_fa' => 'یارد²',
                'symbol_en' => 'yd²',
            ],
            [
                'name' => 'فوت مربع',
                'symbol_fa' => 'فوت²',
                'symbol_en' => 'ft²',
            ],

            // وزن
            [
                'name' => 'کیلوگرم',
                'symbol_fa' => 'کیلوگرم',
                'symbol_en' => 'kg',
            ],
            [
                'name' => 'گرم',
                'symbol_fa' => 'گرم',
                'symbol_en' => 'g',
            ],
            [
                'name' => 'پوند',
                'symbol_fa' => 'پوند',
                'symbol_en' => 'lb',
            ],
            [
                'name' => 'انس',
                'symbol_fa' => 'انس',
                'symbol_en' => 'oz',
            ],
            [
                'name' => 'گرم بر متر مربع',
                'symbol_fa' => 'گرم/متر²',
                'symbol_en' => 'gsm',
            ],

            // New units
            [
                'name' => 'عدد',
                'symbol_fa' => 'عدد',
                'symbol_en' => 'pcs',
            ],
            [
                'name' => 'جفت',
                'symbol_fa' => 'جفت',
                'symbol_en' => 'pair',
            ],
            [
                'name' => 'دوجین',
                'symbol_fa' => 'دوجین',
                'symbol_en' => 'doz',
            ],
            [
                'name' => 'طاقه',
                'symbol_fa' => 'طاقه',
                'symbol_en' => 'roll/bolt',
            ],
            [
                'name' => 'دسته',
                'symbol_fa' => 'دسته',
                'symbol_en' => 'bundle',
            ],
            [
                'name' => 'کارتن',
                'symbol_fa' => 'کارتن',
                'symbol_en' => 'carton',
            ],
            [
                'name' => 'بسته',
                'symbol_fa' => 'بسته',
                'symbol_en' => 'pack/pkg',
            ],
            [
                'name' => 'سری',
                'symbol_fa' => 'سری',
                'symbol_en' => 'set',
            ],
            [
                'name' => 'کیسه',
                'symbol_fa' => 'کیسه',
                'symbol_en' => 'bag/sack',
            ],
        ];

        foreach ($units as $unit) {
            Unit::firstOrCreate(
                [
                    'name' => $unit['name'],
                ],
                $unit,
            );
        }
    }
}
