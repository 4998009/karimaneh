<?php

class UserController
{


    function __construct()
    {
        $ss = Db::getInstance()->query("SELECT s.title,a.fullname,s.cover_path,s.id FROM `sound` as s JOIN artist as a ON a.id = s.artist_id");
        $artists = Db::getInstance()->query("SELECT * from artist");

        $json_images = file_get_contents('https://www.noohoo.ir/service/photo');
        $images = json_decode($json_images);

        $text = '<url><loc>https://www.noohoo.ir/archive</loc></url><url><loc>https://www.noohoo.ir/video</loc></url><url><loc>https://www.noohoo.ir/photo</loc></url>';
        $text .= '<url><loc>https://www.noohoo.ir/photo/</loc></url>';



        $images = $images->rows;
        foreach ($images as $item) {
            $text .= '<url><loc>https://www.noohoo.ir/photo/index/' . $item->category_id . '</loc></url>';

        }

        foreach ($ss as $item) {
            $text .= '<url><loc>https://www.noohoo.ir/mp3/id/' . $item['id'] . '</loc></url>';

        }
        foreach ($artists as $aa) {
            $text .= '<url><loc>https://www.noohoo.ir/artist/id/' . $aa['id'] . '</loc></url>';

        }


        $header = '<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';

        $footer = '</urlset>';

        $xml = $header . $text . $footer;


        $myfile = fopen("sitemap.xml", "w") or die("Unable to open file!");
        fwrite($myfile, $xml);
        fclose($myfile);


    }
//    public function register()
//    {
//        View::Render('/user/register');
//    }

    public function xn_login()
    {
        if (isset($_POST['email']))
            $this->check();
        else
            View::Render('/user/login');
    }

    public function store()
    {
        $email = $_POST['email'];
        $password = $_POST['password1'];
        $password2 = $_POST['password2'];
        $db = Db::getInstance();
        $result = $db->first("SELECT * FROM xno_user WHERE email='$email'");

        if (strlen($password) < 3 || strlen($password2) < 3) {
            exit;
        }

        if ($password != $password2) {
            exit;
        }

        if ($result != null) {
            exit;
        }

        UserModel::Register($email, $password);
    }

    public function xn_logout()
    {
        session_destroy();
        redirect('/user/xn_login');
    }

    public function check()
    {
        $email = $_POST['email'];
        $password = $_POST['password'];
        $db = Db::getInstance();
        $result = $db->first("SELECT * FROM xno_user WHERE email='$email'");

        if ($result == null) {
        }

        if ($result['password'] == $password) {
            $_SESSION['email'] = $result['email'];
            $_SESSION['role'] = $result['role'];
            redirect("/");
        } else {
        }
    }

    public function artist_form()
    {
        if (isAdmin()) {
            if (isset($_POST['submit']))
                $this->artist_store();
            View::Render('/user/artist_form');
        }

    }

    private function artist_store()
    {
        $title = $_POST['title'];
        Db::getInstance()->insert("insert into artist (fullname) values('$title')");
        redirect("/user/artist_form");
    }

}