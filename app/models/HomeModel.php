<?php

class HomeModel extends Model
{
    protected $_table = 'products';

    public function tableFill()
    {
        return 'products';
    }

    public function fieldFill()
    {
        return 'name_product';
    }

    public function getList()
    {
        $data = $this->db->query("SELECT * FROM $this->_table")->fetchAll(PDO::FETCH_ASSOC);
        return $this->get();
    }

    public function getDetail($id)
    {
        $data = [
            'item 1',
            'item 2'
        ];
        return $data[$id];
    }

    public function getListProducts()
    {
        $this->db->table('products')
            ->where('id', '>', 3)
            ->where('name', '=', 1)
            ->select('quang')
            ->get();
    }

}