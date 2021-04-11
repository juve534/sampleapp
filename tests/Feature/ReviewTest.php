<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ReviewTest extends TestCase
{
    use WithFaker;
    use RefreshDatabase;

    const BASE_URL = 'api/v1/review';

    /**
     * 口コミ投稿の正常系.
     *
     * @test
     */
    public function testReview200()
    {
        \Illuminate\Support\Facades\Event::fake();

        $user = factory(User::class)->create();
        $param = [
            'title'   => 'test1',
            'content' => 'test投稿だよ',
            'user_id' => (int) $user->id,
            'tags'    => ['test', 'Laravel'],
        ];
        $response = $this->json('POST', self::BASE_URL, $param);
        $response->assertStatus(204);

        $this->assertDatabaseHas('reviews',
            [
                'title'   => 'test1',
                'content' => 'test投稿だよ',
                'user_id' => (int) $user->id,
            ]
        );

        $this->assertDatabaseHas('tags',
            [
                'tag_name' => 'test',
            ]
        );

        $this->assertDatabaseHas('tags',
            [
                'tag_name' => 'Laravel',
            ]
        );
    }
}
