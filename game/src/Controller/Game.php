<?php

declare(strict_types=1);

namespace Pene14\Controller;

use Nyholm\Psr7\Factory\Psr17Factory;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use \Pene14\Dice\Game21;

use function Mos\Functions\destroySession;
use function Mos\Functions\renderTwigView;
use function Mos\Functions\url;

/**
 * Controller for the index route.
 */
class Game
{
    public function __invoke(): ResponseInterface
    {
        $psr17Factory = new Psr17Factory();

        if (!isset($_SESSION["game21"])) {
            $_SESSION['game21'] = new Game21();
        }
        $data = $_SESSION['game21']->playGame21();

        $body = renderTwigView("game21.html", $data);

        return $psr17Factory
            ->createResponse(200)
            ->withBody($psr17Factory->createStream($body));
    }

    public function chooseNumberDice() : ResponseInterface
    {
        $psr17Factory = new Psr17Factory();

        $_SESSION['game21']->setNumberDice((int)$_POST['amountDice']);

        return $psr17Factory
            ->createResponse(301)
            ->withHeader("Location", url("/game21"));
    }

    public function destroyGame(): ResponseInterface
    {
        destroySession();

        return (new Response())
            ->withStatus(301)
            ->withHeader("Location", url("/game21"));
    }

    public function stopPlaying(): ResponseInterface
    {
        $psr17Factory = new Psr17Factory();

        $_SESSION['game21']->stopPlaying();

        return $psr17Factory
            ->createResponse(301)
            ->withHeader("Location", url("/game21"));
    }

    public function resetAndPlayAgain(): ResponseInterface
    {
        $psr17Factory = new Psr17Factory();

        $_SESSION['game21']->resetAndPlayAgain();

        return $psr17Factory
            ->createResponse(301)
            ->withHeader("Location", url("/game21"));

    }
}
