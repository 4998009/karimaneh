<?php


class View
{


    public static function Render($viewPath , $array = null)
    {

        if (isset($array)) {
            extract($array);
        }
        ob_start();


        require_once(getcwd().'/view' . $viewPath . '.php');

        $contentPage = ob_get_clean();
        require_once(getcwd() . '/view/header.php');
    }

    public static function renderPartial($viewPath, $data = array(), $return = false){
        extract($data);

        if ($return) {
            ob_start();
        }

        require_once(getcwd() . '/view' . $viewPath . '.php');

        if ($return) {
            return ob_get_clean();
        }

    }
}