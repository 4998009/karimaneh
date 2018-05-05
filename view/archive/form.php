<?
$data = Db::getInstance()->all('category');



?>


<br><br><hr>

<form action="<?= baseUrl() ?>/archive/form" method="post" enctype="multipart/form-data">


    <select name="category[]" multiple>
        <? foreach ($data as $item){?>
            <option value="<?=$item['id']?>"><?=$item['title']?></option>
        <?}?>
    </select>
    <br>
    
    <input type="text" name="title" placeholder="عنوان"><br>
    <input type="text" name="desc" placeholder="توضیحات"><br>
    <input type="number" name="date" placeholder="تاریخ به عدد"><br>

    cover:
    <input type="file" name="cover">
    <br>
    has gallery:
    <select name="has_gallery">
        <option value="0">خیر</option>
        <option value="1">بله</option>
    </select>

    <input type="submit" name="submit" value="ذخیره">

</form>