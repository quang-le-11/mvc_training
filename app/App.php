<?php

class App
{
    private $__controller;
    private $__action;
    private $__params;
    private $__routes;

    static public $app;

    public function __construct()
    {
        global $routes, $config;

        self::$app = $this;

        $this->__routes = new Routes();
        if(!empty($routes['default_controller'])) {
            $this->__controller = $routes['default_controller'];
        }
        $this->__action = 'index';
        $this->__params = [];
        $this->handleUrl();
    }

    /**
     * Get url
     * @return mixed|string
     */
    public function getUrl()
    {
        $url = '/';
        if(!empty($_SERVER['PATH_INFO'])) {
            $url = $_SERVER['PATH_INFO'];
        }
        return $url;
    }

    /**
     * Handle url
     * @return void
     */
    public function handleUrl()
    {
        $url = $this->getUrl();
        $url = $this->__routes->handleRoutes($url);
        $urlArr = array_values(array_filter(explode('/', $url)));

        $urlCheck = '';

        //Tim file trong controller
        if(!empty($urlArr)) {
            foreach ($urlArr as $key => $item) {
                $urlCheck .= $item.'/';
                $fileCheck = rtrim($urlCheck, '/');
                $fileArr = explode('/', $fileCheck);
                $fileArr[count($fileArr) - 1] = ucfirst($fileArr[count($fileArr) -1]);
                $fileCheck = implode('/',$fileArr );

                if(!empty($urlArr[$key - 1])) {
                    unset($urlArr[$key - 1]);
                }
                if(file_exists('app/controllers/'. ($fileCheck) .'.php')) {
                    $urlCheck = $fileCheck;
                    break;
                }
            }
            $urlArr = array_values($urlArr);
        }
        //Handle Controller
        if(!empty($urlArr[0])) {
            $this->__controller = ucfirst($urlArr[0]);
        } else {
            $this->__controller = ucfirst($this->__controller);
        }

        //handle when $urlCheck rong
        if(empty($urlCheck)) {
            $urlCheck = $this->__controller;
        }
        if(file_exists('app/controllers/'. $urlCheck .'.php')) {
            require_once 'controllers/'. $urlCheck .'.php';
            //check class $this->__controller exist
            if(class_exists($this->__controller)) {
                $this->__controller = new $this->__controller();
                unset($urlArr[0]);
            } else {
                $this->loadError();
            }
        }else {
            $this->loadError();
        }

        //Handle Action
        if(!empty($urlArr[1])) {
            $this->__action = $urlArr[1];
            unset($urlArr[1]);
        }

        //Handle Params
        $this->__params = array_values($urlArr);
        //check method exist
        if(method_exists($this->__controller, $this->__action)) {
            call_user_func_array([$this->__controller, $this->__action], $this->__params);
        } else {
            $this->loadError();
        }
    }

    /**
     * When error page
     *
     * @param $name
     * @return void
     */
    public function loadError($name = '404', $data = [])
    {
        extract($data);
        require_once 'errors/'.$name.'.php';
    }
}