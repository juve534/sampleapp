<?php

declare(strict_types=1);

namespace App\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;

class ReviewRegistered
{
    use Dispatchable;
    use InteractsWithSockets;
    use SerializesModels;

    /** @var int */
    private $id;
    /** @var string */
    private $title;
    /** @var string */
    private $content;
    /** @var int */
    private $userId;
    /** @var string */
    private $createdAt;
    /** @var array */
    private $tags;

    /**
     * ReviewRegistered constructor.
     *
     * @param int    $id
     * @param string $title
     * @param string $content
     * @param int    $userId
     * @param string $createdAt
     * @param array  $tags
     */
    public function __construct(
        int $id,
        string $title,
        string $content,
        int $userId,
        string $createdAt,
        array $tags
    ) {
        $this->id = $id;
        $this->title = $title;
        $this->content = $content;
        $this->userId = $userId;
        $this->createdAt = $createdAt;
        $this->tags = $tags;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * @throws \Exception
     *
     * @return string
     */
    public function getCreatedAtEpoch(): string
    {
        $datetime = new \DateTime($this->createdAt);

        return $datetime->format('U');
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return array
     */
    public function getTags(): array
    {
        return $this->tags;
    }

    /**
     * @return int
     */
    public function getUserId(): int
    {
        return $this->userId;
    }
}
