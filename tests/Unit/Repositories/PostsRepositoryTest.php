<?php
declare(strict_types=1);

namespace Tests\Unit\Repositories;

use App\Models\Comments;
use App\Models\Posts;
use App\Repositories\PostsRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PostsRepositoryTest extends TestCase
{
    use RefreshDatabase;

    /**
     * findPostsAllの正常系.
     * @test
     */
    public function testFindAllData()
    {
        // setup
        $posts = factory(Posts::class)->create()->toArray();
        $comments = factory(Comments::class, 5)->create(
            [
                'posts_id' => $posts['id'],
            ]
        )->toArray();

        $posts['comments'] = $comments;
        $expected = [$posts];

        // exercise
        $repository = resolve(PostsRepository::class);
        $actual = $repository->findPostsAll();

        // verify
        $this->assertSameSize($expected, $actual);
    }
}