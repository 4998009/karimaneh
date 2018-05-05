<form action="<?= baseUrl() ?>/video/form" method="post" enctype="multipart/form-data">
    <input type="text" name="title" placeholder="عنوان"><br>
    <?
    $sessions = Db::getInstance()->query("select `id`, `title` from `session` ORDER by id desc");
    ?>
    <select name="session">
        <? foreach ($sessions as $item) { ?>
            <option value="<?= $item['id'] ?>"><?= $item['title'] ?></option>
        <? } ?>
    </select>
    <br>
    <input type="file" name="video">
    <input type="submit" name="submit">
</form>