<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\User;
use App\Models\Site;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SitesControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test **/
    public function it_creates_sites(): void
    {
        $this->withoutExceptionHandling(); // por algum motivo está na verdade trazendo os erros
        // create a user
        $user = User::factory()->create();

        // return $this->actingAs($user)->assertAuthenticated();

        // dd($user);
        
        // make a post request to a route to create a site
        $response = $this->followingRedirects()->actingAs($user)->post(route('site.store'), [
            'name' => 'Google',
            'url' => 'https://google.com'
        ]);

        // dd('passou');
        
        // make sure the site exists in the database
        $site = Site::first();
        $this->assertEquals(1, Site::count());
        $this->assertEquals('Google', $site->name);
        $this->assertEquals('https://google.com', $site->url);
        $this->assertNull($site->is_online);
        $this->assertEquals($user->id, $site->user->id);
        
        // see site's name on the page
        $response->assertSeeText('Google');
        $this->assertEquals(route('site.show', $site), url()->current());
    }
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
