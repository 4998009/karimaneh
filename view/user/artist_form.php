<? $data = Db::getInstance()->all('artist');
foreach ($data as $item) {

    ?>
    <h4 class="small">
        <?echo($item['fullname']) ?>
    </h4>
<? } ?>

<form action="<?= baseUrl() ?>/user/artist_form" method="post" enctype="multipart/form-data">

    <input type="text" name="title" placeholder="نام"><br>


    <input type="submit" name="submit" value="ذخیره">

</form>