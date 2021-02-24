<?php

namespace Tests\Feature\Backend;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        $this->admin = User::factory()->create(['is_admin' => true]);

        $this->user = User::factory()->create();
    }

    /** @test */
    public function an_admin_can_see_users()
    {
        User::factory(10)->create();

        $this->actingAs($this->admin)
            ->get(route('admin.users.index'));

        $this->assertDatabaseCount('users', 12);
    }

    /** @test */
    public function an_admin_can_see_create_user_form()
    {
        $this->actingAs($this->admin)
            ->get(route('admin.users.create'))
            ->assertSee('Create A New User');
    }

    /** @test */
    public function it_should_fail_validation_error_user()
    {
        $response = $this->actingAs($this->admin)
            ->post(route('admin.users.store'), [
                'name' => 'rabie',
            ]);

        $response->assertSessionHasErrors(['email', 'password']);
    }

    /** @test */
    public function an_admin_can_create_a_user()
    {
        $this->actingAs($this->admin)
            ->post(route('admin.users.store'), [
                'name' => 'rabie',
                'email' => 'test@gmail.com',
                'password' => 'password',
                'is_admin' => false,
            ])
            ->assertStatus(302);

        $this->assertDatabaseCount('users', 2);
    }

    /** @test */
    public function an_admin_can_see_edit_user_page()
    {
        $this->actingAs($this->admin)
            ->get(route('admin.users.edit', $this->user->id))
            ->assertSee($this->user->name);
    }


    /** @test */
    public function an_admin_can_update_a_user_info()
    {
        $this->actingAs($this->admin)
            ->put(route('admin.users.update', $this->user->id), [
                'name' => 'ali',
                'email' => 'ali@gmail.com',
                'password' => '123456',
                'is_admin' => true,
            ])
            ->assertStatus(302);

        $this->assertDatabaseHas('users', [
            'email' => 'ali@gmail.com',
        ]);
    }

    /** @test */
    public function an_admin_can_delete_a_user()
    {
        $this->actingAs($this->admin)
            ->delete(route('admin.users.destroy', $this->user->id))
            ->assertStatus(302);

        $this->assertDeleted($this->user);
    }
}
