<?php

function user_controller($controllerName)
{
    $controllerName = strtolower($controllerName);
    return PATH . '/user/controller/' . $controllerName . '.php';
}

function user_view($viewName)
{
    return PATH . '/user/view/' . $viewName . '.php';
}

function user_url($url = false){
    return URL . '/user/' . $url;
}
