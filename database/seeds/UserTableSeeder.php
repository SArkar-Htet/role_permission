<?php

use Illuminate\Database\Seeder;
use App\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      User::create([
        'name' => 'Super Admin',
        'email' => 'developer.soearkarhtet@gmail.com',
        'password' => Hash::make('internet')
      ]);
    }
}
