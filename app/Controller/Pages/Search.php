<?php

namespace App\Controller\Pages;

use App\Model\Entity\Nis;
use \App\Utils\View;

class Search extends Page
{
    /**
     * Return the content (view) of search
     * @return string
     */
    public static function getSearch($errorMessage = null)
    {
        $status = !is_null($errorMessage) ? View::render('common/alert', [
            'message' => $errorMessage,
            'status' => 'danger'
        ]) : '';

        // Search view
        $content = View::render('pages/nis/search', [
            'cidadao' => '',
            'status' => $status
        ]);

        // Returns Page view
        return parent::getPage('Pesquisa', $content);
    }

    /**
     * Get cidadao from DB
     * @param Request
     * @return string
     */
    public static function getNisByNumber($request)
    {
        // POST data
        $postVars = $request->getPostVars();
        $nis = $postVars['nis'] ?? '';

        // Search NIS by number
        $obNis = Nis::getNisByNumber($nis);

        if (!$obNis instanceof Nis) {
            return self::getSearch('Não foi encontrado dados para o NIS informado');
        }

        // Render item(cidadao)
        $itemContent = View::render('pages/nis/item', [
            'nome' => $obNis->nome,
            'nis' => $obNis->nis,
            'data_criacao' => date('d/m/Y H:i:s', strtotime($obNis->data_criacao))
        ]);

        // Search view
        $content = View::render('pages/nis/search', [
            'cidadao' => $itemContent,
            'status' => ''
        ]);

        // Returns Page view
        return parent::getPage('Pesquisa', $content);
    }
}
