<form action="<?= baseUrl() ?>/index/nextSession" method="post" enctype="multipart/form-data">

    <input type="text" name="title" placeholder="عنوان"><br>
   
   <textarea name="content"></textarea>
    <br>
        <input type="text" name="date" placeholder="تاریخ"><br>
    <br>
    cover:
    <input type="file" name="cover">

    <br>

    <input type="submit" class="blue_bg" name="submit" value="ذخیره">
</form>