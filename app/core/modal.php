<?php

class Modal
{
    protected static $table;
    public function save()
    {
        $db = new Database();
        $db->insert(static::$table, get_object_vars($this));
    }
}
