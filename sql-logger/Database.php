<?php

class Database
{

    private static ?Database $instance = null;
    private ?PDO $connection = null;
    private PDOStatement $stmt;
    private array $queries = [];

    private function __construct(array $db_config)
    {
        try {
            $dsn = "mysql:host={$db_config['host']};dbname={$db_config['dbname']};charset={$db_config['charset']}";
            $this->connection = new PDO($dsn, $db_config['username'], $db_config['password'], $db_config['options']);
        } catch (PDOException $e) {
            echo "DB error: " . $e->getMessage();
            die;
        }
    }

    public static function getInstance(array $db_config): Database
    {
        if (self::$instance === null) {
            self::$instance = new self($db_config);
        }
        return self::$instance;
    }

    public function query(string $query, array $params = []): static
    {
        try {
            $this->stmt = $this->connection->prepare($query);
            $this->stmt->execute($params);
            ob_start();
            $this->stmt->debugDumpParams();
            $this->queries[] = ob_get_clean();
        } catch (PDOException $e) {
            echo "DB error: " . $e->getMessage();
        }
        return $this;
    }

    public function getAll(): bool|array
    {
        return $this->stmt->fetchAll();
    }

    public function getOne(): mixed
    {
        return $this->stmt->fetch();
    }

    public function findAll(string $tbl)
    {
        $this->query("SELECT * FROM {$tbl}");
        return $this->getAll();
    }

    public function findOne(string $tbl, $where, string $field = 'id')
    {
        $this->query("SELECT * FROM {$tbl} WHERE {$field} = ?", [$where]);
        return $this->getOne();
    }

    public function getQueries(): array
    {
        $res = [];
        foreach ($this->queries as $k => $query) {
            $line = strtok($query, PHP_EOL);
            while ($line !== false) {
                if (str_contains($line, 'SQL:') || str_contains($line, 'Sent SQL:')) {
                    $res[$k][] = $line;
                }
                $line = strtok(PHP_EOL);
            }
        }
        return $res;
    }

}