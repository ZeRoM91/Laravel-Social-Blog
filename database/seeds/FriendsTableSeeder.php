<?php

use Illuminate\Database\Seeder;

class FriendsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        DB::table('friends')->truncate();
        DB::table('friends')->insert(
            [
            [
                'from_user_id' => 1,
                'to_user_id' => 2,
                'status' => true,
                'created_at' => date("Y-m-d H:i:s"),

            ],
            [
                'from_user_id' => 2,
                'to_user_id' => 1,
                'status' => true,
                'created_at' => date("Y-m-d H:i:s"),

            ],
            ]

        );
    }
}
