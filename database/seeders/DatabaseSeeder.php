<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void {
        $admin = Role::create(['name' => 'admin']);
        $member = Role::create(['name' => 'member']);

        Permission::create(['name' => 'manage books']);
        Permission::create(['name' => 'manage members']);
        Permission::create(['name' => 'manage transactions']);
        Permission::create(['name' => 'create transactions']);
        Permission::create(['name' => 'view transactions']);

        $admin->givePermissionTo(Permission::all());

        $member->givePermissionTo([
            'create transactions',
            'view transactions'
        ]);

        $admin01 = User::create([
            'name' => 'Diki Muhamad Alfikri',
            'email' => 'diki@gmail.com',
            'password' => bcrypt('12345')
        ]);

        $admin01->assignRole('admin');
    }
}
