<?php

declare(strict_types=1);

namespace Tests\Feature\Posts;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CreateTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    const BASE_URL = 'v1/posts';

    /**
     * 投稿API成功
     *
     * @test
     */
    public function test200()
    {
        $title = $this->faker->title;
        $body = $this->faker->sentence;

        $response = $this->json('POST', self::BASE_URL,
            [
                'title' => $title,
                'body'  => $body,
            ]
        );
        $response->assertStatus(200);
        $response->assertHeader('content-type', 'application/json');
    }
}
