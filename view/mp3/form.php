<?

$artists = Db::getInstance()->query("select * from `artist`");
$types = Db::getInstance()->query("select * from `type`");
$categories = Db::getInstance()->query("select id,title from `category`");

?>

<form action="<?= baseUrl() ?>/mp3/form" method="post" enctype="multipart/form-data">

    <input type="text" name="title" placeholder="عنوان"><br>
    <select name="artist">
        <? foreach ($artists as $item){?>
            <option value="<?=$item['id']?>"><?=$item['fullname']?></option>
        <?}?>
    </select><br>

    <select name="type">
        <? foreach ($types as $item){?>
            <option value="<?=$item['id']?>"><?=$item['title']?></option>
        <?}?>
    </select>
    <br>
    
      <select name="category[]" multiple>
        <? foreach ($categories as $category){?>
            <option value="<?=$category['id']?>"><?=$category['title']?></option>
        <?}?>
    </select>
    <br>
<?
$sessions = Db::getInstance()->query("select `id`, `title` from `session` ORDER by id desc");
?>
    <select name="session">
        <? foreach ($sessions as $item){?>
        <option value="<?=$item['id']?>"><?=$item['title']?></option>
        <?}?>
    </select>
    <br>
    mp3:
    <input type="file" name="sound">
    <br>
    cover:
    <input type="file" name="cover">

    <br>

    <input type="submit" class="blue_bg" name="submit" value="ذخیره">
</form>
