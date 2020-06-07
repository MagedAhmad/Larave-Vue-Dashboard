<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\User;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class AccessDashboardTest extends TestCase
{
    protected function setUp(): void 
    {
    	parent::setUp();
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        Permission::create(['name' => 'control content']);
        Permission::create(['name' => 'control profile']);

        // create roles and assign existing permissions
        $role1 = Role::create(['name' => 'writer']);
        $role1->givePermissionTo('control content');

        $role2 = Role::create(['name' => 'user']);
        $role2->givePermissionTo('control profile');


        $role3 = Role::create(['name' => 'super-admin']);
    }
    use RefreshDatabase;
    /** @test */
    public function user_must_login_to_access_to_admin_dashboard()
    {
        $this->get('/dashboard')
             ->assertRedirect('login');
    }

    /** @test */
    public function admin_can_access_to_admin_dashboard()
    {
        $adminUser = factory(User::class)->create();
        $adminUser->assignRole('super-admin');
        $this->actingAs($adminUser);
        $response = $this->get('/admin');

        $response->assertOk();
    }

    /** @test */
    public function writer_can_access_admin_dashboard()
    {
        $writerUser = factory(User::class)->create();
        $writerUser->assignRole('writer');
        $this->actingAs($writerUser);
        $response = $this->get('/admin');

        $response->assertOk();
    }

    /** @test */
    public function normal_user_cannot_access_dashboard()
    {
        $user = factory(User::class)->create();
        $user->assignRole('user');
        $this->actingAs($user);
        $this->get('/admin')->assertStatus(403);
    }
}
