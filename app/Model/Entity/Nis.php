<?php

namespace App\Model\Entity;

use \App\Model\Db\Database;
use JetBrains\PhpStorm\Internal\ReturnTypeContract;

class Nis
{
    /**
     * NIS number
     * @var integer
     */
    public $nis;

    /**
     * Name of NIS owner
     * @var string
     */
    public $nome;

    /**
     * NIS number creation date
     * @var string
     */
    public $data_criacao;

    /**
     * Insert a new NIS Entity in DB
     * @return integer
     */
    public function insert()
    {
        // Set dateTime
        $this->data_criacao = date('Y-m-d H:i:s');

        // Insert a new NIS in DB
        $this->nis = (new Database('nis'))->insert([
            'nome' => $this->nome,
            'data_criacao' => $this->data_criacao
        ]);

        // Success
        return $this->nis;;

    }

    /**
     * Returns NIS from DB
     * @param string $where
     * @param string $order
     * @param string $limit
     * @param string $fields
     * @return PDOStatement
     */
    public static function get($where = null, $order = null, $limit = null, $fields = '*') {
        return (new Database('nis'))->select($where,$order,$limit,$fields);
    }

    /**
     * Returns NIS by number from DB
     * @param integer $nis
     * @return Nis
     */
    public static function getNisByNumber($nis) {

        return (new Database('nis'))->select('nis = '.$nis, '', '', '*')->fetchObject(self::class);

    }
}
