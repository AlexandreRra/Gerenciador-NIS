<?php


use \App\Http\Response;
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

// Search route
$obRouter->get('/pesquisar', [
    function () {
        return new Response(200, Pages\Search::getSearch());
    }
]);

// Search by id route
$obRouter->get('/pesquisar/{id}/{acao}', [
    function ($id, $acao) {
        return new Response(200, 'Página '.$id.' - '.$acao);
    }
]);