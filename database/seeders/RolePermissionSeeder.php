<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModeLEvents;



class RolePermissionSeeder extends Seeder
{
    // public function run()
    // {
    //    $adminRole = Role::create(['name' => 'admin']);
    //     $adminEditor = Role::create(['name' => 'editor']);
    // }
    public function run()
    {
        $roles = ['admin', 'colaborador', 'instructor'];

        foreach ($roles as $role) {
            Role::firstOrCreate(['name' => $role]);
        }
    }

}
