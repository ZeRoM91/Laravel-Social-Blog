<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('users')->truncate();
        DB::table('users')->insert(
            [
            [
                'name' => 'admin',
                'email' => 'admin@site.com',
                'password' => bcrypt('123123'),
                'firstname' => 'Админ',
                'lastname' => 'Админыч',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ],
            [
                'name' => 'dmitriy',
                'email' => 'dmitriy435@gmail.com',
                'firstname' => 'Дмитрий',
                'lastname' => 'Доронин',
                'password' => bcrypt('123123'),
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ],
                ]
        );

    }
}
