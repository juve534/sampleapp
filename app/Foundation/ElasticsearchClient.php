<?php

declare(strict_types=1);

namespace App\Foundation;

use Elasticsearch\Client;
use Elasticsearch\ClientBuilder;

class ElasticsearchClient
{
    protected $hosts = [];

    public function __construct(array $hosts)
    {
        $this->hosts = $hosts;
    }

    public function client(): Client
    {
        return ClientBuilder::create()->setHosts($this->hosts)->build();
    }
}
