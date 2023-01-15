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
    public static function getSearch()
    {
        // Search view
        $content = View::render('pages/nis/search', [
            'cidadao' => self::getNisByNumber()
        ]);

        // Returns Page view
        return parent::getPage('Pesquisa', $content);
    }

    /**
     * Get cidadao from DB
     * @return string
     */
    private static function getNisByNumber() {

        // Search by number
        $cidadao = Nis::get('nis = 1', '','','*');

        $obNis = $cidadao->fetchObject(Nis::class);

        // Render item(cidadao)
        $content = View::render('pages/nis/item', [
            'nome' => $obNis->nome,
            'nis' => $obNis->nis,
            'data_criacao' => date('d/m/Y H:i:s',strtotime($obNis->data_criacao))
        ]);

        return $content;

    }
}
