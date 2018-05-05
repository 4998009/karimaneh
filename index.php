<?


define("Hello", true);
require_once(getcwd() . '/system/main.php');

$uri = getRequestUri();
global $config;
$uri = str_replace($config['base'], "", $uri);
$parts = explode("/", $uri);

if ($parts[1] == '')
   // $controller = 'index';
      $controller = 'index';
else
    $controller = $parts[1];


if (!isset($parts[2]))
    $method = 'index';
else
    $method = $parts[2];

$params = array();
for ($i = 3; $i < count($parts); $i++) {
    $params[] = $parts[$i];
}


$className = ucfirst($controller) . "Controller";
if (class_exists($className)) {

    $instance = new $className();
    if (isset($instance) and isset($method)) {
        if (method_exists($instance, $method)) {
            call_user_func_array(array($instance, $method), $params);
        } else {
            View::Render('/404');
        }
    }
} else {
    View::Render('/404');
}




