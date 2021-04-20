<?php

/**
 * Load the routes into the router, this file is included from
 * `htdocs/index.php` during the bootstrapping to prepare for the request to
 * be handled.
 */

declare(strict_types=1);

use FastRoute\RouteCollector;

$router = $router ?? null;

$router->addRoute("GET", "/test", function () {
    // A quick and dirty way to test the router or the request.
    return "Testing response";
});

$router->addRoute("GET", "/", "\Mos\Controller\Index");
$router->addRoute("GET", "/debug", "\Mos\Controller\Debug");
$router->addRoute("GET", "/twig", "\Mos\Controller\TwigView");

$router->addGroup("/session", function (RouteCollector $router) {
    $router->addRoute("GET", "", ["\Mos\Controller\Session", "index"]);
    $router->addRoute("GET", "/destroy", ["\Mos\Controller\Session", "destroy"]);
});

$router->addGroup("/some", function (RouteCollector $router) {
    $router->addRoute("GET", "/where", ["\Mos\Controller\Sample", "where"]);
});

$router->addGroup("/form", function (RouteCollector $router) {
    $router->addRoute("GET", "/view", ["\Mos\Controller\Form", "view"]);
    $router->addRoute("POST", "/process", ["\Mos\Controller\Form", "process"]);
});

$router->addRoute("GET", "/dice", "\Pene14\Controller\Dice");

$router->addGroup("/game21", function (RouteCollector $router) {
    $router->addRoute("GET", "", "\Pene14\Controller\Game");
    $router->addRoute("POST", "/chooseNumberDice", ["\Pene14\Controller\Game", "chooseNumberDice"]);
    $router->addRoute("GET", "/destroyGame", ["\Pene14\Controller\Game", "destroyGame"]);
    $router->addRoute("GET", "/stopPlaying", ["\Pene14\Controller\Game", "stopPlaying"]);
    $router->addRoute("GET", "/resetAndPlayAgain", ["\Pene14\Controller\Game", "resetAndPlayAgain"]);
});

