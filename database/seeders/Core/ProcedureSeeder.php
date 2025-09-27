<?php

namespace Database\Seeders\Core;

use App\Models\Core\Procedure;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProcedureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'name' => 'سابلیمیشن',
                'type' => 'PRODUCE',
            ],
            [
                'name' => 'سابلیمیشن',
                'type' => 'TEST',
            ],
        ];

        foreach ($data as $item) {
            Procedure::updateOrCreate(['name' => $item['name']], $item);
        }
    }
}
