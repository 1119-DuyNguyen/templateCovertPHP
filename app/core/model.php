<?php

class Model
{
    protected static $table;
    protected static $driver;
    /**
     * insert record/ row to table according data
     * @param array $data
     * @return void
     */
    public function insert($data)
    {
        $db = Database::create(static::$driver);
        /*
        static : late binding => dùng của con
        self : dùng static của bản thân 
        */
        return $db->insert(static::$table, $data);

    }

}