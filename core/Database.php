<?php

class Database
{
    /**
     * @var PDO|null
     */
    private $__conn;

    use QueryBuilder;

    public function __construct()
    {
        global $db_config;
        $this->__conn = Connection::getInstance($db_config);
    }

    /**
     * Insert data in database
     *
     * @param $table
     * @param $data
     * @return bool
     */
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

    /**
     * Update Data
     *
     * @param $table
     * @param $data
     * @param $condition
     * @return bool
     */
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

    /**
     * Delete
     *
     * @param $table
     * @param $condition
     * @return bool
     */
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

    /**
     * Queue data
     *
     * @param $sql
     * @return false|PDOStatement
     */
    public function query($sql)
    {
        try {
            $statement = $this->__conn->prepare($sql);
            $statement->execute();
            return $statement;
        } catch (Exception $exception) {
            $mess = $exception->getMessage();
            $data['message'] = $mess;
            App::$app->loadError('database', $data);
            die();
        }
    }

    /**
     * @return false|string
     */
    public function lastInsertId()
    {
        return $this->__conn->lastInsertId();
    }
}