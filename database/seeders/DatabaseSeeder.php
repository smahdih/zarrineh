<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\Core\UnitSeeder;
use Database\Seeders\COre\ProcedureSeeder;
use Database\Seeders\Products\ProductGroupSeeder;
use Database\Seeders\Products\ProductCategorySeeder;
use Database\Seeders\Organization\DepartmentAndSectionSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            UnitSeeder::class,
            ProcedureSeeder::class,
            DepartmentAndSectionSeeder::class,
            ProductGroupSeeder::class,
            ProductCategorySeeder::class,
        ]);
    }
}