<?php
/*

This class is responsible for connecting to the database (PDO) and running queries, 
it could use an ORM or a Database Abstraction Layer.
*/




class Database
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = new PDO('mysql:host=localhost;dbname=mydb', 'root', 'password');
    }

    public function selectAll($table)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM {$table}");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_CLASS);
    }

    public function insert($table, $data)
    {
        $keys = array_keys($data);
        $values = implode(', ', array_map(function ($value) {
            return ":{$value}";
        }, $keys));
        $keys = implode(', ', $keys);

        $stmt = $this->pdo->prepare("INSERT INTO {$table} ({$keys}) VALUES ({$values})");
        $stmt->execute($data);
    }
    public function db_connect()
    {

        try {
            $hostname = "localhost";
            $port = "3306"; // host mysql
            $database = "minima_db";
            $username = "duy";
            $password = "1119";
            //hpdup= hạnh phúc dù uống phân
            $pdo = new PDO("mysql:host=$hostname;port=$port;dbname=$database", $username, $password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $pdo;
        } catch (PDOException $e) {

            die($e->getMessage());
        }
    }

    public function read($query, $data = [])
    {

        $DB = $this->db_connect();
        $stm = $DB->prepare($query);

        if (count($data) == 0) {
            $stm = $DB->query($query);
            $check = 0;
            if ($stm) {
                $check = 1;
            }
        } else {

            $check = $stm->execute($data);
        }

        if ($check) {
            $data = $stm->fetchAll(PDO::FETCH_OBJ);
            if (is_array($data) && count($data) > 0) {
                return $data;
            }

            return false;
        } else {
            return false;
        }
    }

    public function write($query, $data = [])
    {

        $DB = $this->db_connect();
        $stm = $DB->prepare($query);

        if (count($data) == 0) {
            $stm = $DB->query($query);
            $check = 0;
            if ($stm) {
                $check = 1;
            }
        } else {

            $check = $stm->execute($data);
        }

        if ($check) {
            return true;
        } else {
            return false;
        }
    }
}
