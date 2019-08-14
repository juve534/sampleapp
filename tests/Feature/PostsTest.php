<?php

namespace Tests\Feature;

use App\Models\Comments;
use App\Models\Posts;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PostsTest extends TestCase
{
    use RefreshDatabase;

    const BASE_URL = 'api/v1/posts';

    /**
     * indexメソッドの正常系
     * @test
     */
    public function testIndex200()
    {
        $posts = factory(Posts::class, 5)->create()->toArray();
        $response = $this->get(self::BASE_URL);
        $response->assertStatus(200);
        $response->assertHeader('content-type', 'application/json');
        $response->assertExactJson(
            $posts
        );
    }

    {
        $response->assertStatus(200);
        $response->assertHeader('content-type', 'application/json');
        $response->assertExactJson(
        );
    }
}
