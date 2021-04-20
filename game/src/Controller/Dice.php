<?php

declare(strict_types=1);

namespace Pene14\Controller;

use Nyholm\Psr7\Factory\Psr17Factory;
use Psr\Http\Message\ResponseInterface;
use \Pene14\Dice\Game;

use function Mos\Functions\renderTwigView;

/**
 * Controller for the index route.
 */
class Dice
{
    public function __invoke(): ResponseInterface
    {
        $psr17Factory = new Psr17Factory();

        $callable = new Game();
        $data = $callable->playGame();

        $body = renderTwigView("dice.html", $data);

        return $psr17Factory
            ->createResponse(200)
            ->withBody($psr17Factory->createStream($body));
    }
}
