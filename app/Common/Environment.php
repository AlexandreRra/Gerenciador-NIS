<?php

namespace App\Common;

class Environment
{

    /**
     * Load environment variables
     * @param string $dir Absolute PATH for .evn file
     */
    public static function load($dir)
    {
        // Checks if .env exists
        if (!file_exists($dir . '/.env')) {
            return false;
        }

        // Set environment variables
        $lines = file($dir . '/.env');
        foreach ($lines as $line) {
            putenv(trim($line));
        }
    }
}
