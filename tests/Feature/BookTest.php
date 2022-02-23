<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Book;
use App\Models\User;
// use Illuminate\Foundation\Auth\User;
use Illuminate\Http\UploadedFile;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BookTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example_store_with_authenticated_user()
    {
        $user = User::factory()->create();
        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);
        $response = $this->assertAuthenticated();
        Storage::fake('avatars');
        $response = $this->actingAs($user)->post('/books', [
            'title' => 'demo',
            'author' => 'demo',
            'image' => UploadedFile::fake()->image('avatar.jpg'),
            'publish_date' => '2022-02-21',
            'cost' => '1000',
            'short_description' => 'test',
            'description' => 'test long',
            'is_active' => 0,
            'stock' => '50',
        ]);
        $response->assertStatus(200);
       
    }

    public function test_example_store_with_unauthenticated_user()
    {
        Storage::fake('avatars');
        $response = $this->post('/books', [
            'title' => 'demo',
            'author' => 'demo',
            'image' => UploadedFile::fake()->image('avatar.jpg'),
            'publish_date' => '2022-02-21',
            'cost' => '1000',
            'short_description' => 'test',
            'description' => 'test long',
            'is_active' => 0,
            'stock' => '50',
        ]);
        $response->assertStatus(302);
    }
    public function test_example_get_book_with_authenticated_user()
    {
        // $this->withoutExceptionHandling();
        $user = User::factory()->create();
        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);
        $response = $this->assertAuthenticated();
        $response =$this->actingAs($user)->get('/books');
        $response->assertStatus(200);

    }

    public function test_example_get_book_with_unauthenticated_user()
    {
        $response =$this->get('/books');
        $response->assertStatus(302);
    }
   
    public function test_example_delete_with_authenticated_user()
    {
        $user = User::factory()->create();
        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);
        $response = $this->assertAuthenticated();
        Storage::fake('avatars');
        $response = $this->actingAs($user)->post('/books', [
            'title' => 'demo',
            'author' => 'demo',
            'image' => UploadedFile::fake()->image('avatar.jpg'),
            'publish_date' => '2022-02-21',
            'cost' => '1000',
            'short_description' => 'test',
            'description' => 'test long',
            'is_active' => 0,
            'stock' => '50',
        ]);
        $response->assertOk();

        $book=Book::first();
        $this->assertCount(1, Book::all());
        $response = $this->actingAs($user)->delete('/books/'.$book->id);
        $this->assertCount(0, Book::all());
        $response->assertOk();
       
    }

    public function test_example_delete_with_unauthenticated_user()
    {
        $user = User::factory()->create();
        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);
        $response = $this->assertAuthenticated();
        Storage::fake('avatars');
        $response = $this->actingAs($user)->post('/books', [
            'title' => 'demo',
            'author' => 'demo',
            'image' => UploadedFile::fake()->image('avatar.jpg'),
            'publish_date' => '2022-02-21',
            'cost' => '1000',
            'short_description' => 'test',
            'description' => 'test long',
            'is_active' => 0,
            'stock' => '50',
        ]);
        $response->assertOk();
        $this->post('logout');
        $book=Book::first();
        $response = $this->delete('/books/'.$book->id);
        $response->assertstatus(302);
       
    }

    public function test_example_show_with_authenticated_user()
    {
        $user = User::factory()->create();
        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);
        $response = $this->assertAuthenticated();
        Storage::fake('avatars');
        $response = $this->actingAs($user)->post('/books', [
            'title' => 'demo',
            'author' => 'demo',
            'image' => UploadedFile::fake()->image('avatar.jpg'),
            'publish_date' => '2022-02-21',
            'cost' => '1000',
            'short_description' => 'test',
            'description' => 'test long',
            'is_active' => 0,
            'stock' => '50',
        ]);
        $response->assertStatus(200);
        $book=Book::first();
        $response = $this->actingAs($user)->get('/books/'.$book->id);
        $response->assertOk();
    }

    public function test_example_show_with_unauthenticated_user()
    {
        $user = User::factory()->create();
        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);
        $response = $this->assertAuthenticated();
        Storage::fake('avatars');
        $response = $this->actingAs($user)->post('/books', [
            'title' => 'demo',
            'author' => 'demo',
            'image' => UploadedFile::fake()->image('avatar.jpg'),
            'publish_date' => '2022-02-21',
            'cost' => '1000',
            'short_description' => 'test',
            'description' => 'test long',
            'is_active' => 0,
            'stock' => '50',
        ]);
        $response->assertOk();
        $this->post('logout');
        $book=Book::first();
        $response = $this->get('/books/'.$book->id);
        $response->assertstatus(302);
       
    }

    public function test_example_update_with_authenticated_user()
    {
        $user = User::factory()->create();
        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);
        $response = $this->assertAuthenticated();
        Storage::fake('avatars');
        $response = $this->actingAs($user)->post('/books', [
            'title' => 'demo',
            'author' => 'demo',
            'image' => UploadedFile::fake()->image('avatar.jpg'),
            'publish_date' => '2022-02-21',
            'cost' => '1000',
            'short_description' => 'test',
            'description' => 'test long',
            'is_active' => 0,
            'stock' => '50',
        ]);
        $response->assertOk();
        $book=Book::first();
        $response = $this->actingAs($user)->patch('/books/'.$book->id, [
            'title' => 'demooooooo',
            'author' => 'demoooo',
            'image' => UploadedFile::fake()->image('avatar.jpg'),
            'publish_date' => '2022-02-21',
            'cost' => '1000',
            'short_description' => 'test',
            'description' => 'test long',
            'is_active' => 0,
            'stock' => '50',
        ]);
       
        $this->assertEquals('demooooooo', Book::first()->title);
        $this->assertEquals('demoooo', Book::first()->author);
        $response->assertStatus(200);
        
    }
    public function test_example_update_with_unauthenticated_user()
    {
        $user = User::factory()->create();
        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);
        $response = $this->assertAuthenticated();
        Storage::fake('avatars');
        $response = $this->actingAs($user)->post('/books', [
            'title' => 'demo',
            'author' => 'demo',
            'image' => UploadedFile::fake()->image('avatar.jpg'),
            'publish_date' => '2022-02-21',
            'cost' => '1000',
            'short_description' => 'test',
            'description' => 'test long',
            'is_active' => 0,
            'stock' => '50',
        ]);
        $response->assertOk();
        $book=Book::first();
       
        $response = $this->post('logout');
        
        $response = $this->patch('/books/'.$book->id, [
            'title' => 'demooooooo',
            'author' => 'demoooo',
            'image' => UploadedFile::fake()->image('avatar.jpg'),
            'publish_date' => '2022-02-21',
            'cost' => '1000',
            'short_description' => 'test',
            'description' => 'test long',
            'is_active' => 0,
            'stock' => '50',
        ]);
        $response->assertStatus(302);
    }

  
}
