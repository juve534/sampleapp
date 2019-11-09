<?php

declare(strict_types=1);

namespace Tests\Feature\Posts;

use App\Models\Comments;
use App\Models\Posts;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ShowTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    const BASE_URL = 'api/v1/posts';

    /**
     * showメソッドの正常系.
     *
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

    /**
     * showメソッドの異常系.
     *
     * @test
     */
    public function testShow404()
    {
        // setup
        $id = $this->faker->randomNumber();

        $response = $this->get(self::BASE_URL . '/' . $id);
        $response->assertStatus(404);
        $response->assertHeader('content-type', 'application/json');
        $response->assertExactJson(
            [
                'error' => [
                    'type'    => 'not_found',
                    'message' => '見つかりません',
                ],
            ]
        );
    }
}
