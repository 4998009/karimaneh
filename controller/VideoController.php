<?php

class VideoController
{

    public function index(){
        View::Render('/video/index');

    }

    public function play($id)
    {
        if ($id == null){
            redirect('/video');
            return;
        }

        View::Render('/video/play' , array('id' => $id));
    }
    
    public function all(){
          $json_images = file_get_contents('https://app.noohoo.ir/service/video');
         $images = json_decode($json_images);
      
         View::Render('/video/all' , array('data' => $images->rows));
         
       
    }
    

    public function form()
    {
        if (isAdmin()) {
            if (isset($_POST['submit']))
                $this->store();
            else
                View::Render('/video/form');
        }
    }

    public function store()
    {
        $session = $_POST['session'];


        $location = 'uploads/videos/' . 'ashouraeyan' . date('mdis') . '.mp4';
        move_uploaded_file($_FILES['video']['tmp_name'], $location);

//        dump($_FILES);
//        exit;

        $title = $_POST['title'];
//        $duration = gmdate('i:s', $duration);
        $fileSize = filesize($_FILES['video']['size']);
        $fileSize = formatBytes($fileSize);


        $db = Db::getInstance();
        $db->insert("insert into video 
        (
        title,
        `download_number`,
        `download_path`,
        `session_id`,
        `file_size`
        ) VALUES (
        '$title',
        0,
        '$location',
        '$session',
        '$fileSize'

)");

    }


}