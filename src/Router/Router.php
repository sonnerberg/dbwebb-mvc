<?php

declare(strict_types=1);
namespace Mos\Router;

use function Mos\Functions\{
    destroySession,
    redirectTo,
    renderView,
    renderTwigView,
    sendResponse,
    url
};

//use \Pene14\Dice\Dice;
//use \Pene14\Dice\GraphicalDice;
//use \Pene14\Dice\DiceHand;
use \Pene14\Dice\Game;
use \Pene14\Dice\Game21;

/**
 * Class Router.
 */
class Router
{
    public static function dispatch(string $method, string $path): void
    {
        if ($method === "GET" && $path === "/") {
            $data = [
                "header" => "Index page",
                "message" => "Hello, this is the index page, rendered as a layout.",
            ];
            $body = renderView("layout/page.php", $data);
            sendResponse($body);
            return;
        } else if ($method === "GET" && $path === "/session") {
            $body = renderView("layout/session.php");
            sendResponse($body);
            return;
        } else if ($method === "GET" && $path === "/session/destroy") {
            destroySession();
            redirectTo(url("/session"));
            return;
        } else if ($method === "GET" && $path === "/debug") {
            $body = renderView("layout/debug.php");
            sendResponse($body);
            return;
        } else if ($method === "GET" && $path === "/twig") {
            $data = [
                "header" => "Twig page",
                "message" => "Hey, edit this to do it youreself!",
            ];
            $body = renderTwigView("index.html", $data);
            sendResponse($body);
            return;
        } else if ($method === "GET" && $path === "/some/where") {
            $data = [
                "header" => "Rainbow page",
                "message" => "Hey, edit this to do it youreself!",
            ];
            $body = renderView("layout/page.php", $data);
            sendResponse($body);
            return;
        } else if ($method === "GET" && $path === "/form/view") {
            $data = [
                "header" => "Form",
                "message" => "Press submit to send the message to the result page.",
                "action" => url("/form/process"),
                "output" => $_SESSION["output"] ?? null,
            ];
            $body = renderView("layout/form.php", $data);
            sendResponse($body);
            return;
        } else if ($method === "POST" && $path === "/form/process") {
            $_SESSION["output"] = $_POST["content"] ?? null;
            redirectTo(url("/form/view"));
            return;
        } else if ($method === "GET" && $path === "/dice") {
            $callable = new Game();
            $callable->playGame();
            return;
        } else if ($method === "GET" && $path === "/game21") {
            // If no game has started, initialize a new Game21
            if (!isset($_SESSION["game21"])) {
                $_SESSION['game21'] = new Game21();
            }
            $_SESSION['game21']->playGame21();
            return;
            // TODO: resetAndPlayAgain
        } else if ($method === "GET" && $path === "/game21/resetAndPlayAgain") {
            $_SESSION['game21']->resetAndPlayAgain();
            redirectTo(url("/game21"));
            return;
        } else if ($method === "GET" && $path === "/game21/stopPlaying") {
            $_SESSION['game21']->stopPlaying();
            redirectTo(url("/game21"));
            return;
        } else if ($method === "POST" && $path === "/game21/chooseNumberDice") {
            $_SESSION['game21']->setNumberDice((int)$_POST['amountDice']);
            redirectTo(url("/game21"));
            return;
        } else if ($method === "GET" && $path === "/game21/destroyGame") {
            destroySession();
            redirectTo(url("/game21"));
            return;
        }


        $data = [
            "header" => "404",
            "message" => "The page you are requesting is not here. You may also checkout the HTTP response code, it should be 404.",
        ];
        $body = renderView("layout/page.php", $data);
        sendResponse($body, 404);
    }
}
