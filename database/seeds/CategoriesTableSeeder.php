<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {



        DB::table('users')->truncate();

        DB::table('categories')->insert(
        [
            ['name' => 'Без категории'],
            ['name' => 'HTML'],
            ['name' => 'CSS'],
            ['name' => 'JS'],
            ['name' => 'PHP'],
            ['name' => 'SQL'],
            ['name' => 'Laravel'],
        ]
        );
    }
}
