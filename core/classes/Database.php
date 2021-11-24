<?php

namespace core\classes;

use PDO;
use Exception;
use PDOException;

class Database{

    // Database management
    private $connection;

    // ============================================================
    private function connect(){

        // Connection to the Database
        $this->connection = new PDO(
            'mysql:' .
                'host=' . MYSQL_SERVER . ';' .
                'dbname=' . MYSQL_DATABASE . ';' .
                'charset=' . MYSQL_CHARSET,
            MYSQL_USER,
            MYSQL_PASS,
            array(PDO::ATTR_PERSISTENT => true)
        );

        // Debug
        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
    }

    // ============================================================
    private function disconnect(){

        // Disconnects from the Database
        $this->connection = null;
    }

    // ============================================================
    // CRUD - CREATE/READ/UPDATE/DELETE
    // ============================================================
    public function select($sql, $params = null){

        // Checks if its a SELECT instruction
        if (!preg_match("/^SELECT/i", $sql)) {
            throw new Exception('Database - Not a SELECT instruction');
        }

        // Connects to the Database
        $this->connect();

        $results = null;

        try {

            // Database communication
            if (!empty($params)) {
                $executing = $this->connection->prepare($sql);
                $executing->execute($params);
                $results = $executing->fetchAll(PDO::FETCH_CLASS);
            } else {
                $executing = $this->connection->prepare($sql);
                $executing->execute();
                $results = $executing->fetchAll(PDO::FETCH_CLASS);
            }
        } catch (PDOException $e) {
            // Case exists an error
            return false;
        }

        // Disconnects from Database
        $this->disconnect();

        // Return results from SQL query
        return $results;
    }

    // ============================================================
    public function insert($sql, $params = null){

        // Checks if its a INSERT instruction
        if (!preg_match("/^INSERT/i", $sql)) {
            throw new Exception('Database - Not a INSERT instruction');
        }

        // Connects to the Database
        $this->connect();

        try {

            // Database communication
            if (!empty($params)) {
                $executing = $this->connection->prepare($sql);
                $executing->execute($params);
            } else {
                $executing = $this->connection->prepare($sql);
                $executing->execute();
            }
        } catch (PDOException $e) {
            // Case exists an error
            return false;
        }

        // Disconnects from Database
        $this->disconnect();
    }

    // ============================================================
    public function update($sql, $params = null){

        // Checks if its a UPDATE instruction
        if (!preg_match("/^UPDATE/i", $sql)) {
            throw new Exception('Database - Not a UPDATE instruction');
        }

        // Connects to the Database
        $this->connect();

        try {

            // Database communication
            if (!empty($params)) {
                $executing = $this->connection->prepare($sql);
                $executing->execute($params);
            } else {
                $executing = $this->connection->prepare($sql);
                $executing->execute();
            }
        } catch (PDOException $e) {
            // Case exists an error
            return false;
        }

        // Disconnects from Database
        $this->disconnect();
    }

    // ============================================================
    public function delete($sql, $params = null){

        // Checks if its a DELETE instruction
        if (!preg_match("/^DELETE/i", $sql)) {
            throw new Exception('Database - Not a DELETE instruction');
        }

        // Connects to the Database
        $this->connect();

        try {

            // Database communication
            if (!empty($params)) {
                $executing = $this->connection->prepare($sql);
                $executing->execute($params);
            } else {
                $executing = $this->connection->prepare($sql);
                $executing->execute();
            }
        } catch (PDOException $e) {
            // Case exists an error
            return false;
        }

        // Disconnects from Database
        $this->disconnect();
    }

    // ============================================================
    // SQL GENERICO
    // ============================================================
    public function statement($sql, $params = null){

        // Checks if its a instruction diferent from the above
        if (preg_match("/^(SELECT|INSERT|UPDATE|DELETE)/i", $sql)) {
            throw new Exception('Database - Invalid instruction');
        }

        // Connects to the Database
        $this->connect();

        try {

            // Database communication
            if (!empty($params)) {
                $executing = $this->connection->prepare($sql);
                $executing->execute($params);
            } else {
                $executing = $this->connection->prepare($sql);
                $executing->execute();
            }
        } catch (PDOException $e) {
            // Case exists an error
            return false;
        }

        // Disconnects from Database
        $this->disconnect();
    }
}
