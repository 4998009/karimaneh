<?
foreach ($posts as $item){
    ?>

    <div class="row box">
        <div class="col-md-2 col-sm-12 divImg">
            <img class="imgConver" src="<?= baseUrl() . '/' . $item['imgUrl'] ?>" alt="<?=$item['title'] ?>">
        </div>
        <div class="col-md-6 col-sm-10">
            <h2> <?=$item['title'] ?></h2>

            <p class="summary"><?=$item['summary'] ?></p>
            <div class="postInfo">
                <?
                //                $db = Db::getInstance();
                //                $db->query("select title from categories ")
                ?>

                <small class="ml-3">دسته:   <b><a href="<?= baseUrl() . '/mp3/category/' . $item['category_id'] ?>">
                            #<?=$item['sound_cat'] ?>
                        </a></b></small>
                <small class="ml-3">زمان   <?=$item['regTime'] ?></small>
                <small>تاریخ   <?=$item['regDate'] ?></small>
                <!--                <a href="--><?//= baseUrl() . '/blog/detail/' . $item['id'] ?><!--">ادامه</a>-->

            </div>

        </div>
        <div class="col-md-4 col-sm-10">
            <audio controls preload="metadata">
                <source src="<?=baseUrl() . '/'. $item['filename']?>" type="audio/mpeg">
                Your browser does not support the audio element.
            </audio>
        </div>
    </div>
    <br>
    <?
} ?>


