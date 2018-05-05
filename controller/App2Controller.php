<?php

class  App2Controller
{
    
    public function index(){
        $db = Db::getInstance();
        $data = $db->query("select * from hesam");
         $row['rows'] = $data;
         echo json_encode($row);
         
    }
    
    public function form() {
   
            if (isset($_POST['submit']))
                $this->store();
            else
                View::Render('/app2/form');
       
    }
    
    
    
     public function store(){
          $db = Db::getInstance();
          $title = $_POST['title'];
          $text = $_POST['text'];

          $db->query("Insert into hesam (`title` ,  `text`) values('$title' , '$text')");
          
          redirect('/app2/form');
    }
    
} 


?>