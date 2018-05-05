<?php

function br($row = null)
{
    if ($row != null) {
        for ($i = 0; $i < $row; $i++)
            echo "<br>";
    } else {
        echo "<br>";
    }
}

function getCurrentDateTime()
{
    return date("Y-m-d H:i:s");

}

 

function getFullUrl()
{
    $fullurl = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    return $fullurl;
}

function getRequestUri()
{
    return $_SERVER['REQUEST_URI'];
}

function getUrl(){
    return "http://www.noohoo.ir/";
}

function baseUrl()
{
    global $config;
    return $config['base'];
}

function pageTitle(){
    echo "هیئت عاشورائیان | وارثان شهدا";
}

function fullBaseUrl()
{
    global $config;
    return 'http://' . $_SERVER['HTTP_HOST'] . $config['base'];
}

function strhas($string, $search, $caseSensitive = false)
{
    if ($caseSensitive) {
        return strpos($string, $search) !== false;
    } else {
        return strpos(strtolower($string), strtolower($search)) !== false;
    }
}

function message($type, $message, $mustExit = false)
{
    $data['message'] = $message;
    View::render("/message/$type.php", $data);
    if ($mustExit) {
        exit;
    }
}

function redirect($path)
{
    return header('Location: http://www.noohoo.ir'  . $path);
}

function dump($var, $return = false)
{
    if (is_array($var)) {
        $out = print_r($var, true);
    } else if (is_object($var)) {
        $out = var_export($var, true);
    } else {
        $out = $var;
    }

    if ($return) {
        return "\n<pre style='direction: ltr'>$out</pre>\n";
    } else {
        echo "\n<pre style='direction: ltr'>$out</pre>\n";
    }
}

function uploadImage()
{

    $uploadDir = 'uploads/images/';
    $uploadFile = $uploadDir .date('md') . time(). basename($_FILES['fileToUpload']['name']);
        move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $uploadFile);
        return $uploadFile;
 
}

function uploadImage2()
{
    $uploaded = array();
    $uploadDir = 'uploads/images/';
    foreach ($_FILES["fileToUpload2"]["tmp_name"] as $key => $tmp_name) {

        $uploadFile = $uploadDir . uniqid() . basename($_FILES["fileToUpload2"]["name"][$key]);
        move_uploaded_file($_FILES["fileToUpload2"]["tmp_name"][$key], $uploadFile);
        $uploaded[] =  $uploadFile;

    }
    return $uploaded;
}

function isAdmin()
{
    if (isGuest()) {
        return false;
    }

    $access = $_SESSION["role"];

    if ($access == "admin") {
        return true;
    }

    return false;
}

function isGuest()
{
    return !isset($_SESSION["role"]) ? true : false;
}

function getXml($url)
{
    $xml = file_get_contents($url);
    foreach ($http_response_header as $header)
    {
        if (preg_match('#^Content-Type: text/xml; charset=(.*)#i', $header, $m))
        {
            switch (strtolower($m[1]))
            {
                case 'utf-8':
                    // do nothing
                    break;

                case 'iso-8859-1':
                    $xml = utf8_encode($xml);
                    break;

                default:
                    $xml = iconv($m[1], 'utf-8', $xml);
            }
            break;
        }
    }

    return simplexml_load_string($xml);
}

function formatBytes($bytes, $precision = 2) {
    $units = array('B', 'KB', 'MB', 'GB', 'TB');

    $bytes = max($bytes, 0);
    $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
    $pow = min($pow, count($units) - 1);

    // Uncomment one of the following alternatives
     $bytes /= pow(1024, $pow);
    // $bytes /= (1 << (10 * $pow)); 

    return round($bytes, $precision) . 'Mb';
} 


function pagination($url, $showCount, $activeClass, $deactiveClass, $currentPageIndex, $pageCount, $jsFunction = null){
  ob_start();

  if ($jsFunction){
    $tags = "span";
    $action = 'onclick="' . $jsFunction . '(#)"';
  } else {
    $tags = "a";
    $action = 'href="' . $url . '/#"';
  }
  ?>

  <? $rAction = str_replace("#", "1", $action); ?>
  <<?=$tags?> <?=$rAction?> class="<?=$activeClass?>">1</<?=$tags?>>
  <!--<span>_</span>-->
  <? for ($i=$currentPageIndex-$showCount; $i<=$currentPageIndex+$showCount; $i++){ ?>
    <? if ($i <= 1) { continue; } ?>
    <? if ($i >= $pageCount) { continue; } ?>
    <? if ($i == $currentPageIndex) { ?>
      <span class="<?=$deactiveClass?>"><?=$i?></span>
    <? } else { ?>
      <? $rAction = str_replace("#", $i, $action); ?>
      <<?=$tags?> <?=$rAction?> class="<?=$activeClass?>"><?=$i?></<?=$tags?>>
    <? } ?>
  <? } ?>
  <span>...</span>
  <? $rAction = str_replace("#", $pageCount, $action); ?>
  <<?=$tags?>
  <?=$rAction?>
  class="<?=$activeClass?>">
  <?=$pageCount?>
  </<?=$tags?>>

  <?
  $output = ob_get_clean();
  return $output;
}

