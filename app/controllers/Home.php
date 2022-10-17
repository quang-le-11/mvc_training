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
    }

    public function detail()
    {

    }
}