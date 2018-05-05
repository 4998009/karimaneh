 
 
 
 <?
 
    
   
   
  
      
    //  require_once(getcwd() . "/system/simple_html_dom.php");







//dump($html);
// Find all images 
 $i = 0;
 
  
    
    $xml = getXml("http://www.shia-news.com/fa/rss/1/mostvisited");
                $array = json_decode(json_encode($xml), true);
                foreach ($array as $a) {
                    $news = $a['item'];
                    
                }
              //  dump($news);
                
                 foreach ($news as $a) {
                    //  $i++;
                     $title = $a['title'];
                     
      $content = file_get_contents($a['link']);

          $regex = '#\<div align="justify"\>(.+?)\<\/div\>#s';
         
          
          
                 
preg_match($regex, $content, $matches);


$match = $matches[0];



$res = Db::getInstance()->query("select `title` from `blog` where `title`='$title' ");

if($res == null){
  
     $removedHtml = preg_replace('/<[^>]*>/', '', $match);
    $string =str_replace("&nbsp;"," ",$removedHtml);
    if($string == null){continue;}
$data = Db::getInstance()->query("insert into `blog`(`title`,`content`) values ('$title','$removedHtml') ");
}


// if($i ==15)
//     return;
                    
}
        
 

?>