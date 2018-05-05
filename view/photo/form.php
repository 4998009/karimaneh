 

<form action="<?= baseUrl() ?>/photo/form" method="post" enctype="multipart/form-data">
    Send these files:<br/>
    <?
    $sessions = Db::getInstance()->query("select `id`, `title` from `session` ORDER by id desc");
    ?>
    <select name="session">
        <? foreach ($sessions as $item){?>
            <option value="<?=$item['id']?>"><?=$item['title']?></option>
        <?}?>
    </select>
    <br>
    <input name="images[]" type="file" multiple><br/><br>
    <input type="submit" name="submit" class="bg-primary" value="ذخیره"/>
</form>