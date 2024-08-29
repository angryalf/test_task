<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Log;
use Tests\TestCase;

class SubmissionTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_submission_validation(): void
    {
        $response = $this->postJson('/api/submit', ['first_name' => 'Sally']);


        $response->assertJsonValidationErrors(['name','email','message']);

    }


    /**
     * A basic feature test example.
     */
    public function test_submission_success(): void
    {
        $email = fake()->email;

        $data = [
            'name' => 'User Name',
            'email' => $email,
            'message' => 'TEXT_HERE_WITH_SOME_DETAILS'
        ];


        Log::shouldReceive('channel')
            ->with('submission')
            ->andReturnSelf();

        Log::shouldReceive('info')
            ->once()
            ->with('Submission saved', ['name' => 'User Name', 'email' => $email]);


        $response = $this->postJson('/api/submit', $data);


        $response
            ->assertStatus(200)
            ->assertJson([
                'message' => 'ok',
            ]);
    }


}
