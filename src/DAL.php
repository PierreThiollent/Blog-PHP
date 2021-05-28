<?php

namespace App;

class DAL
{
    /**
     * DB connection.
     */
    private ?\PDO $db = null;

    /**
     * Last DB request.
     */
    private ?\PDOStatement $lastRequest = null;

    /**
     * Constructor
     * Open connection with DB.
     */
    public function __construct()
    {
        try {
            $this->db = new \PDO('mysql:host=' . $_ENV['DB_HOST'] . ';port=' . $_ENV['DB_PORT'] . ';dbname=' . $_ENV['DB_NAME'] . ';charset=' . $_ENV['DB_CHARSET'] . ';', $_ENV['DB_USERNAME'], $_ENV['DB_PASSWORD']);
            $this->db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        } catch (\PDOException $e) {
            echo 'Erreur ! : ' . $e->getMessage();
        }

        return $this->isConnected();
    }

    /**
     * Method to check if DB connection is open.
     */
    public function isConnected(): bool
    {
        return null !== $this->db;
    }

    /**
     * Method to delete connection with DB.
     */
    public function disconnect(): bool
    {
        $this->db = null;

        return true;
    }

    /**
     * Method to execute an SQL query.
     *
     * @param  string       $query
     * @param  array|object $data
     * @return bool
     */
    public function execute(string $query, $data = []): bool
    {
        try {
            $request = $this->db->prepare($query);
            foreach ($data as $key => $value) {
                $request->bindValue(':' . $key, $value);
            }

            $this->lastRequest = $request;

            return $request->execute();
        } catch (\PDOException $e) {
            echo $e->getMessage();

            return false;
        }
    }

    /**
     * Method to get SQL result.
     *
     * @param  string|null $method all (fetchAll) or null (fetch)
     * @return array|null
     */
    public function fetchData(?string $method = null): ?array
    {
        if ($this->db === null) {
            return null;
        }

        try {
            if ($method === 'all') {
                return $this->lastRequest->fetchAll(\PDO::FETCH_ASSOC);
            }

            return $this->lastRequest->fetch(\PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            echo $e->getMessage();

            return null;
        }
    }

    /**
     * Method to get the ID of the last inserted row.
     *
     * @return string|bool
     */
    public function lastInsertId()
    {
        try {
            return $this->db->lastInsertId();
        } catch (\PDOException $exception) {
            echo $exception->getMessage();

            return false;
        }
    }
}
