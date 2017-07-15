<?php

use Illuminate\Database\Seeder;

class ArticlesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('users')->truncate();
        DB::table('articles')->insert(

            [
                'user_id' => 1,
                'title' => 'Добро пожаловать!',
                'text' => 'Это тестовая статья. Свои статьи вы можете создать в личном кабинете',
                'created_at' => '2017-07-14 07:00:00'
            ]
        );
    }
}
