<?php

function teamlead_controller($controllerName)
{
    $controllerName = strtolower($controllerName);
    return PATH . '/teamlead/controller/' . $controllerName . '.php';
}

function teamlead_view($viewName)
{
    return PATH . '/teamlead/view/' . $viewName . '.php';
}

function teamlead_url($url = false){
    return URL . '/teamlead/' . $url;
}


