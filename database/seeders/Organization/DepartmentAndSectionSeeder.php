<?php

namespace Database\Seeders\Organization;

use App\Models\Organization\Department;
use App\Models\Organization\Section;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DepartmentAndSectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // لیست دپارتمان‌ها و سِکشن‌های هر کدام
        $structure = [
            'production' => [
                'name' => 'تولید',
                'sections' => [
                    ['name' => 'پلاتر',         'slug' => 'plater'],
                    ['name' => 'لیزر',          'slug' => 'laser'],
                    ['name' => 'کلندر',         'slug' => 'calender'],
                    ['name' => 'برش',           'slug' => 'cutting'],
                    ['name' => 'خیاطی',         'slug' => 'sewing'],
                    ['name' => 'پرس',           'slug' => 'press'],
                    ['name' => 'بسته بندی',     'slug' => 'packaging'],
                    ['name' => 'چاپ سیلک',      'slug' => 'silk-printing'],
                    ['name' => 'عکاسی شابلون',  'slug' => 'stencil-photography'],
                ],
            ],
            'administrative' => [
                'name' => 'اداری',
                'sections' => [
                    ['name' => 'مدیریت',    'slug' => 'management'],
                    ['name' => 'طراحی',     'slug' => 'design'],
                    ['name' => 'حسابداری',  'slug' => 'accounting'],
                ],
            ],
            'warehouse' => [
                'name' => 'انبارداری',
                'sections' => [
                    ['name' => 'انبار - مواد اولیه',   'slug' => 'warehouse-raw-material'],
                    ['name' => 'انبار - محصولات',      'slug' => 'warehouse-products'],
                ],
            ],
        ];

        foreach ($structure as $deptSlug => $deptData) {
            // دپارتمان را بساز یا به‌روزرسانی کن
            $department = Department::updateOrCreate(
                ['slug' => $deptSlug],
                ['name' => $deptData['name'], 'slug' => $deptSlug]
            );

            // سِکشن‌های مربوط به این دپارتمان را بساز
            foreach ($deptData['sections'] as $section) {
                Section::updateOrCreate(
                    ['slug' => $section['slug']],
                    [
                        'department_id' => $department->id,
                        'name' => $section['name'],
                        'slug' => $section['slug'],
                    ]
                );
            }
        }
    }
}
