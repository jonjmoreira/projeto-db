<?php

declare(strict_types=1);

namespace Database;

use Exception;
use PDO;

class Database extends PDO
{
    public function __construct( $file = __DIR__.'/../config/database.ini')
    {
        if (!$config = parse_ini_file($file, true)) throw new Exception('Não foi possível abrir o arquivo ' . $file . '.');

        $dns = $config['database']['driver'] .
        ':host=' . $config['database']['host'] .
        ';port=' . $config['database']['port'] .
        ';dbname=' . $config['database']['dbname'];

        parent::__construct($dns, $config['database']['user'], $config['database']['password']);
    }
}