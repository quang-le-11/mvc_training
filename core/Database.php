<?php

class Database
{
    private $__conn;

    public function __construct()
    {
        global $db_config;
        $this->__conn = Connection::getInstance($db_config);
    }

    public function insert($table, $data)
    {
        if (!empty($table)) {
            $fieldStr = '';
            $valueStr = '';
            foreach ($data as $key => $value) {
                $fieldStr .= "'" . $key . "',";
                $valueStr .= "'" . $value . "',";
            }
            $fieldStr = rtrim($fieldStr, ',');
            $valueStr = rtrim($valueStr, ',');

            $sql = "INSERT INTO $table($fieldStr) VALUES ($valueStr)";
            $status = $this->query($sql);
            if ($status) {
                return true;
            }
        }
        return false;
    }

    public function update($table, $data, $condition = '')
    {
        if (!empty($data)) {
            $updateStr = '';
            foreach ($data as $key => $value) {
                $updateStr .= "$key='$value',";
            }
            $updateStr = rtrim($updateStr, ',');
            if (!empty($condition)) {
                $sql = "UPDATE $table SET $updateStr WHERE $condition";
            } else {
                $sql = "UPDATE $table SET $updateStr";
            }

            $status = $this->query($sql);
            if ($status) {
                return true;
            }
        }
        return false;
    }

    public function delete($table, $condition = '')
    {
        if (!empty($condition)) {
            $sql = "DELETE FROM $table WHERE $condition";
        } else {
            $sql = "DELETE FROM $table";
        }
        $status = $this->query($sql);
        if ($status) {
            return true;
        }
        return false;
    }

    public function query($sql)
    {
        $statement = $this->__conn->prepare($sql);
        $statement->execute();
        return $statement;
    }

    public function lastInsertId()
    {
        return $this->__conn->lastInsertId();
    }
}