<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class QuestionDataTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function showTest(): void
    {
        $response = $this->getJson('/api/questions/1');

        $response->assertStatus(200);
    }
}
