<?php

abstract class Model
{
    protected static $table;
    protected static $driver;

    /**
     * insert record/ row to table according data
     * @param array $data
     * @return bool
     */
    public function insert($data)
    {
        $DB = Database::create(static::$driver);
        /*
        static : late binding => dùng của con
        self : dùng static của bản thân 
        */
        return $DB->insert(static::$table, $data);

    }
    /**
     * get all in the table
     * @return array|null
     */
    public function getAll()
    {
        $DB = Database::create(static::$driver);


        // $page_number = isset($_GET['page']) ? (int) $_GET['page'] : 1;
        // $page_number = $page_number < 1 ? 1 : $page_number;

        $limit = 12;
        // $offset = ($page_number - 1) * $limit;
        $offset = 0; // vị trí
        $query = "select * from " . static::$table . " order by id desc limit $limit offset $offset";

        $data = $DB->read($query);
        if (is_array($data)) {

            return $data;
        }

        return null;

    }

}