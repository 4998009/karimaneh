<?
$isset_cat = Db::getInstance()->query("select distinct category_id from `sound` where category_id is not null ");

// foreach($isset_cat as $item){
//     //$ex = explode(",", $item);
//     $check = $item['category_id'];
// }
$cats = Db::getInstance()->query("select * from `category`  ORDER BY id ");


$c = Db::getInstance()->query("SELECT category_id FROM `sound` where category_id is not null");

$pageTitle = "هیئت عاشورائیان";
if (isset($artist)) {
    $pageTitle = $artist;
    $meta = $artist;
}


$arr = array();
foreach ($c as $item) {
    $arr[] = explode(",", $item['category_id']);
}


$result = array();

foreach ($arr as $item) {

    foreach ($item as $a) {
        if (!empty($a))
            $result[] = $a;

    }
}


//dump($result);
$aaa = array_unique($result);
$sql = Db::getInstance()->query('SELECT * 
          FROM `category` 
         WHERE `id` IN (' . implode(',', array_map('intval', $aaa)) . ')');


$menu = array();
foreach ($sql as $item) {
    $menu[] = "<li class='tag'><a href='/archive/category/" . $item['id'] . "'>" . $item['title'] . "</a></li>";

}


if (isset($dataArtist)) {
    $data = $dataArtist;
}


if (isset($menu)) {
    echo "<div class='row tags'>";
    // echo "  <hr>";
    foreach ($menu as $item) {
        echo $item;
    }
    echo "</div><br>";
}


?>

<div class="mp3-container row">
    <?
    foreach ($records as $item) { ?>
        <div class="row audioBox flex">

            <div class="col-2 col-sm-12">
                <a href="<?= getUrl() . 'mp3/id/' . $item['id'] ?>">
                    <img class="cover"
                         src="<?= getUrl() . $item['thumbnail_path'] ?>"
                         alt="<?= $item['artist'] ?>">
                </a>
            </div>

            <div class="col-10 col-sm-12 audioTitle">
                <div class="row">

                    <div class="col-6 col-sm-12 prl10">
                        <h3 class="margin00 titr">
                            <a href="<?= getUrl() . 'mp3/id/' . $item['id'] ?>">
                                <?= $item['title'] ?>
                            </a>
                        </h3>
                        <span class="artist"><a
                                    href="/artist/id/<?= $item['artistId'] ?>"><?= $item['artist'] ?></a></span><br>
                    </div>

                    <div class="col-2  col-sm-12 ">
                        <span class="type"><?= $item['type'] ?></span>

                    </div>


                    <div class="col-4 col-sm-12 ">
                        <div>
                            <div class="flex-row audio-action">

                                <span onclick="togglePlay('<?= $item['id'] ?>','https://www.noohoo.ir/<?= $item['download_path'] ?>')"
                                      class="flex btn playIcon">
                                    <i class="mdi mdi-play" id="<?= $item['id'] ?>"></i>
                                </span>

                                <span class="small" id="tracktime"><?= $item['length'] ?></span>



                                <a href="https://www.noohoo.ir/<?= $item['download_path'] ?>" class="flex btn" download>
                                    <i class="mdi mdi-download"></i>
                                    <span class="small"><?= $item['download_size'] ?></span>
                                </a>
                                <!--<a href="#" class="flex">-->
                                <!--    <i class="material-icons">favorite_border</i>-->
                                <!--</a>-->


                            </div>
                        </div>

                    </div>


                </div>

            </div>

        </div>


    <? } ?>


</div>
<br>
<div class="paging">
    <?
    if (isset($artist))
        echo pagination('/artist/id/' . $id, 2, 'btn-gray', 'btn-gray btn-red', $pageIndex, $pageCount);
    else
        echo pagination('/archive/index', 2, 'btn-gray', 'btn-gray btn-red', $pageIndex, $pageCount); ?>
</div>

