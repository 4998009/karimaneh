<?php

class PhotoController
{

//
//  public function index(){
//      View::Render('/photo/index');
//
//  }
    public function detail($id)
    {
        View::Render('/photo/detail', array('id' => $id));

    }

    public function form()
    {
        if (isAdmin()) {
            if (isset($_POST['submit']))
                $this->store();
            else
                View::Render('/photo/form');
        }

    }


    public function index($id = null)
    {
        if ($id > 0) {

            $json_images = file_get_contents('https://www.noohoo.ir/service/photo/'.$id);
            $images = json_decode($json_images);

            View::Render('/photo/list', array('data' => $images->rows));

        } else {
            $json_images = file_get_contents('https://www.noohoo.ir/service/photo');
            $images = json_decode($json_images);

            View::Render('/photo/all', array('data' => $images->rows));
        }

    }


    private function store()
    {
        $files = $_FILES['images'];
        $tempImages = $files['tmp_name'];
        $session = $_POST['session'];

        for ($i = 0; $i < count($tempImages); $i++) {

            $image = new SimpleImage($tempImages[$i]);
            $original = 'uploads/images/original/' . 'ashouraeyan' . date('mdis') . $i . '.jpg';

            $thumbnail = 'uploads/images/thumbnail/' . 'ashouraeyan' . date('mdis') . $i . '.jpg';
            $image->resizeToWidth(900);
            $image->save($original);

            $image->square(300);
            $image->save($thumbnail);

            Db::getInstance()->insert(
                "insert into images (session_id,`like`,thumbnail_path,main_path)
             VALUES ('$session',0,'$thumbnail','$original')"
            );


        }
        redirect('/photo');


    }


}