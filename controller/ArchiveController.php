<?php

class ArchiveController
{


    public function index($pageIndex = null)
    {
        if($pageIndex == null)
        $pageIndex = 1;
    $count = 8;
    $startIndex = ($pageIndex-1) * $count;
    $data = array();
          $db = Db::getInstance();
        $data['records'] =$db->query("select  so.id, so.title,
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
                                a.id as artistId,
                                t.title as type
                                from `sound` as so
                                JOIN `type` as t on t.id = so.type
                                join `artist` as a on a.id = so.artist_id
                                order by id desc
                                LIMIT $startIndex, $count
                               
                                ");
                                
  // LIMIT $startIndex, $count
 
 
    $records = $db->query("SELECT COUNT(*) AS total FROM sound");
    $recordsCount = $records[0]['total'];
  
    
    
    $data['pageCount'] = ceil($recordsCount / 10);
    $data['pageIndex'] = $pageIndex;

                                
        View::Render('/archive/index' , $data);
    }
    public function form()
    {
        if (isAdmin()) {
            if (isset($_POST['submit']))
                $this->store();
            View::Render('/archive/form');

        }

    }
    
    public function category($id){
         View::Render('/archive/category' , array('id'=>$id));
    }


    public function aaa($id = null){
        if ($id > 0) {

            $json_images = file_get_contents('https://www.noohoo.ir/service/sounds/'.$id);
            $images = json_decode($json_images);

            View::Render('/mp3/single', array('data' => $images->rows));

        } else {
            $json_images = file_get_contents('https://www.noohoo.ir/service/sounds');
            $data = json_decode($json_images);

            View::Render('/mp3/list', array('data' => $data->rows));
        }
    }



    private function store()
    {
        
        
  
        
        
        $title = $_POST['title'];
        $desc = $_POST['desc'];
        $date = $_POST['date'];
        $category = implode(",", $_POST['category']);
        
        $has_gallery = $_POST['has_gallery'];


        if ($title == null){
            redirect('/archive/form');
            return;
        }

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


        Db::getInstance()->insert("insert into `session` 
(title,description,`date`,
thumbnail_path,cover_path,
original_image_path,has_gallery, selected,category_id) VALUES
 ('$title', '$desc' ,'$date','$thumbnail','$square','$original','$has_gallery', 0,'$category' )");
    }

    public function category_form()
    {
        if (isAdmin()) {
            if (isset($_POST['submit']))
                $this->category_store();
            View::Render('/archive/category_form');

        }

    }

    public function category_store()
    {

        $title = $_POST['title'];
        Db::getInstance()->insert("insert into category (title) values('$title')");
        redirect("/archive/form");

    }
    
  
}