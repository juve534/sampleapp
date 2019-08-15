<?php
declare(strict_types=1);

namespace Tests\Unit\Repositories;

use App\Models\Comments;
use App\Models\Posts;
use App\Repositories\PostsRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PostsRepositoryTest extends TestCase
{
    use RefreshDatabase, WithFaker;

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

    /**
     * findByIdAndCommentsの正常系.
     * @test
     */
    public function testfindByIdAndComments()
    {
        // setup
        $expected = factory(Posts::class)->create()->toArray();
        $expected['comments'] = factory(Comments::class, 5)->create(
            [
                'posts_id' => $expected['id'],
            ]
        )->toArray();

        // exercise
        $repository = resolve(PostsRepository::class);
        $actual = $repository->findByIdAndComments($expected['id']);

        // verify
        $this->assertSameSize($expected, $actual);
    }

    /**
     * findByIdAndCommentsの異常系.
     * @test
     */
    public function testfindByIdAndCommentsNotData()
    {
        // setup
        $id = $this->faker->randomNumber(6);

        // verify
        $this->expectException(ModelNotFoundException::class);

        // exercise
        $repository = resolve(PostsRepository::class);
        $actual = $repository->findByIdAndComments($id);
    }
}