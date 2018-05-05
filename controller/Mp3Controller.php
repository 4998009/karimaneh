<?php

class Mp3Controller
{

    public function index($id)
    {


   
        
            
//        $data = Mp3Model::GetFiles();
//        View::Render('/mp3/index', array('data' => $data));
    }

    public function form()
    {
        if (isAdmin()) {
            if (isset($_POST['submit']))
                $this->store();
            else
                View::Render('/mp3/form');
        }

    }
    
    public function id($id){
                if(isset($id)){
            
              
    $data = Db::getInstance()->query("

select so.id, so.title,
so.length,
so.download_path,
so.like,
so.download_number,
so.download_size,
so.cover_path,
so.thumbnail_path,
so.original_image_path,
so.selected,
a.fullname AS artist,
t.title as type
from `sound` as so
JOIN `type` as t on t.id = so.type
join `artist` as a on a.id = so.artist_id
WHERE so.id = '$id';
");

View::Render('/mp3/single' , array('data' => $data[0]) );

    }
        
    }
    
    
    
    public function like($id){
       if ($_SERVER['REQUEST_METHOD'] === 'POST') {
              $db = Db::getInstance();
              $db->query("UPDATE sound SET `like` = `like` + 1 where id = '$id'");
        }
    }


    private function store()
    {

        $title = $_POST['title'];
        $artist = $_POST['artist'];
        $type = $_POST['type'];
        $session = $_POST['session'];
        $category = implode(",", $_POST['category']);

        $sound = 'uploads/mp3/' . 'ashouraeyan' . date('mdis') . '.mp3';
        move_uploaded_file($_FILES['sound']['tmp_name'], $sound);
      

        $mp3File = new MP3File($sound);
        $duration = $mp3File->getDurationEstimate();
//        $duration = MP3File::formatTime($duration);
        $duration = gmdate('i:s', $duration);
        $fileSize = filesize($sound);
        $fileSize = formatBytes($fileSize);
        $fileSize = round($fileSize) .'MB';
        $image = new SimpleImage($_FILES['cover']['tmp_name']);

        $original = 'uploads/covers/original/' . 'ashouraeyan' . date('mdis') . '.jpg';
        $square = 'uploads/covers/square/' . 'ashouraeyan' . date('mdis') . '.jpg';
        $thumbnail = 'uploads/covers/thumbnail/' . 'ashouraeyan' . date('mdis') . '.jpg';
        $image->resizeToWidth(900);
        $image->save($original);

        $image->square(700);
        $image->save($square);


        $image->square(300);
        $image->save($thumbnail);

        $db = Db::getInstance();
        $db->insert("insert into sound 
(`title`,
`artist_id`,
`type`,
`length`,
`download_path`,
`like`,
`session_id`,
`download_number`,
`download_size`,
`cover_path`,
`thumbnail_path`,
`original_image_path`,
`selected`,
`category_id`
) VALUES (
'$title',
'$artist',
'$type',
'$duration',
'$sound',
0,
$session,
0,
'$fileSize',
'$square',
'$thumbnail',
'$original',
0,
'$category'

)");


        redirect('/');

    }
    public function type_form()
    {
        if (isAdmin()) {
            if (isset($_POST['submit']))
                $this->type_store();
            View::Render('/mp3/type_form');
        }

    }

    private function type_store(){
        $title = $_POST['title'];
        Db::getInstance()->insert("insert into type (title) values('$title')");
        redirect("/mp3/type_form");
    }


}