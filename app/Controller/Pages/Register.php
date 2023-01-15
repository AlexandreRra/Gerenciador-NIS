<?php

namespace App\Controller\Pages;

use App\Model\Entity\Nis;
use \App\Utils\View;

class Register extends Page
{
    /**
     * Return the content (view) of register
     * @return string
     */
    public static function getRegister()
    {
        // Register view
        $content = View::render('pages/nis/register', [
        ]);

        // Returns Page view
        return parent::getPage('Cadastro', $content);
    }

    /**
     * Insert a new Nis number
     * @param Request $request
     * @return string
     */
    public static function insertNis($request)
    {
       // POST data
       $postVars = $request->getpostVars();

       // New NIS instancy
       $obNis = new Nis;
       $obNis->nome = $postVars['nome'];
       $obNis->insert();

       return self::getRegister();
    }
}
