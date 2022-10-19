<?php
trait QueryBuilder
{
    public $tableName = '';
    public $where = '';
    public $operator = '';
    public $selectField = '*';

    public function table($tableName)
    {
        $this->tableName = $tableName;
        return $this;
    }

    public function where($field, $compare, $value)
    {
        if (empty($this->where)) {
            $this->operator = ' WHERE';
        } else {
            $this->operator = ' AND';
        }
        $this->where .= "$this->operator $field $compare '$value'";
        return $this;
    }

    public function select($field = '*')
    {
        if (!empty($field)) {
            $this->selectField = $field;
        }
        return $this;
    }

    public function get()
    {
        $sqlQuery = "SELECT $this->selectField FROM $this->tableName $this->where";
        echo $sqlQuery.'<br/>';
    }
}