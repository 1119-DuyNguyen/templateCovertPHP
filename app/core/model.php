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
    /**
     *  query only one element
     * @param string $id
     * @return array|null
     */
    function getOne($id)
    {

        $query = "select * from " . static::$table . " where id = :id limit 1";
        $DB = Database::create(static::$driver);

        $data = $DB->read($query, ['id' => strval($id)]);


        if ($data) {

            return $data[0];
        }

        return null;
    }
}