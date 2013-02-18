<?php

class UsersTableSeeder extends Seeder {

    public function run()
    {
        DB::table('users')->delete();


        $users = array(
            array(
                'username'      => 'test',
                'email'      => 'test@test.com',
                'password'   => Hash::make('test'),
                'confirmed'   => 0
            )
        );

        DB::table('users')->insert( $users );
    }

}