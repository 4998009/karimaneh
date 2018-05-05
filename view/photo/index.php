<?php
$db = Db::getInstance();
$AAA = $db->query("SELECT * FROM `session` WHERE id IN(SELECT DISTINCT session_id FROM `images`)");
$data = $db->query("select p.title,p.thumbnail_path,p.main_path,se.title,se.date  from images as p join `session` as se on se.id = p.session_id order by p.id DESC ");
if (isAdmin()) {
    ?>

    <a href="<?= getUrl() ?>photo/form" class="btn">افزودن تصاویر جدید</a>

    <br><br>
    <?
}

?>


<div class="gallery">
 
    
       <? foreach ($AAA as $item) { ?>
        <li class="col-3 col-sm-6">
            <a href="http://www.noohoo.ir/photo/detail/<?=$item['id']?>">
            <img
                src="http://www.noohoo.ir/<?= $item['thumbnail_path']; ?>"
                alt="<?= $item['title'] ?>">
                </a></li>
    <? } ?>
    
    


</div>


    