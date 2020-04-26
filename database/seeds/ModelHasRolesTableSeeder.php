<?php

use Illuminate\Database\Seeder;
use App\Models\Model_Has_Roles;

class ModelHasRolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      Model_Has_Roles::create([
        'role_id' => 1,
        'model_type' => 'App\User',
        'model_id' => 1
      ]);
    }
}
