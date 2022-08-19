<?php

declare(strict_types=1);

namespace SendStack\Laravel\Http;

use Closure;
use Illuminate\Http\Client\Factory;
use Illuminate\Support\Facades\Http;
use SendStack\Laravel\Concerns\CanAccessProperties;
use SendStack\Laravel\Concerns\CanBuildRequests;
use SendStack\Laravel\Concerns\CanSendRequests;
use SendStack\Laravel\Contracts\ClientContract;
use SendStack\Laravel\Http\Resources\SubscribersResource;
use SendStack\Laravel\Http\Resources\TagResource;

class Client implements ClientContract
{
    use CanAccessProperties;
    use CanBuildRequests;
    use CanSendRequests;

    public function __construct(
        protected readonly string $url,
        protected readonly string $token,
    ) {
    }

    public static function fake(Closure|array $callback): Factory
    {
        return Http::fake(
            callback: $callback,
        );
    }

    public function subscribers(): SubscribersResource
    {
        return new SubscribersResource(
            client: $this,
        );
    }

    public function tags(): TagResource
    {
        return new TagResource(
            client: $this,
        );
    }
}
