<?php

use App\Models\Role;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Auto generated seed file.
     */
    public function run()
    {
        $role = Role::firstOrNew(['name' => 'admin']);
        if (!$role->exists) {
            $role->fill([
                    'display_name' => 'Administrator',
                ])->save();
        }

        $role = Role::firstOrNew(['name' => 'agency_admin']);
        if (!$role->exists) {
            $role->fill([
                    'display_name' => 'Agency Admin',
                ])->save();
        }

        $role = Role::firstOrNew(['name' => 'agent']);
        if (!$role->exists) {
            $role->fill([
                    'display_name' => 'Agent',
                ])->save();
        }
    }
}
