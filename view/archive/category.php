<?
$isset_cat = Db::getInstance()->query("select distinct category_id from `sound` where category_id is not null ");

$cats = Db::getInstance()->query("select * from `category`  ORDER BY id ");


foreach ($cats as $item) {
    if ($item['id'] == $id)
        $pageTitle = 'آرشیو- ' . $item['title'] . ' | هیئت عاشورائیان';

}

$c = Db::getInstance()->query("SELECT category_id FROM `sound` where category_id is not null");


$arr = array();
foreach ($c as $item) {
    $arr[] = explode(",", $item['category_id']);
}

$result = array();
foreach ($arr as $item) {
    foreach ($item as $a) {
        if ($a == null)
            continue;
        if ($a == "")
            continue;
        $result[] = $a;
    }
}
$aaa = array_unique($result);
$sql = Db::getInstance()->query('SELECT * 
          FROM `category` 
         WHERE `id` IN (' . implode(',', array_map('intval', $aaa)) . ')');


$menu = array();
foreach ($sql as $item) {
    $menu[] = "<li class='tag'><a href='/archive/category/" . $item['id'] . "'>" . $item['title'] . "</a></li>";

}

$data = Db::getInstance()->query("select  so.id, so.title,
so.length,
so.download_path,
so.like,
so.download_number,
so.download_size,
so.cover_path,
so.thumbnail_path,
so.original_image_path,
so.selected,
a.fullname AS artist,
t.title as type

from `sound` as so 
JOIN `type` as t on t.id = so.type
join `artist` as a on a.id = so.artist_id
where find_in_set('$id',`category_id`) <> 0
");

if (isset($menu)) {
    echo "  <hr>";
    foreach ($menu as $item) {
        echo $item;
    }
}
echo "<br>";

foreach ($data as $item) { ?>
    <div class="row audioBox flex">

        <div class="col-2">
            <a href="<?= getUrl() . 'mp3/id/' . $item['id'] ?>">
                <img class="cover"
                     src="<?= getUrl() . $item['thumbnail_path'] ?>"
                     alt="<?= $item['artist'] ?>">
            </a>
        </div>

        <div class="col-10 audioTitle">
            <div class="row">

                <div class="col-6 prl10">
                    <h3 class="margin00 titr">
                        <?= $item['title'] ?>
                    </h3>
                    <span class="artist"><?= $item['artist'] ?></span><br>
                </div>

                <div class="col-2">
                    <span class="type"><?= $item['type'] ?></span>

                </div>


                <div class="col-4">
                    <div>
                        <div class="flex audio-action">


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




