<?php

namespace App\Controller\Pages;

use \App\Utils\View;
use \App\Model\Entity\Cadastro;

class Home extends Page
{
    /**
     * Return the content (view) of home
     * @return string
     */
    public static function getHome()
    {

        $cadastro = new Cadastro;

        // Home view
        $content = View::render('pages/home', [
            'name' => 'NIS',
            'description' => 'Número de Identificação Social',
        ]);

        // Returns Page view
        return parent::getPage('NIS', $content);
    }
}
