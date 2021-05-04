<?php

declare(strict_types=1);

namespace Pene14\Controller;

use Nyholm\Psr7\Factory\Psr17Factory;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use \Pene14\Yatzy\Yatzy;

use function Mos\Functions\destroySession;
use function Mos\Functions\renderTwigView;
use function Mos\Functions\url;

/**
 * Controller for the index route.
 */
class YatzyGame
{
    public function __invoke(): ResponseInterface
    {
        $psr17Factory = new Psr17Factory();

        // TODO: Use private variable instead of session?
        if (!isset($_SESSION["yatzy"])) {
            $_SESSION["yatzy"] = new Yatzy();
        }
        $data = $_SESSION["yatzy"]->playYatzy();

        $body = renderTwigView("yatzy.html", $data);

        return $psr17Factory
            ->createResponse(200)
            ->withBody($psr17Factory->createStream($body));
    }

    public function saveDice() : ResponseInterface
    {
        $psr17Factory = new Psr17Factory();

        $_SESSION['yatzy']->saveDice((int)$_POST['diceIndex']);

        return $psr17Factory
            ->createResponse(301)
            ->withHeader("Location", url("/yatzy"));
    }

    public function rollAgain() : ResponseInterface
    {
        $psr17Factory = new Psr17Factory();

        $_SESSION['yatzy']->rollDie();

        return $psr17Factory
            ->createResponse(301)
            ->withHeader("Location", url("/yatzy"));
    }

    public function destroyGame(): ResponseInterface
    {
        destroySession();

        return (new Response())
            ->withStatus(301)
            ->withHeader("Location", url("/yatzy"));
    }

    public function saveOnes(): ResponseInterface
    {
        $_SESSION['yatzy']->saveOnes();

        return (new Response())
            ->withStatus(301)
            ->withHeader("Location", url("/yatzy"));
    }

    public function saveTwos(): ResponseInterface
    {
        $_SESSION['yatzy']->saveTwos();

        return (new Response())
            ->withStatus(301)
            ->withHeader("Location", url("/yatzy"));
    }

    public function saveThrees(): ResponseInterface
    {
        $_SESSION['yatzy']->saveThrees();

        return (new Response())
            ->withStatus(301)
            ->withHeader("Location", url("/yatzy"));
    }

    public function saveFours(): ResponseInterface
    {
        $_SESSION['yatzy']->saveFours();

        return (new Response())
            ->withStatus(301)
            ->withHeader("Location", url("/yatzy"));
    }

    public function saveFives(): ResponseInterface
    {
        $_SESSION['yatzy']->saveFives();

        return (new Response())
            ->withStatus(301)
            ->withHeader("Location", url("/yatzy"));
    }

    public function saveSixes(): ResponseInterface
    {
        $_SESSION['yatzy']->saveSixes();

        return (new Response())
            ->withStatus(301)
            ->withHeader("Location", url("/yatzy"));
    }

//    public function stopPlaying(): ResponseInterface
//    {
//        $psr17Factory = new Psr17Factory();
//
//        $_SESSION['game21']->stopPlaying();
//
//        return $psr17Factory
//            ->createResponse(301)
//            ->withHeader("Location", url("/game21"));
//    }
//
//    public function resetAndPlayAgain(): ResponseInterface
//    {
//        $psr17Factory = new Psr17Factory();
//
//        $_SESSION['game21']->resetAndPlayAgain();
//
//        return $psr17Factory
//            ->createResponse(301)
//            ->withHeader("Location", url("/game21"));
//
//    }
}
