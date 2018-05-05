<? $data = Db::getInstance()->all('type');
foreach ($data as $item) {

    ?>
    <h4 class="small">
        <?echo($item['title']) ?>
    </h4>
<? } ?>

<form action="<?= baseUrl() ?>/mp3/type_form" method="post" enctype="multipart/form-data">

    <input type="text" name="title" placeholder="نام"><br>


    <input type="submit" name="submit" value="ذخیره">

</form>