<?php

class Routes
{
    /**
     * Handle Routes
     *
     * @param $url
     * @return array|string|string[]|null
     */
    public function handleRoutes($url)
    {
        global $routes;
        unset($routes['default_controller']);
        $url = trim($url, '/');
        if(empty($url)) {
            $url = '/';
        }
        $handeUrl = $url;
        if(!empty($routes)) {
            foreach ($routes as $key => $value) {
                if(preg_match('~'.$key.'~is', $url)) {
                    $handeUrl = preg_replace('~'.$key.'~is', $value ,$url);
                }
            }
        }
        return $handeUrl;
    }
}