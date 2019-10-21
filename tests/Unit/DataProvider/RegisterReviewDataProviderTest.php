<?php

declare(strict_types=1);

namespace Tests\Unit\DataProvider;

use App\DataProvider\RegisterReviewProviderInterface;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RegisterReviewDataProviderTest extends TestCase
{
    use RefreshDatabase;

    /**
     * 口コミ投稿の正常系.
     *
     * @test
     */
    public function testRegisterReviewSuccess()
    {
        $this->markTestIncomplete(
            'このテストはCIで動いていません。'
        );

        // setup
        $user = factory(User::class)->create();
        $param = [
            'title'   => 'test1',
            'content' => 'test投稿だよ',
            'user_id' => (int) $user->id,
            'tags'    => ['test', 'Laravel'],
        ];

        // exercise
        $dataProvider = resolve(RegisterReviewProviderInterface::class);
        $dataProvider->registerReview(
            $param['title'],
            $param['content'],
            $param['user_id'],
            Carbon::now()->toDateTimeString(),
            $param['tags']
        );

        // verify
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
