<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use PHPUnit\Framework\Attributes\Test;

class ProfileUpdateTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function user_can_update_profile_data()
    {
        $user = User::factory()->create([
            'age' => 25,
            'gender' => 'male',
            'weight' => 60,
            'height' => 170,
        ]);

        $this->actingAs($user);

        $response = $this->put('/profile', [
            'age' => 30,
            'gender' => 'female',
            'weight' => 70,
            'height' => 175,
        ]);

        $response->assertRedirect();

        $user = $user->fresh();
        $this->assertEquals(30, $user->age);
        $this->assertEquals('female', $user->gender);
        $this->assertEquals(70, $user->weight);
        $this->assertEquals(175, $user->height);
    }

    #[Test]
    public function profile_update_fails_with_invalid_data()
    {
        $user = User::factory()->create();

        $this->actingAs($user);

        $response = $this->from('/profile')->put('/profile', [
            'age' => 5,
            'gender' => 'alien',
            'weight' => 70,
            'height' => 175,
        ]);

        $response->assertRedirect('/profile');
        $response->assertSessionHasErrors(['age', 'gender']);
    }
}
