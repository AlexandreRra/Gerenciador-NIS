<?php

namespace App\Utils;

class View
{
    /**
     * Default variables of View
     * @var array
     */
    private static $vars = [];

    /**
     * Set the initial data of the class
     * @param array $vars
     */
    public static function init($vars = [])
    {
        self::$vars = $vars;
    }

    /**
     * Return the content of a view
     * @param string $view
     * @return string
     */
    private static function getContentView($view)
    {
        $file =  __DIR__ . '/../../resources/view/' . $view . '.html';
        return file_exists($file) ? file_get_contents($file) : '';
    }

    /**
     * Render the content of a view
     * @param string $view
     * @param array $vars (string/numeric)
     * @return string
     */
    public static function render($view, $vars = [])
    {
        // View content
        $contentView = self::getContentView($view);

        // Merge of variables of View
        $vars = array_merge(self::$vars,$vars);

        // keys of vars
        $keys = array_keys($vars);
        $keys = array_map(function ($item) {
            return '{{' . $item . '}}';
        }, $keys);

        // Returns rendered content
        return str_replace($keys, array_values($vars), $contentView);
    }
}
