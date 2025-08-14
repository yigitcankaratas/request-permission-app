<?php

function manager_controller($controllerName)
{
    $controllerName = strtolower($controllerName);
    return PATH . '/manager/controller/' . $controllerName . '.php';
}

function manager_view($viewName)
{
    return PATH . '/manager/view/' . $viewName . '.php';
}

function manager_url($url = false){
    return URL . '/manager/' . $url;
}


