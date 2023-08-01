<?php

namespace app\core;

use PDO;


/**
 * Class Database
 * @author Ban Alexandru <alexbanut10@gmail.com>
 * @package app\core
 **/
class Database
{
    public PDO $pdo;

    public function __construct(array $config)
    {
        $dns = $config['dns'] ?? '';
        $user = $config['user'] ?? '';
        $password = $config['password'] ?? '';
        // connecti to the database by passing certain arguments
        $this->pdo = new PDO($dns, $user, $password);

        // make PDO to throw an exception if it doesn't connect to DB
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function applyMigrations()
    {
        $this->createMigratioinsTable();
        $appliedMigrations = $this->getAppliedMigraions();

        $newMigrations = [];

        $files = scandir(Application::$ROOT_DIR . '/migrations');
        // print_r($files);
        $toApplyMigrations = array_diff($files, $appliedMigrations);
        foreach ($toApplyMigrations as $migration) {
            if ($migration === '.' || $migration === '..') {
                continue;
            }

            require_once Application::$ROOT_DIR . '/migrations/' . $migration;
            $className = pathinfo($migration, PATHINFO_FILENAME);
            $instance = new $className();

            $this->log("Applying migration $migration"); 
            $instance->up();
            $this->log("Applied migration $migration"); 

            $newMigrations[] = $migration;
        }

        if (!empty($newMigrations)) {
            $this->saveMigrations($newMigrations);
        } else {
            $this->log("All migrations are applied"); 
        }
    }

    public function createMigratioinsTable()
    {
        $this->pdo->exec("CREATE TABLE IF NOT EXISTS migrations (
            id INT AUTO_INCREMENT PRIMARY KEY,
            migration VARCHAR(255),
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
       ) ENGINE=INNODB;");
    }

    public function getAppliedMigraions()
    {
        $statement = $this->pdo->prepare("SELECT migration FROM migrations;");
        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_COLUMN);
    }

    public function saveMigrations(array $migrations)
    {
        $str = implode(",", array_map(fn($m) => "('$m')", $migrations));
        $statement = $this->pdo->prepare("INSERT INTO migrations (migration) VALUE
            $str
        ;");

        $statement->execute();
    }

    public function log($message)
    {
        echo '[' . date('Y-m-d H:i:s') . '] - ' . $message . PHP_EOL;
    }
}
