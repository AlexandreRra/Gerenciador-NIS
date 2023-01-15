<?php

namespace App\Controller\Pages;

use \App\Utils\View;
use \App\Model\Entity\Cadastro;

class Search extends Page
{
    /**
     * Return the content (view) of search
     * @return string
     */
    public static function getSearch()
    {

        $cadastro = new Cadastro;

        // Search view
        $content = View::render('pages/search', [
            'name' => 'NIS',
            'description' => 'Número de Identificação Social',
        ]);

        // Returns Page view
        return parent::getPage('NIS', $content);
    }
}
