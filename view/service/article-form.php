
<form action="<?= baseUrl() ?>/service/article" method="post" enctype="multipart/form-data">

    <input type="text" name="title" placeholder="عنوان"><br>
     
 <textarea  name="description" placeholder="توضیحات" rows="10"></textarea>
   
     <br>

    cover:
    <input type="file" name="cover">

    <br>

    <input type="submit" class="blue_bg" name="submit" value="ذخیره">
</form> 