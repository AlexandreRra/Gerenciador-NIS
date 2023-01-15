<?php

namespace App\Controller\Pages;

use \App\Utils\View;

class Page
{
    /**
     * Render header
     * @return string
     */
    private static function getHeader()
    {
        return View::render('pages/header');
    }

    /**
     * Render footer
     * @return string
     */
    private static function getFooter()
    {
        return View::render('pages/footer');
    }

    /**
     * Return the content (view) of default page
     * @return string
     */
    public static function getPage($title, $content)
    {
        return View::render('pages/page', [
            'header' => self::getHeader(),
            'title' => $title,
            'content' => $content,
            'footer' => self::getFooter()
        ]);
    }
}
