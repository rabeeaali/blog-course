<?php

namespace Tests\Feature\Frontend;

use App\Models\Post;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserAuthTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_visitor_can_see_posts_in_home_page()
    {
        Post::factory(10)->create();
      
        $this->get('/');

        $this->assertDatabaseCount('posts',10);
    }

    /** @test */
    public function a_visitor_can_see_the_home_page()
    {
        $this->get('/')->assertSee('Posts');
    }

    /** @test */
    public function a_user_can_see_the_home_page()
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->get('/')
            ->assertSee('Posts');
    }

    /** @test */
    public function an_admin_can_see_dashboard()
    {
        $admin = User::factory()->create(['is_admin'=>true]);

        $this->actingAs($admin)
            ->get('/admin')
            ->assertSee('Dashboard');
    }

    /** @test */
    public function a_user_can_not_access_to_the_dashboard()
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->get('/admin')
            ->assertRedirect('/login');
    }

    /** @test */
    public function a_user_can_see_post()
    {   
        $post = Post::factory()->create();

        $this->get(route('frontend.post.show',$post->id))
            ->assertSee($post->title);
    }
}
