<?php
$routes['default_controller'] = 'home';

/**
 * duong dan ao => duong dan that
 */
$routes['san-pham'] = 'product/index';
$routes['trang-chu'] = 'home';
$routes['tin-tuc/.+-(\d+).html'] = 'news/category/$1';