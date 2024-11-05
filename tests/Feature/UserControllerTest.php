<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;

class UserControllerTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic unit test example.
     */
    /** @test */
    public function it_can_insert_user()
    {
        $response = $this->postJson('/users', [
            'first_name' => 'John',
            'last_name' => 'Doe',
            'email' => 'johndoe@example.com',
            'role' => 'user',
            'status' => 'active',
        ]);

        $response->assertStatus(200)
                 ->assertJsonStructure(['id', 'first_name', 'last_name', 'email', 'role', 'status']);
    }

    /** @test */
    public function it_can_append_attribute()
    {
        User::factory()->count(3)->create();

        $response = $this->postJson('/users/append-attribute', [
            'attribute' => 'FullName',
        ]);

        $response->assertStatus(200)
                ->assertJsonStructure([['id', 'FullName']]);
    }

    /** @test */
    public function it_checks_if_email_exists()
    {
        User::factory()->create(['email' => 'test@example.com']);

        $response = $this->postJson('/users/contains-email', [
            'email' => 'test@example.com',
        ]);

        $response->assertStatus(200)
                 ->assertJson(['contains_email' => true]);
    }


    /** @test */
    public function it_returns_diff_with_admins()
    {
        User::factory()->count(5)->create(['role' => 'user']);
        User::factory()->create(['role' => 'admin']);

        $response = $this->getJson('/users/diff-with-admins');

        $response->assertStatus(200);
    }

    /** @test */
    public function it_expects_id()
    {
        $user = User::factory()->create();

        $response = $this->postJson('/users/expect-id', [
            'id' => $user->id,
        ]);

        $response->assertStatus(200);
    }


    /** @test */
    public function it_can_find_user_by_id()
    {
        $user = User::factory()->create();

        $response = $this->postJson('/users/find-by-id', [
            'id' => $user->id,
        ]);

        $response->assertStatus(200)
                 ->assertJson(['id' => $user->id]);
    }

      /** @test */
      public function it_finds_or_fails_by_id()
      {
          $user = User::factory()->create();
  
          $response = $this->postJson('/users/find-or-fail-by-id', [
              'id' => $user->id,
          ]);
  
          $response->assertStatus(200)
                   ->assertJson(['id' => $user->id]);
      }

    /** @test */
    public function it_intersects_with_admins()
    {
        User::factory()->count(5)->create(['role' => 'user']);
        User::factory()->create(['role' => 'admin']);

        $response = $this->getJson('/users/intersect-with-admins');

        $response->assertStatus(200);
    }

    /** @test */
    public function it_loads_posts_for_users()
    {
        User::factory()->count(3)->create();

        $response = $this->getJson('/users/load-posts');

        $response->assertStatus(200);
    }
    
}
