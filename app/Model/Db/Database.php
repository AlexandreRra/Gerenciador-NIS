<?php

namespace App\Model\Db;

use \PDO;
use \PDOException;


class Database
{

    /**
     * DB host connection
     * @var string
     */
    private static  $host;

    /**
     * Name of DB
     * @var string
     */
    private static  $name;

    /**
     * User of DB
     * @var string
     */
    private static  $user;

    /**
     * Password of DB
     * @var string
     */
    private static  $pass;

    /**
     * Port of DB
     * @var string
     */
    private static  $port;

    /**
     * Name of table to be manipulated
     * @var string
     */
    private $table;

    /**
     * Instance of connection with DB
     * @var PDO
     */
    private $connection;

    public static function config($host, $name, $user, $pass, $port = 3306)
    {
        self::$host = $host;
        self::$name = $name;
        self::$user = $user;
        self::$pass = $pass;
        self::$port = $port;
    }

    /**
     * Define table and instantiates the connection
     * @param string $table
     */
    public function __construct($table = null)
    {
        $this->table = $table;
        $this->setConnection();
    }

    /**
     * Creates the connection with DB
     */
    private function setConnection()
    {
        try {
            $this->connection = new PDO('mysql:host=' . self::$host . ';dbname=' . self::$name . ';port=' . self::$port, self::$user, self::$pass);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die('ERROR: ' . $e->getMessage());
        }
    }

    /**
     * Execute queries inside DB
     * @param string $query
     * @param array $params
     * @return PDOStatement
     */
    public function execute($query, $params = [])
    {
        try {
            $statement = $this->connection->prepare($query);
            $statement->execute($params);
            return $statement;
        } catch (PDOException $e) {
            die('ERROR: ' . $e->getMessage());
        }
    }

    /**
     * Insert data in DB
     * @param array $values [ field => value]
     * @return integer ID inserted
     */
    public function insert($values)
    {
        // Query data
        $fields = array_keys($values);
        $binds = array_pad([], count($fields), '?');

        // Build query
        $query = 'INSERT INTO ' . $this->table . '(' . implode(',', $fields) . ') VALUES (' . implode(',', $binds) . ')';

        // Execute insert
        $this->execute($query, array_values($values));

        //Return inserted ID
        return $this->connection->lastInsertId();
    }

    /**
     * Execute a select in DB
     * @param string $where
     * @param string $order
     * @param string $limit
     * @return PDOStatement
     */
    public function select($where = null, $order = null, $limit = null, $fields = '*')
    {
        // Query data
        $where = strlen($where) ? 'WHERE ' . $where : '';
        $order = strlen($order) ? 'ORDER BY ' . $order : '';
        $limit = strlen($limit) ? 'LIMIT ' . $limit : '';

        // Build query
        $query = 'SELECT ' . $fields . ' FROM ' . self::$name . '.' . $this->table . ' ' . $where . ' ' . $order . ' ' . $limit;

        // Execute insert
        return $this->execute($query);
    }
}
