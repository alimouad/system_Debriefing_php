<?php

namespace Core\Database;

use PDO;
use PDOException;

class Database extends PDO
{
    private static ?Database $instance = null;

    private function __construct() {
        try {
            require __DIR__ . "/../Helpers/env.php"; 
            require __DIR__ . '/../../Config/database.php';

            if (empty($driver) || empty($host) || empty($dbname)) {
                throw new PDOException("Missing environment variables. Check your .env file.");
            }

            // 3. Construct the DSN
            $dsn = match ($driver) {
                'pgsql' => "pgsql:host=$host;port=$port;dbname=$dbname",
                'mysql' => "mysql:host=$host;port=$port;dbname=$dbname",
                default => throw new PDOException("Invalid database driver: $driver"),
            };

            // 4. Call parent PDO constructor
            parent::__construct($dsn, $user, $pass);

            $this->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            $this->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            
        } catch (PDOException $e) {
            // This stops the Fatal Error in Auth.php by terminating here with a clear message
            die("Critical Database Error: " . $e->getMessage());
        }
    }

    public static function getInstance(): self {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }
}