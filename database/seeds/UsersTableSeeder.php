<?php

use App\User;
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
        // for admin
        factory(User::class)->create([
            'name' => 'Admin',
            'email' => 'admin@admin.com'
        ]);

        factory(User::class, 100)->create();
    }
}
