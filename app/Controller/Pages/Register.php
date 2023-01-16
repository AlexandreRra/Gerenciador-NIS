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
    public static function getRegister($statusMessage = null)
    {

        $status = !is_null($statusMessage) ? View::render('common/alert', [
            'message' => $statusMessage,
            'status' => 'success'
        ]) : '';

        // Register view
        $content = View::render('pages/nis/register', [
            'status' => $status
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
        $newNis = $obNis->insert();

        $returnNis = $obNis->formatNis($newNis);

        return self::getRegister('NIS Cadastrado com sucesso -- Número: '.$returnNis);
    }
}
