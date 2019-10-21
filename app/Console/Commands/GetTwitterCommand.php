<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Foundation\SendSlackInterface as SendSlack;
use App\Foundation\TwitterClientInterface as TwitterClient;
use Illuminate\Console\Command;

class GetTwitterCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:twitter';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get tweets and notify Slack';

    /**
     * @var TwitterClient
     */
    private $twitterClient;

    /**
     * @var SendSlack
     */
    private $sendSlack;

    /**
     * GetTwitterCommand constructor.
     *
     * @param TwitterClient $twitterClient
     *
     * @return void
     */
    public function __construct(TwitterClient $twitterClient, SendSlack $sendSlack)
    {
        parent::__construct();
        $this->twitterClient = $twitterClient;
        $this->sendSlack = $sendSlack;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        // ツイッターからデータを取得.
        $tweets = $this->twitterClient->get(env('TWITTER_SEARCH_IMG'), 1);
        if (!$tweets || count($tweets) === 0) {
            echo 'No Tweet' . PHP_EOL;

            return false;
        }

        // ツイートをSlackに送信する.
        $tweets = collect($tweets);
        $tweets->map(function ($item) {
            [$text, $tag, $url] = explode(' ', $item->text);

            foreach ($item->extended_entities->media as $media) {
                if (!property_exists($media, 'media_url_https')) {
                    continue;
                }
                if (empty($media->media_url_https)) {
                    continue;
                }
            }

            $imgUrl = $media->media_url_https;

            $this->sendSlack->sendImg($text . ' ' . $tag, $imgUrl);
        });
    }
}
