<?php

namespace Tests\Feature\Backend;

use App\Models\Tag;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TagTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function an_admin_can_see_tags()
    {
        $admin = User::factory()->create(['is_admin' => true]);

        Tag::factory(10)->create();

        $this->actingAs($admin)
            ->get(route('admin.tags.index'));

        $this->assertDatabaseCount('tags', 10);
    }

    /** @test */
    public function an_admin_can_see_create_tag_form()
    {
        $admin = User::factory()->create(['is_admin' => true]);

        $this->actingAs($admin)
            ->get(route('admin.tags.create'))
            ->assertSee('Create A New Tag');
    }

    /** @test */
    public function it_should_fail_validation_error_tag()
    {
        $admin = User::factory()->create(['is_admin' => true]);

        $response = $this->actingAs($admin)
            ->post(route('admin.tags.store'), [
                'name' => '',
            ]);

        $response->assertSessionHasErrors(['name']);
    }

    /** @test */
    public function an_admin_can_create_a_tag()
    {
        $admin = User::factory()->create(['is_admin' => true]);

        $this->actingAs($admin)
            ->post(route('admin.tags.store'), [
                'name' => 'PHP',
            ])
            ->assertStatus(302);
        
        $this->assertDatabaseCount('tags',1);
    }

    /** @test */
    public function an_admin_can_see_edit_tag_page()
    {
        $admin = User::factory()->create(['is_admin' => true]);
        $tag = Tag::factory()->create();

        $this->actingAs($admin)
            ->get(route('admin.tags.edit',$tag->id))
            ->assertSee($tag->name);
    }
    
    /** @test */
    public function an_admin_can_update_a_tag_info()
    {
        $admin = User::factory()->create(['is_admin' => true]);
        $tag = Tag::factory()->create();

        $this->actingAs($admin)
            ->put(route('admin.tags.update',$tag->id),[
                'name' => 'HTML',
            ])
            ->assertStatus(302);

        $this->assertDatabaseHas('tags',[
            'name' => 'HTML',
        ]);
    }

    /** @test */
    public function an_admin_can_delete_a_tag()
    {
        $admin = User::factory()->create(['is_admin' => true]);

        $tag = Tag::factory()->create();

        $this->actingAs($admin)
            ->delete(route('admin.tags.destroy',$tag->id))
            ->assertStatus(302);

        $this->assertDeleted($tag);
    }

}
