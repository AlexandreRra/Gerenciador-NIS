<?php


use \App\Http\Response;
use \App\Http\Request;
use \App\Controller\Pages;

// Home route
$obRouter->get('/', [
    function () {
        return new Response(200, Pages\Home::getHome());
    }
]);

// Register route
$obRouter->get('/registrar', [
    function () {
        return new Response(200, Pages\Register::getRegister());
    }
]);

// Register route (INSERT)
$obRouter->post('/registrar', [
    function ($request) {
        return new Response(200, Pages\Register::insertNis($request));
    }
]);

// Search route
$obRouter->get('/pesquisar', [
    function () {
        return new Response(200, Pages\Search::getSearch());
    }
]);

// Search route (SELECT)
$obRouter->post('/pesquisar', [
    function ($request) {
        return new Response(200, Pages\Search::getNisByNumber($request));
    }
]);