<?php

class  ServiceController
{

    public function form()
    {
        if (isAdmin()) {
            if (isset($_POST['submit']))
                $this->store();
            else
                View::Render('/service/form');
        }
    }


    public function article()
    {
        if (isAdmin()) {
            if (isset($_POST['submit']))
                $this->ArticleStore();
            else
                View::Render('/service/article-form');
        }
    }


    public function golchin()
    {
        $db = Db::getInstance();

        $data = $db->query("
            select so.id,so.title,
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
t.title as type,
a.fullname AS artist,se.title as sessionTitle,se.description as description,se.date
from `sound` as so
JOIN `session` as se on se.id = so.session_id
JOIN `type` as t on t.id = so.type
join `artist` as a on a.id = so.artist_id
where so.`category_id` = 3
            ");


        $row['rows'] = $data;

        echo json_encode($row);

    }

    public function test()
    {
        View::Render('/service/test');
    }


    public function blog()
    {
        $db = Db::getInstance();
        $row['rows'] = $db->query("select title,content from `blog` ORDER BY id desc LIMIT 50");
        echo json_encode($row);
    }

    public function nextSession()
    {
        $db = Db::getInstance();
        $row['rows'] = $db->query("select title,description,`date`,cover_path,original_image_path from `session` where category_id = 18 ORDER BY id desc LIMIT 1");
        echo json_encode($row);
    }


//    public function home()
//    {
//        $db = Db::getInstance();
//        $row['rows'] = $db->query("select so.*,a.fullname AS artist,se.title as sessionTitle,se.description as description,se.date,
//t.title as type from sound as so JOIN `session` as se on se.id = so.session_id
//JOIN `type` as t on t.id = so.type
//join `artist` as a on a.id = so.artist_id where so.selected=1 order by so.id DESC limit 10");
//        echo json_encode($row);
//    }

    public function home()
    {
        $option = array();

        $option['host'] = 'localhost';
        $option['user'] = 'noohooir_root';
        $option['pass'] = '02414254578';
        $option['name'] = 'noohooir_mvitamin';

        $db = Db::getInstance($option);

        $data = $db->query("SELECT * from `home` ORDER BY id DESC");
        $row['rows'] = $data;
        echo json_encode($row);

    }


    private function ArticleStore()
    {
        $title = $_POST['title'];
        $description = $_POST['description'];

        $image = new SimpleImage($_FILES['cover']['tmp_name']);

        $original = 'uploads/covers/original/' . 'ashouraeyan' . date('mdis') . '.jpg';


        $thumbnail = 'uploads/covers/thumbnail/' . 'ashouraeyan' . date('mdis') . '.jpg';


        $image->resizeToWidth(900);
        $image->save($original);


        $image->square(300);
        $image->save($thumbnail);


        $date = jdate('y/m/d');
        $time = jdate('h:i');

        $db = Db::getInstance();
        $db->insert("insert into `service` (
                    `title`,
                    `description`, `date`,`time` , `main_path`,`thumbnail_path`
                    )
                    values(
                    '$title',
                    '$description','$date','$time','$original','$thumbnail'
                    )");

        redirect('/');

    }


    private function store()
    {
        $text = $_POST['text'];
        $sessionId = $_POST['session_id'];


        $db = Db::getInstance();
        $db->insert("insert into `serviceBlog` (
                    `text`,
                    `session_id`
                    )
                    values(
                    '$text',
                    '$sessionId'
                    )");

        redirect('/service/form');

    }







//       private function store()
//     {

//         $title = $_POST['title'];
//         $desc = $_POST['desc'];
//         $date = jdate('ymd'); 
//         $file_id = 1;
//         $image = new SimpleImage($_FILES['cover']['tmp_name']);

//         $original = 'uploads/covers/original/' . 'ashouraeyan' . date('mdis') . '.jpg';
//         $square = 'uploads/covers/square/' . 'ashouraeyan' . date('mdis') . '.jpg';
//         $thumbnail = 'uploads/covers/thumbnail/' . 'ashouraeyan' . date('mdis') . '.jpg';
//         $image->resizeToWidth(900);
//         $image->save($original);

//         $image->square(700);
//         $image->save($square);


//         $image->square(300);
//         $image->save($thumbnail);

//         $db = Db::getInstance();
//         $db->insert("insert into service 
// (
// `title`,
// `description`,
// `date`,
// `main_path`,
// `thumbnail_path`,
// `file`
// values(
// '$title',
// '$desc',
// '$date',
// '$original',
// '$square',
// '$file_id'


// )");


//         redirect('/');

//     }


//    public function sounds($id = null)
//    {
//        $db = Db::getInstance();
//        if (isset($id)) {
//            $data = $db->query("
//            select so.id,so.title,
//            so.length,
//            so.download_path,
//            so.like,
//            so.download_number,
//            so.download_size,
//            so.cover_path,
//            so.thumbnail_path,
//            so.original_image_path,
//            so.selected,
//            a.fullname AS artist,
//            t.title as type,
//            a.fullname AS artist,se.title as sessionTitle,se.description as description,se.date
//            from `sound` as so
//            JOIN `session` as se on se.id = so.session_id
//            JOIN `type` as t on t.id = so.type
//            join `artist` as a on a.id = so.artist_id
//            ");
//
//
//            $row['rows'] = $data;
//
//            echo json_encode($row);
//        } else {


//            $data = $db->query("            select so.title,
//              so.id,so.length,
//              so.download_path,
//              so.like,
//              so.download_number,
//              so.download_size,
//              so.cover_path,
//              so.thumbnail_path,
//              so.original_image_path,
//              so.selected,
//              a.fullname AS artist,
//              t.title as type,
//              a.fullname AS artist,se.title as sessionTitle,se.description as description,se.date
//              from `sound` as so
//              JOIN `session` as se on se.id = so.session_id
//              JOIN `type` as t on t.id = so.type
//              join `artist` as a on a.id = so.artist_id order by so.id DESC ");


    // $row['rows'] = $data;

    //  echo json_encode($row);

//}
//
//}

    public function sessions($id = null)
    {
        $db = Db::getInstance();
        if (isset($id)) {
            $data = $db->query("select * from `session` where id = '$id' order by id DESC ");
            $row['rows'] = $data;

            echo json_encode($row);
        } else {
            $data = $db->query("select * from `session` order by id DESC ");
            $row['rows'] = $data;

            echo json_encode($row);
        }
    }

//    public function photos($id = null)
//    {
//
//        if ($id == -1) {
//            $db = Db::getInstance();
//            //      $row['rows'] = $photos = $db->query("SELECT image.url as main_path,image.thumbnail as thumbnail_path, image_category.title FROM `image_category` JOIN image on image.category_id = image_category.id");
//            //  echo json_encode($row);
//            //  return;
//
//
//            $row['rows'] = $photos = $db->query("select p.title,p.thumbnail_path,p.main_path,se.title,se.date  from images as p join `session` as se on se.id = p.session_id order by p.id DESC limit 10");
//            echo json_encode($row);
//            return;
//        }
//        $db = Db::getInstance();
//        if (isset($id)) {
//            $data = $db->query("select p.id,p.thumbnail_path,p.main_path from images as p join `session` as se on se.id = p.session_id where se.id = '$id' order by p.id DESC ");
//            $row['rows'] = $data;
//
//            echo json_encode($row);
//        } else {
//
//
//            $data = $db->query("SELECT image_category.id as 'id' , image.thumbnail as 'cover_path',image.url as 'original_image_path', image_category.title from image JOIN image_category on image_category.id = image.category_id WHERE caption != '' ORDER BY id DESC");
////            $data = $db->query("    SELECT s.id,s.title,s.cover_path,s.original_image_path FROM `session` as s
////WHERE s.id IN ( SELECT DISTINCT session_id FROM `images` )  ORDER BY s.id desc ");
//            $row['rows'] = $data;
//
//            echo json_encode($row);
//        }
//    }


    public function photo($id = null)
    {
        $option = array();

        $option['host'] = 'localhost';
        $option['user'] = 'noohooir_root';
        $option['pass'] = '02414254578';
        $option['name'] = 'noohooir_mvitamin';

        $db = Db::getInstance($option);

        if ($id > 0) {
            $data = $db->query("SELECT image.id,image_category.title,image_category.description,image_category.id as category_id, image.thumbnail as 'cover_path',image.url as 'original_image_path' from image JOIN image_category on image_category.id = image.category_id WHERE image.category_id = '$id' ORDER BY image.id DESC");
            $row['rows'] = $data;
            echo json_encode($row);

        } else {

            $data = $db->query("SELECT image.id,image_category.title,image_category.description,image_category.id as category_id, image.thumbnail as 'cover_path',image.url as 'original_image_path' from image JOIN image_category on image_category.id = image.category_id WHERE caption != '' ORDER BY image.id DESC");
            $row['rows'] = $data;
            echo json_encode($row);

        }


    }

    public function tags($id = null)
    {
        $option = array();

        $option['host'] = 'localhost';
        $option['user'] = 'noohooir_root';
        $option['pass'] = '02414254578';
        $option['name'] = 'noohooir_mvitamin';

        $db = Db::getInstance($option);

        if ($id > 0) {
            $data = $db->query("SELECT sound.id,sound.title,sound.album,sound.artist,sound.band as sessionTitle,sound.year_date as date,sound.genre as type,sound.file_size as download_size ,sound.duration as length,sound.cover as cover_path, sound.url as download_path, sound.tag_id,sound_tags.title as tag FROM sound JOIN sound_tags ON sound_tags.id = sound.tag_id WHERE url != '' and sound_tags.id = $id ");
            $row['rows'] = $data;
            echo json_encode($row);

        } else {

            $data = $db->query("SELECT id,title from sound_tags where title!=' '");
            $row['rows'] = $data;
            echo json_encode($row);

        }


    }

    public function video($id = null)
    {
        $option = array();

        $option['host'] = 'localhost';
        $option['user'] = 'noohooir_root';
        $option['pass'] = '02414254578';
        $option['name'] = 'noohooir_mvitamin';

        $db = Db::getInstance($option);

        if ($id > 0) {
            $data = $db->query("SELECT * from video where id= '$id' GROUP BY videoUrl ORDER BY id DESC");
            $row['rows'] = $data;
            echo json_encode($row);

        } else {

            $data = $db->query("select * from video GROUP BY videoUrl ORDER BY id DESC");
            $row['rows'] = $data;
            echo json_encode($row);

        }


    }

    public function sounds($id = null, $tag = null, $artist = null)
    {
        $option = array();

        $option['host'] = 'localhost';
        $option['user'] = 'noohooir_root';
        $option['pass'] = '02414254578';
        $option['name'] = 'noohooir_mvitamin';

        $db = Db::getInstance($option);


//        if($tag == 0 && $id == 0 && $artist != null){
//            echo $artist;
//            $data = $db->query("SELECT sound.id,sound.title,sound.album,sound.artist,sound.band as sessionTitle,sound.year_date as date,sound.genre as type,sound.file_size as download_size ,sound.duration as length,sound.cover as cover_path, sound.url as download_path, sound.tag_id,sound_tags.title as tag FROM sound JOIN sound_tags ON sound_tags.id = sound.tag_id WHERE url != '' and sound.artist = $artist ");
//            $row['rows'] = $data;
//            echo json_encode($row);
//        }

        if ($tag > 0 && $id == 0) {


            $data = $db->query("SELECT sound.id,sound.title,sound.album,sound.artist,sound.band as sessionTitle,sound.year_date as date,sound.genre as type,sound.file_size as download_size ,sound.duration as length,sound.cover as cover_path, sound.url as download_path, sound.tag_id,sound_tags.title as tag FROM sound JOIN sound_tags ON sound_tags.id = sound.tag_id WHERE url != '' and sound_tags.id = $tag ");
            $row['rows'] = $data;
            echo json_encode($row);

        } else if ($id > 0) {
            $data = $db->query("SELECT sound.id,sound.title,sound.album,sound.artist,sound.band as sessionTitle,sound.year_date as date,sound.genre as type,sound.file_size as download_size ,sound.duration as length,sound.cover as cover_path, sound.url as download_path, sound.tag_id,sound_tags.title as tag FROM sound JOIN sound_tags ON sound_tags.id = sound.tag_id WHERE url != '' and sound.`id`='$id' ");
            $row['rows'] = $data;
            echo json_encode($row);

        } else {

            $data = $db->query("SELECT sound.id,sound.title,sound.album,sound.artist,sound.band as sessionTitle,sound.year_date as date,sound.genre as type,sound.file_size as download_size ,sound.duration as length,sound.cover as cover_path, sound.url as download_path,sound.tag_id, sound_tags.title as tag FROM sound JOIN sound_tags ON sound_tags.id = sound.tag_id WHERE url != '' GROUP BY `title`,`artist`,`date`,`sessionTitle` ORDER BY sound.id DESC ");
            $row['rows'] = $data;
            echo json_encode($row);

        }


    }

//    public
//    function videos($id = null)
//    {
//        $db = Db::getInstance();
//        if (isset($id)) {
//
//            $data = $db->query("select
//                  v.id,
//                  v.title,
//                  v.download_path,
//                  v.file_size,
//                  se.title,
//                  se.date,
//                  se.thumbnail_path
//                    from video as v join `session` as se on se.id = v.session_id
//                    where v.id = '$id'
//                    order by v.id DESC  ");
//
//            //  $data = $db->query("select * from video where id = '$id' order by id DESC ");
//            $row['rows'] = $data;
//
//            echo json_encode($row);
//        } else {
//
//            $data = $db->query("select
//                  v.id,
//                  v.title,
//                  v.download_path,
//                  v.file_size,
//                  se.title,
//                  se.date,
//                  se.thumbnail_path
//                    from video as v join `session` as se on se.id = v.session_id order by v.id DESC ");
//
//            //  $data = $db->query("select * from video order by id DESC ");
//            $row['rows'] = $data;
//
//            echo json_encode($row);
//        }
//    }


    public
    function posts($id = null)
    {

        $db = Db::getInstance();
        if (isset($id)) {
            $data = $db->query("select * from service where id = '$id' order by id ASC ");
            $row['rows'] = $data;

            echo json_encode($row);
        } else {
            $data = $db->query("select * from service order by id DESC ");
            $row['rows'] = $data;

            echo json_encode($row);
        }
    }


}