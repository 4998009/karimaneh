<?

$data = Db::getInstance()->query("select `text` from serviceBlog where service_id = 1; ");

$services = Db::getInstance()->query("select * from `service orderBy id DESC`");

foreach ($data as $item) {

    ?>
    <h4 class="small">
        <?echo($item['text']) ?>
    </h4>
<? } ?>

<form action="<?= baseUrl() ?>/blog/form" method="post" enctype="multipart/form-data">

    <select name="artist">
        <? 
        foreach ($services as $item) { ?>
        
            <option value="<?=$item['id']?>"><?=$item['title']?></option>
            
        <? } ?>
    </select><br>

   <textarea rows="4" cols="50" name="text">
 
</textarea>


    <input type="submit" name="submit" value="ذخیره">

</form>