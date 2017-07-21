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

        DB::table('articles')->truncate();
        DB::table('articles')->insert(
        [
                [
                'user_id' => 1,
                'title' => 'Добро пожаловать!',
                'text' => 'Это тестовая статья. Свои статьи вы можете создать в личном кабинете',
                'created_at' => '2017-07-14 10:00:00'
                 ],
                [
                'user_id' => 1,
                'title' => 'Как создать статью',
                'text' => 'Для создания статьи необходимо сначала зарегестрироваться на сайте. В главном меню нажать Создать статью',
                'created_at' => '2017-07-17 10:00:00'
                ],
                 [
                'user_id' => 1,
                'title' => 'Список пользователей',
                'text' => 'Всех пользователей портала можно найти по поиску в меню. ',
                'created_at' => '2017-07-21 16:00:00'
                 ],
        ]
        );
    }
}
