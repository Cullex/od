<?php
use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     * @throws Exception
     */
    public function run()
    {
        Model::unguard();

        // Users

        // Remove cache of permissions

        /** @var PermissionRegistrar $permissionRegistrar
         * @noinspection VirtualTypeCheckInspection
         */

        $permissionRegistrar = app()[PermissionRegistrar::class];
        $permissionRegistrar->forgetCachedPermissions();


        /** @var User $user */
        $user = factory(User::class)->create([
            'name' => 'Root',
            'last_name' => 'System',
            'email' => 'root@system',
            'password' => Hash::make('password')
        ]);

        /** @var Role $admin */
        $admin = Role::query()->create([
            'name' => 'admin',
        ]);

        collect([
            'manage users',
        ])->each(function ($permission) use ($admin){
            $admin->givePermissionTo(Permission::query()->create([
                'name' => $permission
            ]));
        });

        $user->assignRole($admin);

    }
}
