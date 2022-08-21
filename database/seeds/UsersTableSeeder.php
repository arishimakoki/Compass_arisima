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
                'id' => 4,
                'over_name' => '田中',
                'under_name' => '太郎',
                'over_name_kana' => 'タナカ',
                'under_name_kana' => 'タロウ',
                'mail_address' => 'tanaka@icloud.com',
                'sex' => '1',
                'birth_day' => '2004-05-11',
                'role' => '1',
                'password' => 's1234567',
            ]
       ]);
    }
}
