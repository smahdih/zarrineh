<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'personal_id' => '1',
                'first_name' => 'امیر',
                'last_name' => 'رحمانی',
                'gender' => 'MALE',
                'national_id' => '0000000000',
                'phone' => '09155145459',
                'email' => 'a.rahmani.ps@gmail.com',
                'address' => '',
                'password' => bcrypt('password'),
            ],
            [
                'personal_id' => '642',
                'first_name' => 'سید مهدی',
                'last_name' => 'هاشمیان',
                'gender' => 'MALE',
                'national_id' => '0923422765',
                'phone' => '09365329797',
                'email' => 'smahdih574@gmail.com',
                'address' => '',
                'password' => bcrypt('0923422765'),
                'password_changed' => 1,
            ],
            [
                'personal_id' => '653',
                'first_name' => 'علیرضا',
                'last_name' => 'رمضانی',
                'gender' => 'MALE',
                'national_id' => '4430629145',
                'phone' => '09156599936',
                'email' => 'dasdasfda@gmail.com',
                'address' => '',
                'password' => bcrypt('4430629145'),
            ],
            [
                'personal_id' => '148',
                'first_name' => 'مژده',
                'last_name' => 'رمضانی',
                'gender' => 'FEMALE',
                'national_id' => '3610582693',
                'phone' => '09015034586',
                'email' => 'test@gmail.com',
                'address' => '',
                'password' => bcrypt('3610582693'),
            ],
            [
                'personal_id' => '796',
                'first_name' => 'محمد',
                'last_name' => 'شگفتی',
                'gender' => 'MALE',
                'national_id' => '0860163814',
                'phone' => '09154047015',
                'email' => 'mohammad@email.com',
                'address' => '',
                'password' => bcrypt('0860163814'),
            ],
            [
                'personal_id' => '788',
                'first_name' => 'فرزانه',
                'last_name' => 'رمضانی مقدم',
                'gender' => 'FEMALE',
                'national_id' => '0922649723',
                'phone' => '09304513253',
                'email' => 'moghadam@gmail.com',
                'address' => '',
                'password' => bcrypt('0922649723'),
            ],
            [
                'personal_id' => '809',
                'first_name' => 'سید حسن',
                'last_name' => 'بانژاد',
                'gender' => 'MALE',
                'national_id' => '0849205948',
                'phone' => '09352799525',
                'email' => 'banezhad@gmail.com',
                'address' => '',
                'password' => bcrypt('0849205948'),
            ],
            [
                'personal_id' => '790',
                'first_name' => 'نیکو',
                'last_name' => 'مطهری',
                'gender' => 'FEMALE',
                'national_id' => '0690699735',
                'phone' => '09152198022',
                'email' => 'motahari@email.com',
                'address' => '',
                'password' => bcrypt('0690699735'),
            ],
            [
                'personal_id' => '499',
                'first_name' => 'طیبه',
                'last_name' => 'تیموری',
                'gender' => 'FEMALE',
                'national_id' => '0900175045',
                'phone' => '09037350948',
                'email' => 'teymori@gmail.com',
                'address' => '',
                'password' => bcrypt('0900175045'),
            ],
            [
                'personal_id' => '217',
                'first_name' => 'فاطمه',
                'last_name' => 'قربانی',
                'gender' => 'FEMALE',
                'national_id' => '0010216316',
                'phone' => '09154039789',
                'email' => 'fatemehghorbani@gmail.com',
                'address' => '',
                'password' => bcrypt('0010216316'),
            ],
            [
                'personal_id' => '230',
                'first_name' => 'منصوره',
                'last_name' => 'جنتی',
                'gender' => 'FEMALE',
                'national_id' => '0922283818',
                'phone' => '09059187853',
                'email' => 'Janati@email.com',
                'address' => '',
                'password' => bcrypt('0922283818'),
            ],
        ];

        foreach ($users as $user) {
            User::firstOrCreate(['personal_id' => $user['personal_id']], $user);
        }
    }
}
