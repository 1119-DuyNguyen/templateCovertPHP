<?php
/*
This class is responsible for connecting to the database (PDO) and running queries, 
it could use an ORM or a Database Abstraction Layer.
*/
# private factory pattern

class Database
{

    private $pdo;

    private function __construct($pdo)
    {
        $this->pdo = $pdo;

        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    public static function create($driver, $host = "localhost", $dbname = "minima_db", $username = "duy", $password = "1119")
    {
        // $hostname = "localhost";
        // $port = "3306"; // host mysql
        // $dbname = "minima_db";
        // $username = "duy";
        // $password = "1119";
        try {
            switch ($driver) {
                case 'mysql':
                    $pdo = new PDO("mysql:host={$host};dbname={$dbname}", $username, $password);
                    break;
                case 'pgsql':
                    $pdo = new PDO("pgsql:host={$host};dbname={$dbname}", $username, $password);
                    break;
                case 'sqlsrv':
                    $pdo = new PDO("sqlsrv:Server={$host};Database={$dbname}", $username, $password);
                    break;
                default:
                    throw new Exception("Invalid driver");

            }
        } catch (Exception $e) {
            echo ("Connection error, please try again in a few minutes or contact support");
            error_log("errorConnect.php, PDO error=" . $e->getMessage());
            die();
        }

        return new Database($pdo);
    }

    public function insert($table, $data)
    {
        $columns = implode(", ", array_keys($data));
        $values = ":" . implode(", :", array_keys($data));

        $stmt = $this->pdo->prepare("INSERT INTO {$table} ({$columns}) VALUES ({$values})");
        echo "INSERT INTO {$table} ({$columns}) VALUES ({$values})";
        foreach ($data as $key => $value) {
            $stmt->bindValue(":{$key}", $value);
        }

        return $stmt->execute();
    }
    public function selectAll($table)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM {$table}");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_CLASS);
    }



    /**
     * read data return array if success otherwise null
     *@* @param string $query : sql statement
     *@* @param array data : binding elements 
     *@return array|null
     */
    public function read($query, $data = [])
    {

        $PDO = $this->pdo;
        $stm = $PDO->prepare($query);
        $isGetData = 0;
        if (count($data) == 0) {
            $stm = $PDO->query($query);
            if ($stm) {
                $isGetData = 1;
            }
        } else {

            $isGetData = $stm->execute($data);
        }

        if ($isGetData) {
            $data = $stm->fetchAll(PDO::FETCH_OBJ);
            if (is_array($data) && count($data) > 0) {
                return $data;
            }

            return null;
        } else {
            return null;
        }
    }
    /**
     * write database. if (action success) ? true : false
     * @param string $query
     * @param array $data
     * @return bool 
     */
    public function write($query, $data = [])
    {

        $PDO = $this->pdo;
        $stm = $PDO->prepare($query);

        if (count($data) == 0) {
            $stm = $PDO->query($query);
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
// public function closeConnection()
// {
//     /*
//     The connection remains active for the lifetime of that PDO object. 
//     To close the connection, you need to destroy the object by ensuring 
//     that all remaining references to it are deleted
//     --
//     you do this by assigning NULL to the variable that holds the object.
//     */
//     $this->pdo = null;

// }
}