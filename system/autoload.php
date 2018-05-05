<?php

function __autoload($className)
{


    $url = getcwd() . "/controller/" . $className . ".php";
    if (file_exists($url)) {

        if (strhas($className, "Controller")) {
            require_once(getcwd() . '/controller/' . $className . '.php');
        }
    } 


    if (strhas($className, 'Model')) {
        require_once(getcwd() . '/model/' . $className . '.php');
        return;
    }


}