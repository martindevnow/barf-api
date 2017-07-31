<?php

namespace Tests\Unit\ACL;

use Martin\ACL\Permission;
use Martin\ACL\Role;
use Martin\ACL\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class RolesUnitTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function roles_have_a_model_factory() {
        $role = factory(Role::class)->create();

        $this->assertTrue($role instanceof Role);
    }

    /** @test */
    public function roles_have_all_fields_mass_assignable() {
        $role = factory(Role::class)->make();
        Role::create($role->toArray());

        $this->assertDatabaseHas('roles', $role->toArray());
    }

    /** @test */
    public function roles_can_be_assigned_to_users() {
        $role = factory(Role::class)->create();
        $user = factory(User::class)->create();

        $role->assignToUser($user);
        $role = $role->fresh(['users']);

        $this->assertCount(1, $role->users);
        $this->assertDatabaseHas('role_user', [
            'role_id'   => $role->id,
            'user_id'   => $user->id,
        ]);
    }

    /** @test */
    public function roles_can_be_removed_from_users() {
        /** @var Role $role */
        $role = factory(Role::class)->create();
        $user = factory(User::class)->create();

        $role->assignToUser($user);
        $role = $role->fresh(['users']);

        $this->assertCount(1, $role->users);
        $this->assertDatabaseHas('role_user', [
            'role_id'   => $role->id,
            'user_id'   => $user->id,
        ]);

        $role->removeFromUser($user);
        $role = $role->fresh(['users']);
        $user = $user->fresh(['roles']);

        $this->assertCount(0, $role->users);
        $this->assertDatabaseMissing('role_user', [
            'role_id'   => $role->id,
            'user_id'   => $user->id,
        ]);
    }

    /** @test */
    public function roles_can_be_given_permissions() {
        /** @var Role $role */
        $role = factory(Role::class)->create();
        $permission = factory(Permission::class)->create();
        $role->givePermissionTo($permission);

        $role = $role->fresh(['permissions']);
        $permission = $permission->fresh(['roles']);

        $this->assertDatabaseHas('permission_role', [
            'role_id'   => $role->id,
            'permission_id' => $permission->id,
        ]);

        $this->assertTrue($role->givePermissionTo($permission));
    }

    /** @test */
    public function roles_can_have_permissions_revoked() {
        /** @var Role $role */
        $role = factory(Role::class)->create();
        $permission = factory(Permission::class)->create();
        $role->givePermissionTo($permission);

        $role = $role->fresh(['permissions']);
        $permission = $permission->fresh(['roles']);

        $this->assertDatabaseHas('permission_role', [
            'role_id'   => $role->id,
            'permission_id' => $permission->id,
        ]);

        $role->removePermissionTo($permission);

        $role = $role->fresh(['permissions']);

        $this->assertCount(0, $role->permissions);
        $this->assertDatabaseMissing('permission_role', [
            'role_id'   => $role->id,
            'permission_id' => $permission->id,
        ]);
        $this->assertTrue($role->removePermissionTo($permission));

    }

    /** @test */
    public function roles_permissions_can_be_queried() {
        /** @var Role $role */
        $role = factory(Role::class)->create();
        $permission = factory(Permission::class)->create();
        $role->givePermissionTo($permission);

        $this->assertTrue($role->hasPermission($permission->code));
        $this->assertTrue($role->can($permission->code));
    }
}