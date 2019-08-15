<?php

namespace Tests\Feature;

use App\Models\Comments;
use App\Models\Posts;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Mockery;

class PostsTest extends TestCase
{
    use RefreshDatabase, WithFaker;

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

    /**
     * showメソッドの正常系
     * @test
     */
    public function testShow200()
    {
        // setup
        $expected = factory(Posts::class)->create()->toArray();
        unset($expected['created_at']);
        unset($expected['updated_at']);

        /** @var \Illuminate\Database\Eloquent\Collection $comments */
        $comments = factory(Comments::class, 5)->create(
            [
                'posts_id' => $expected['id'],
            ]
        );
        $expected['comments'] = $comments->map(function (Comments $item) {
            $arr['id'] = $item->id;
            $arr['commenter'] = $item->commenter;
            $arr['body'] = $item->body;

            return $arr;
        })->toArray();

        $response = $this->get(self::BASE_URL . '/' . $expected['id']);
        $response->assertStatus(200);
        $response->assertHeader('content-type', 'application/json');
        $response->assertExactJson(
            [
                'data' => $expected,
            ]
        );
    }
}
