<?php

declare(strict_types=1);

namespace Tests\Unit\Models;

use App\Constants\Cache;
use App\Models\Comments;
use App\Models\Posts;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PostsTest extends TestCase
{
    use RefreshDatabase;

    /**
     * キャッシュに登録されているか.
     *
     * @test
     */
    public function testCachedComment()
    {
        // setup
        $posts = factory(Posts::class)->create();
        $comment = factory(Comments::class, 5)->create(
            [
                'posts_id' => $posts->id,
            ]
        );

        // exercise
        $key = Cache::getCommentsCache(
            $posts->getTable(),
            $posts->getKey(),
            $posts->updated_at->timestamp
        );

        // verify
        $this->assertSameSize($comment->toArray(), $posts->cachedComments);
        $this->assertTrue(\Cache::has($key));
    }

    /**
     * キャッシュが更新されているか.
     *
     * @test
     */
    public function testCachedCommentUpdate()
    {
        // setup
        $posts = factory(Posts::class)->create();
        $comment = factory(Comments::class, 5)->create(
            [
                'posts_id' => $posts->id,
            ]
        )->toArray();

        // exercise
        $key = Cache::getCommentsCache(
            $posts->getTable(),
            $posts->getKey(),
            $posts->updated_at->timestamp
        );

        $this->assertSameSize($comment, $posts->cachedComments);
        $this->assertTrue(\Cache::has($key));

        // setup
        $comment[] = factory(Comments::class)->create(
            [
                'posts_id' => $posts->id,
            ]
        )->toArray();

        // exercise
        $posts2 = Posts::find($posts->id);

        // verify
        $this->assertSameSize($comment, $posts2->cachedComments);
        $key = Cache::getCommentsCache(
            $posts2->getTable(),
            $posts2->getKey(),
            $posts2->updated_at->timestamp
        );
        $this->assertTrue(\Cache::has($key));
    }
}
