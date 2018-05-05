دسته ها
<? $categories = Db::getInstance()->all('category');

$categories_type = Db::getInstance()->all('categoryType');

foreach ($categories as $item) {

    ?>
    <h4 class="small">
        <?=$item['title'] ?>
    </h4>
<? } ?>

<form action="<?= baseUrl() ?>/archive/category_form" method="post">

    <input type="text" name="title" placeholder="عنوان"><br>
<select name="categoryTypeId">
<? foreach($categories_type as $t){?>
     <option value="<?=$t['id']?>"><?=$t['title']?></option>
     <?}?>
</select>

 

    <input type="submit" name="submit" value="ذخیره">

</form>