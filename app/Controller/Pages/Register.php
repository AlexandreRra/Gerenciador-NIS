<?php

namespace App\Controller\Pages;

use \App\Utils\View;
use \App\Model\Entity\Cadastro;

class Register extends Page
{
    /**
     * Return the content (view) of register
     * @return string
     */
    public static function getRegister()
    {
        $cadastro = new Cadastro;

        // Register view
        $content = View::render('pages/register', [
            'name' => 'NIS',
            'description' => 'Número de Identificação Social',
        ]);

        // Returns Page view
        return parent::getPage('NIS', $content);
    }
}
