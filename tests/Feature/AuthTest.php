<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;
use Laravel\Socialite\Contracts\User as SocialiteUser;
use Mockery;
use Tests\TestCase;
use PHPUnit\Framework\Attributes\Test;



class AuthTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function user_can_register_successfully()
    {
        $response = $this->post('/register', [
            'username' => 'TesztElek',
            'email' => 'teszt@example.com',
            'password' => 'titok1234',
            'password_confirmation' => 'titok1234',
        ]);

        $response->assertRedirect(route('welcome'));
        $this->assertAuthenticated();
        $this->assertDatabaseHas('users', [
            'email' => 'teszt@example.com',
        ]);
    }

    #[Test]
    public function user_can_login_with_valid_credentials()
    {
        $user = User::factory()->create([
            'email' => 'teszt@example.com',
            'password' => Hash::make('titok1234'),
        ]);

        $response = $this->post('/login', [
            'email' => 'teszt@example.com',
            'password' => 'titok1234',
        ]);

        $response->assertRedirect(route('welcome'));
        $this->assertAuthenticatedAs($user);
    }

    #[Test]
    public function google_authentication_redirects_user_correctly()
    {
        $googleUser = Mockery::mock();
        $googleUser->shouldReceive('getEmail')->andReturn('googleuser@example.com');
        $googleUser->shouldReceive('getName')->andReturn('Google Felhasználó');

        Socialite::shouldReceive('driver')
            ->with('google')
            ->andReturnSelf();

        Socialite::shouldReceive('stateless')
            ->andReturnSelf();

        Socialite::shouldReceive('user')
            ->andReturn($googleUser);


        Socialite::shouldReceive('driver->stateless->user')->andReturn($googleUser);

        $response = $this->get('/auth/google/callback');

        $response->assertRedirect('/');
        $this->assertAuthenticated();
        $this->assertDatabaseHas('users', [
            'email' => 'googleuser@example.com',
        ]);
    }

    public function user_cannot_login_with_wrong_password()
    {
        $user = User::factory()->create([
            'email' => 'teszt@example.com',
            'password' => bcrypt('titok1234'),
        ]);

        $response = $this->post('/login', [
            'email' => 'teszt@example.com',
            'password' => 'rosszjelszo',
        ]);

        $response->assertSessionHasErrors('email');
        $this->assertGuest();
    }

    #[Test]
    public function registration_fails_with_duplicate_email()
    {
        User::factory()->create([
            'email' => 'teszt@example.com',
        ]);

        $response = $this->post('/register', [
            'username' => 'UjUser',
            'email' => 'teszt@example.com',
            'password' => 'jelszo1234',
            'password_confirmation' => 'jelszo1234',
        ]);

        $response->assertSessionHasErrors('email');
        $this->assertGuest();
    }


    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }
}
