<?php

namespace Tests\Feature\Backend;

use Tests\TestCase;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PostTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        $this->admin = User::factory()->create(['is_admin' => true]);

        $this->post = Post::factory()->create();
    }

    /** @test */
    public function an_admin_can_see_posts()
    {
        Post::factory(5)->create();

        $this->actingAs($this->admin)
            ->get(route('admin.posts.index'));

        $this->assertDatabaseCount('posts', 6);
    }

    /** @test */
    public function an_admin_can_see_create_page()
    {
        $this->actingAs($this->admin)
            ->get(route('admin.posts.create'))
            ->assertOk();
    }

    /** @test */
    public function an_admin_can_create_a_post()
    {
        Storage::fake('public');

        $file = UploadedFile::fake()->image('avatar.jpg');

        $this->actingAs($this->admin)
            ->post(route('admin.posts.store'), [
                'title' => 'title',
                'desc' => 'any desc you want',
                'image' => $file,
                'tag_id' => Tag::factory()->create()->id,
            ]);

        Storage::assertExists("post_images/{$file->hashName()}");

        $this->assertDatabaseCount('posts', 2);
    }

    /** @test */
    public function an_admin_can_see_post_update_page()
    {
        $this->actingAs($this->admin)
            ->get(route('admin.posts.edit', $this->post->id))
            ->assertOk();
    }

    /** @test */
    public function an_admin_can_update_a_post()
    {

        Storage::fake('public');

        $file = UploadedFile::fake()->image('post.jpg');

        $this->actingAs($this->admin)
            ->put(route('admin.posts.update', $this->post->id), [
                'title' => 'how to write a clean code',
                'desc' => 'new desc',
                'image' => $file,
                'tag_id' => Tag::factory()->create()->id,
            ]);

        Storage::assertMissing("post_images/{$this->post->image}");

        Storage::assertExists("post_images/{$file->hashName()}");

        $this->assertDatabaseHas('posts', [
            'title' => 'how to write a clean code'
        ]);
    }

    /** @test */
    public function an_admin_can_delete_a_post()
    {
        Storage::fake('public');

        $file = UploadedFile::fake()->image('post.jpg');

        $this->post = Post::factory()->create(['image' => $file]);

        $this->actingAs($this->admin)
            ->delete(route('admin.posts.destroy', $this->post->id));

        Storage::assertMissing("post_images/{$this->post->image}");

        $this->assertDeleted($this->post);
    }
}
