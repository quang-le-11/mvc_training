<?php

class Product extends Controller
{
    protected $data = [];
    protected $_model;

    public function __construct()
    {
        $this->_model = $this->model('ProductModel');
    }

    public function index()
    {
        echo 'danh sanh san pham';
    }

    public function list()
    {
        $dataProduct =  $this->_model->getProductList();

        $title = 'product list';

        $this->data['sub_content']['page_title'] = $title;
        $this->data['sub_content']['list_product'] = $dataProduct;
        $this->data['content'] = 'products/list';

        //render view
        $this->render('layouts/client_layout', $this->data);
    }

    public function detail($id = 0)
    {
        $this->data['sub_content']['info'] = $this->_model->getDetail($id);
        $this->data['sub_content']['title'] = 'product detail';
        $this->data['content'] = 'products/detail';

        $this->render('layouts/client_layout', $this->data);
    }
}