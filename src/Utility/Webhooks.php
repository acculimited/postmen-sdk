<?php

namespace Accu\Postmen\Utility;

use Accu\Postmen\Events\EventFactory;
use GuzzleHttp\Psr7\Response;
use Psr\EventDispatcher\EventDispatcherInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class Webhooks
{
    /** @var EventDispatcherInterface */
    private $eventDispatcher;

    public function __construct(EventDispatcherInterface $eventDispatcher)
    {
        $this->eventDispatcher = $eventDispatcher;
    }

    public function __invoke(RequestInterface $request): ResponseInterface
    {
        $json = \GuzzleHttp\Utils::jsonDecode(
            (string) $request->getBody(),
            true
        );

        $event = EventFactory::fromWebhook($json);

        if ($this->eventDispatcher) {
            $this->eventDispatcher->dispatch($event);
        }

        return new Response();
    }
}
