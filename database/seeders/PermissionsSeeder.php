<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class PermissionsSeeder extends Seeder
{
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // Create default permissions
        Permission::create(['name' => 'list addresses']);
        Permission::create(['name' => 'view addresses']);
        Permission::create(['name' => 'create addresses']);
        Permission::create(['name' => 'update addresses']);
        Permission::create(['name' => 'delete addresses']);

        Permission::create(['name' => 'list appdefaults']);
        Permission::create(['name' => 'view appdefaults']);
        Permission::create(['name' => 'create appdefaults']);
        Permission::create(['name' => 'update appdefaults']);
        Permission::create(['name' => 'delete appdefaults']);

        Permission::create(['name' => 'list banks']);
        Permission::create(['name' => 'view banks']);
        Permission::create(['name' => 'create banks']);
        Permission::create(['name' => 'update banks']);
        Permission::create(['name' => 'delete banks']);

        Permission::create(['name' => 'list bankaccounts']);
        Permission::create(['name' => 'view bankaccounts']);
        Permission::create(['name' => 'create bankaccounts']);
        Permission::create(['name' => 'update bankaccounts']);
        Permission::create(['name' => 'delete bankaccounts']);

        Permission::create(['name' => 'list brands']);
        Permission::create(['name' => 'view brands']);
        Permission::create(['name' => 'create brands']);
        Permission::create(['name' => 'update brands']);
        Permission::create(['name' => 'delete brands']);

        Permission::create(['name' => 'list categories']);
        Permission::create(['name' => 'view categories']);
        Permission::create(['name' => 'create categories']);
        Permission::create(['name' => 'update categories']);
        Permission::create(['name' => 'delete categories']);

        Permission::create(['name' => 'list charges']);
        Permission::create(['name' => 'view charges']);
        Permission::create(['name' => 'create charges']);
        Permission::create(['name' => 'update charges']);
        Permission::create(['name' => 'delete charges']);

        Permission::create(['name' => 'list cities']);
        Permission::create(['name' => 'view cities']);
        Permission::create(['name' => 'create cities']);
        Permission::create(['name' => 'update cities']);
        Permission::create(['name' => 'delete cities']);

        Permission::create(['name' => 'list companies']);
        Permission::create(['name' => 'view companies']);
        Permission::create(['name' => 'create companies']);
        Permission::create(['name' => 'update companies']);
        Permission::create(['name' => 'delete companies']);

        Permission::create(['name' => 'list companycontacts']);
        Permission::create(['name' => 'view companycontacts']);
        Permission::create(['name' => 'create companycontacts']);
        Permission::create(['name' => 'update companycontacts']);
        Permission::create(['name' => 'delete companycontacts']);

        Permission::create(['name' => 'list conditions']);
        Permission::create(['name' => 'view conditions']);
        Permission::create(['name' => 'create conditions']);
        Permission::create(['name' => 'update conditions']);
        Permission::create(['name' => 'delete conditions']);

        Permission::create(['name' => 'list contacts']);
        Permission::create(['name' => 'view contacts']);
        Permission::create(['name' => 'create contacts']);
        Permission::create(['name' => 'update contacts']);
        Permission::create(['name' => 'delete contacts']);

        Permission::create(['name' => 'list countries']);
        Permission::create(['name' => 'view countries']);
        Permission::create(['name' => 'create countries']);
        Permission::create(['name' => 'update countries']);
        Permission::create(['name' => 'delete countries']);

        Permission::create(['name' => 'list currencies']);
        Permission::create(['name' => 'view currencies']);
        Permission::create(['name' => 'create currencies']);
        Permission::create(['name' => 'update currencies']);
        Permission::create(['name' => 'delete currencies']);

        Permission::create(['name' => 'list customers']);
        Permission::create(['name' => 'view customers']);
        Permission::create(['name' => 'create customers']);
        Permission::create(['name' => 'update customers']);
        Permission::create(['name' => 'delete customers']);

        Permission::create(['name' => 'list employees']);
        Permission::create(['name' => 'view employees']);
        Permission::create(['name' => 'create employees']);
        Permission::create(['name' => 'update employees']);
        Permission::create(['name' => 'delete employees']);

        Permission::create(['name' => 'list inventories']);
        Permission::create(['name' => 'view inventories']);
        Permission::create(['name' => 'create inventories']);
        Permission::create(['name' => 'update inventories']);
        Permission::create(['name' => 'delete inventories']);

        Permission::create(['name' => 'list invoices']);
        Permission::create(['name' => 'view invoices']);
        Permission::create(['name' => 'create invoices']);
        Permission::create(['name' => 'update invoices']);
        Permission::create(['name' => 'delete invoices']);

        Permission::create(['name' => 'list locations']);
        Permission::create(['name' => 'view locations']);
        Permission::create(['name' => 'create locations']);
        Permission::create(['name' => 'update locations']);
        Permission::create(['name' => 'delete locations']);

        Permission::create(['name' => 'list paymentmades']);
        Permission::create(['name' => 'view paymentmades']);
        Permission::create(['name' => 'create paymentmades']);
        Permission::create(['name' => 'update paymentmades']);
        Permission::create(['name' => 'delete paymentmades']);

        Permission::create(['name' => 'list paymentmethods']);
        Permission::create(['name' => 'view paymentmethods']);
        Permission::create(['name' => 'create paymentmethods']);
        Permission::create(['name' => 'update paymentmethods']);
        Permission::create(['name' => 'delete paymentmethods']);

        Permission::create(['name' => 'list paymentsreceiveds']);
        Permission::create(['name' => 'view paymentsreceiveds']);
        Permission::create(['name' => 'create paymentsreceiveds']);
        Permission::create(['name' => 'update paymentsreceiveds']);
        Permission::create(['name' => 'delete paymentsreceiveds']);

        Permission::create(['name' => 'list paymentterms']);
        Permission::create(['name' => 'view paymentterms']);
        Permission::create(['name' => 'create paymentterms']);
        Permission::create(['name' => 'update paymentterms']);
        Permission::create(['name' => 'delete paymentterms']);

        Permission::create(['name' => 'list prefixes']);
        Permission::create(['name' => 'view prefixes']);
        Permission::create(['name' => 'create prefixes']);
        Permission::create(['name' => 'update prefixes']);
        Permission::create(['name' => 'delete prefixes']);

        Permission::create(['name' => 'list products']);
        Permission::create(['name' => 'view products']);
        Permission::create(['name' => 'create products']);
        Permission::create(['name' => 'update products']);
        Permission::create(['name' => 'delete products']);

        Permission::create(['name' => 'list purchaseorders']);
        Permission::create(['name' => 'view purchaseorders']);
        Permission::create(['name' => 'create purchaseorders']);
        Permission::create(['name' => 'update purchaseorders']);
        Permission::create(['name' => 'delete purchaseorders']);

        Permission::create(['name' => 'list purchaseorderitems']);
        Permission::create(['name' => 'view purchaseorderitems']);
        Permission::create(['name' => 'create purchaseorderitems']);
        Permission::create(['name' => 'update purchaseorderitems']);
        Permission::create(['name' => 'delete purchaseorderitems']);

        Permission::create(['name' => 'list salesorders']);
        Permission::create(['name' => 'view salesorders']);
        Permission::create(['name' => 'create salesorders']);
        Permission::create(['name' => 'update salesorders']);
        Permission::create(['name' => 'delete salesorders']);

        Permission::create(['name' => 'list salesorderitems']);
        Permission::create(['name' => 'view salesorderitems']);
        Permission::create(['name' => 'create salesorderitems']);
        Permission::create(['name' => 'update salesorderitems']);
        Permission::create(['name' => 'delete salesorderitems']);

        Permission::create(['name' => 'list settings']);
        Permission::create(['name' => 'view settings']);
        Permission::create(['name' => 'create settings']);
        Permission::create(['name' => 'update settings']);
        Permission::create(['name' => 'delete settings']);

        Permission::create(['name' => 'list suppliers']);
        Permission::create(['name' => 'view suppliers']);
        Permission::create(['name' => 'create suppliers']);
        Permission::create(['name' => 'update suppliers']);
        Permission::create(['name' => 'delete suppliers']);

        Permission::create(['name' => 'list townships']);
        Permission::create(['name' => 'view townships']);
        Permission::create(['name' => 'create townships']);
        Permission::create(['name' => 'update townships']);
        Permission::create(['name' => 'delete townships']);

        // Create user role and assign existing permissions
        $currentPermissions = Permission::all();
        $userRole = Role::create(['name' => 'user']);
        $userRole->givePermissionTo($currentPermissions);

        // Create admin exclusive permissions
        Permission::create(['name' => 'list roles']);
        Permission::create(['name' => 'view roles']);
        Permission::create(['name' => 'create roles']);
        Permission::create(['name' => 'update roles']);
        Permission::create(['name' => 'delete roles']);

        Permission::create(['name' => 'list permissions']);
        Permission::create(['name' => 'view permissions']);
        Permission::create(['name' => 'create permissions']);
        Permission::create(['name' => 'update permissions']);
        Permission::create(['name' => 'delete permissions']);

        Permission::create(['name' => 'list users']);
        Permission::create(['name' => 'view users']);
        Permission::create(['name' => 'create users']);
        Permission::create(['name' => 'update users']);
        Permission::create(['name' => 'delete users']);

        // Create admin role and assign all permissions
        $allPermissions = Permission::all();
        $adminRole = Role::create(['name' => 'super-admin']);
        $adminRole->givePermissionTo($allPermissions);

        $user = \App\Models\User::whereEmail('admin@admin.com')->first();

        if ($user) {
            $user->assignRole($adminRole);
        }
    }
}
