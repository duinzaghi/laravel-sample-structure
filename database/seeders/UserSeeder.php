<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')-> delete();
        DB::table('users') -> insert([
            'id' => 1,
            'company' => "Inzaghi",
            'email' => 'ngocdu.longan@gmail.com',
            'firstName' => 'Du',
            'lastName'  => 'Bui',
            'office'      => '0903890965',
            'phoneNumber'      => '0903890965',
            'zipCode'      => '70000',
            'state'      => 'HCM',
            'city'      => 'HCM',
            'address'      => '240 Nguyen Van Luong',
            'uuid'  => 'ajksdSDFWEEWXgj',
            'role'       => "admin",
            'gender'       => false,
            'active'  => true,
            'disableLogin' => false,
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);
    }
}
