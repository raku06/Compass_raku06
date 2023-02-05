<?php

use Illuminate\Database\Seeder;
use App\Models\Users\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'over_name' => '図形',
                'under_name' => '円',
                'over_name_kana' => 'ハカリガタ',
                'under_name_kana' =>'マドカ',
                'mail_address' => 'math-t@gmail.com',
                'sex' => '2',
                'birth_day' =>'1993-03-14',
                'role' => '2',
                'password' =>  bcrypt('1234'),
            ],
            [
                'over_name' => '三関',
                'under_name' => '詩音',
                'over_name_kana' => 'サンカン',
                'under_name_kana' =>'シオン',
                'mail_address' => 'jp-t@gmail.com',
                'sex' => '2',
                'birth_day' =>'1991-06-08',
                'role' => '1',
                'password' =>  bcrypt('1234'),
            ],
            [
                'over_name' => '新戸',
                'under_name' => '愛',
                'over_name_kana' => 'ニイド',
                'under_name_kana' =>'アイ',
                'mail_address' => 'en-t@gmail.com',
                'sex' => '2',
                'birth_day' =>'1991-07-04',
                'role' => '3',
                'password' =>  bcrypt('1234'),
            ],
            [
                'over_name' => '豆知',
                'under_name' => '識',
                'over_name_kana' => 'マメチ',
                'under_name_kana' =>'シキ',
                'mail_address' => 'shiki@gmail.com',
                'sex' => '2',
                'birth_day' =>'1995-03-03',
                'role' => '4',
                'password' =>  bcrypt('1234'),
            ],
        ]);
    }
}
