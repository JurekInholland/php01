<?php

class QueryBuilder {

    protected $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
        $this->pdo->exec("SET time_zone='+01:00';");
    }

    // Query SQL using prepared statements
    // https://www.php.net/manual/en/pdo.prepared-statements.php
    public function query($sql, $parameters=[]) {

        if (substr( $sql, 0, 6 ) === "SELECT") {
            return $this->fetch($sql, $parameters);

        } else {
            $this->execute($sql, $parameters);
        }
    }

    private function fetch(string $sql, array $parameters=[]) {
        try {
            $statement = $this->execute($sql, $parameters);
            return $statement->fetchAll(PDO::FETCH_ASSOC);

        } catch (PDOException $e){
            die("Something went wrong during fetchAll: ". $e);
        }        
    }

    private function execute(string $sql, array $parameters) {
        try {
            $statement = $this->pdo->prepare($sql);
            $statement->execute($parameters);
            return $statement;

        // Catch any exceptions
        } catch (Exception $e) {
            die("Something went wrong during pdo execute: ". $e);
        }
    }
}