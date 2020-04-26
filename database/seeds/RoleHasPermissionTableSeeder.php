<?php

use Illuminate\Database\Seeder;
use App\Models\Role_Has_Permission;

class RoleHasPermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      for ($i = 1; $i <= 8; $i++) {
        Role_Has_Permission::create([
          'permission_id' => $i,
          'role_id' => 1
        ]);
      }
    }
}
