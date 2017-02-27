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
        //
        $user = factory(User::class)->time(50)->make();
        User::insert($users->toArray());

        $user = User::find(1);
        $user->name = 'Aufree';
        $user->email = 'aufree@estgroupe.com';
        $user->password = bcrypt('password');
        $user->is_admin = true;
        $user->activated = true;
        $user->save();
    }
}
