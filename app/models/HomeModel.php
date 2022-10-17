<?php

class HomeModel extends Model
{
    protected $_table = 'products';

    public function getList()
    {
       $data = $this->db->query("SELECT * FROM $this->_table")->fetchAll(PDO::FETCH_ASSOC);
       var_dump($data);
       return $data;
    }

    public function getDetail($id)
    {
        $data = [
            'item 1',
            'item 2'
        ];
        return $data[$id];
    }
}