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
            throw new \PDOException($e->getMessage());
        }
    }

    /**
     * Method to check if DB connection is open.
     */
    public function isConnected(): bool
    {
        return $this->db !== null;
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
     */
    public function execute(string $query, object|array $data = []): bool
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
     * @param string|null $method all (fetchAll) or null (fetch)
     */
    public function fetchData(?string $method = null): ?array
    {
        if ($this->db === null) {
            return null;
        }

        try {
            if ($method === 'all') {
                $data = $this->lastRequest->fetchAll(\PDO::FETCH_ASSOC);

                if (!$data) {
                    return null;
                }

                return $data;
            }

            $data = $this->lastRequest->fetch(\PDO::FETCH_ASSOC);

            if (!$data) {
                return null;
            }

            return $data;
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
