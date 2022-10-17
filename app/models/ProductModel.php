<?php

class ProductModel extends Model
{
    protected $_table = 'products';
    public function getProductList()
    {
        return $this->db->query("SELECT * FROM $this->_table")->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getDetail($id)
    {
        $data = [
            'san pham 1',
            'san pham 2'
        ];
        return $data[$id];
    }
}