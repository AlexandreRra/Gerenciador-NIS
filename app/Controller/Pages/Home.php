<?php

namespace App\Controller\Pages;

use \App\Utils\View;

class Home extends Page
{
    /**
     * Return the content (view) of home
     * @return string
     */
    public static function getHome()
    {

        // Home view
        $content = View::render('pages/home', [
            'name' => 'NIS',
            'description' => 'Número de Identificação Social',
        ]);

        // Returns Page view
        return parent::getPage('NIS', $content);
    }
}
