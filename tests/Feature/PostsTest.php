<?php

namespace Tests\Feature;

use App\Models\Posts;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PostsTest extends TestCase
{
    use RefreshDatabase;

    const BASE_URL = 'api/v1/posts';

    public function testStatusCode()
    {
        $response = $this->get(self::BASE_URL);
        $response->assertStatus(200);
        $response->assertHeader('content-type', 'application/json');
    }

    public function testPostsData()
    {
        $posts = factory(Posts::class, 5)->create()->toArray();
        $response = $this->get(self::BASE_URL);
        $response->assertStatus(200);
        $response->assertHeader('content-type', 'application/json');
        $response->assertExactJson(
            [
            'data' => $posts,
            ]
        );
    }
}
