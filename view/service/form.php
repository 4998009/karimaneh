<?




$session = Db::getInstance()->query("select * from `session` where isService=1");

foreach ($session as $item) {

    ?>
    <h4 class="small">
        <?echo($item['title']) ?>
    </h4>
<? } ?>

<form action="<?= baseUrl() ?>/service/form" method="post" enctype="multipart/form-data">
    
    
        <select name="session_id">
        <? foreach ($session as $item){?>
            <option value="<?=$item['id']?>"><?=$item['title']?></option>
        <?}?>
    </select><br>
    
    
text:
<textarea name="text"></textarea>
<br>
 



    <input type="submit" name="submit" value="ذخیره">

</form>