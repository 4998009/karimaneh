<?
$db = Db::getInstance();
$data = $db->query("select 
                  v.title,
                  v.download_path,
                  v.file_size,
                  se.title,
                  se.date,
                  se.thumbnail_path  
                    from video as v join `session` as se on se.id = v.session_id WHERE v.id = '$id'");
//dump($data);

?>

<h1><?=$data[0]['title']?></h1>
<video controls>
    <source src="<?=getUrl() .  $data[0]['download_path']?>" type="video/mp4">
</video>

<br>

<a href="<?=getUrl() .  $data[0]['download_path']?>" dwonload>دانلود فایل</a>
