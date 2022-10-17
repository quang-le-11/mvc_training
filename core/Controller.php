<?php

class Controller
{
    /**
     * Get Model
     *
     * @param $model
     * @return false|mixed
     */
    public function model($model)
    {
        if(file_exists(_DIR_ROOT . '/app/models/'.$model.'.php')) {
            require_once _DIR_ROOT . '/app/models/'.$model.'.php';
            if(class_exists($model)) {
                return new $model();
            }
        }
        return false;
    }

    /**
     * Render view
     *
     * @param $view
     * @param $data
     * @return void
     */
    public function render($view, $data = [])
    {
        extract($data);
        if(file_exists(_DIR_ROOT.'/app/views/'.$view.'.php')) {
            require_once _DIR_ROOT.'/app/views/'.$view.'.php';
        }
    }
}