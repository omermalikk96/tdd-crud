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
        $response=$this->assertCount(1, Book::all());
       
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
        $response = $this->assertCount(0, Book::all());
    }
    public function test_example_get_book_with_authenticated_user()
    {

        $user = User::factory()->create();
        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);
        Book::create([
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
        $response = $this->assertAuthenticated();
        $response =$this->actingAs($user)->get('/books');
        $response->assertViewHas('books');
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
       
        Storage::fake('avatars');
        $book = Book::create([
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

        $this->assertCount(1, Book::all());
        $response = $this->actingAs($user)->delete('/books/'.$book->id);
        $this->assertCount(0, Book::all());
        $response->assertOk();
       
    }

    public function test_example_delete_with_unauthenticated_user()
    {
        Storage::fake('avatars');
        $book = Book::create([
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

        $response = $this->delete('/books/'.$book->id);
        $this->assertCount(1, Book::all());
        $response->assertstatus(302);
       
    }

    public function test_example_show_with_authenticated_user()
    {
        $user = User::factory()->create();
       
        Storage::fake('avatars');
        $book = Book::create([
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
        // $this->assertCount(1, Book::all());
        $response = $this->actingAs($user)->get('/books/'.$book->id);
        $response->assertViewHas('book');
        $response->assertSeeText('demo');
        $response->assertOk();
    }

    public function test_example_show_with_unauthenticated_user()
    {
        Storage::fake('avatars');
        $book = Book::create([
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


        $response = $this->get('/books/'.$book->id);
        $response->assertDontSeeText('demo');
        $response->assertstatus(302);
       
    }

    public function test_example_update_with_authenticated_user()
    {
        $user = User::factory()->create();
        // $response = $this->post('/login', [
        //     'email' => $user->email,
        //     'password' => 'password',
        // ]);
        // $response = $this->assertAuthenticated();
        Storage::fake('avatars');
        $book = Book::create([
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
        $response->assertSeeText('demoooo');
        $response->assertStatus(200);
        
    }
    public function test_example_update_with_unauthenticated_user()
    {
        Storage::fake('avatars');
        $book = Book::create([
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
        $response->assertDontSeeText('demoooo','demooooooo');
        $response->assertStatus(302);
    }

  
}
