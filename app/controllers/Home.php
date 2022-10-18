<?php

class Home extends Controller
{
    protected $_model;

    public function __construct()
    {
        $this->_model = $this->model('HomeModel');
    }

    public function index()
    {
        $data = $this->_model->getList();
       // $data = $this->_model->first();

        var_dump($data);
    }

    public function detail()
    {

    }
}