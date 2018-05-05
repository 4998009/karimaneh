<?php
$db = Db::getInstance();
$data = $db->query("select 
                  v.id,
                  v.title,
                  v.download_path,
                  v.file_size,
                  se.title,
                  se.date,
                  se.thumbnail_path  
                    from video as v join `session` as se on se.id = v.session_id order by v.id DESC ");

//dump($data);

if (isAdmin()) {
    ?>

    <a href="<?= getUrl() ?>video/form" class="btn">افزودن کلیپ جدید</a>

    <br><br>
    <?
}

?>


<div class="videos">
    <? foreach ($data as $item) { ?>
        <li class="col-3 col-sm-6">
            <a href="<?= getUrl() . 'video/play/' . $item['id'] ?>">
            <div>
                <i class="mdi mdi-play"></i>
            </div>
            
            <img
                src="http://www.noohoo.ir/<?= $item['thumbnail_path']; ?>"
                alt="<?= $item['title'] ?>"></a></li>
    <? } ?>

</div>


    