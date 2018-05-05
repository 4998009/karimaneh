<style>
    .audio-action i {
        font-size: 60px !important;
    }

    .single .flex {
        justify-content: center;
        font-size: x-large;
    }
</style>
<?
$meta = $data['title'] . ' | ' . $data['artist'];
$keywork = $data['title'] . ',' . $data['artist'] . ',' . 'مداحی' . ',' . 'هیئت عاشورائیان' . ',' . 'دانلود' . ',' . 'زنجان';
$title = $data['title'];
$img = getUrl() . $data['cover_path'];
$audio = getUrl() . $data['download_path'];
$metaog = '<meta property="og:image" content="' . $img . '" /><meta property="og:audio" content="' . $audio . '" /><meta property="og:title" content="' . $title . '" />';
$pageTitle = $data['title'] . ' | ' . $data['artist'];
?>
<div class="row single">
    <div class="col-3">


    </div>
    <div class="col-6" style="text-align:center">


        <h3 class="margin00">
            <bold>
                <?= $data['title'] ?>
            </bold>
        </h3>
        <h3 class="artist"><?= $data['artist'] ?></h3>
        <span class="type"><?= $data['type'] ?></span>
        <hr>

        <img class="cover" src="<? echo getUrl() . $data['cover_path'] ?>" alt="<?= $data['artist'] ?>">
    </div>
    <!------------------------------------>

    <div class="row audioBox flex">


        <div class="col-12 audioTitle">
            <div class="row">


                <div class="col-12">
                    <div>
                        <div class="flex audio-action">

                              <span onclick="togglePlay('<?= $data['id'] ?>','https://www.noohoo.ir/<?= $data['download_path'] ?>')"
                                    class="flex btn playIcon">
                                    <i class="mdi mdi-play" id="<?= $data['id'] ?>"></i>
                                </span>
                            <span id="tracktime"><?= $data['length'] ?></span>


                            <a href="https://www.noohoo.ir/<?= $data['download_path'] ?>" class="flex btn">
                                <i class="mdi mdi-download"></i>
                                <span><?= $data['download_size'] ?></span>
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


    <!--------------------------------- -->

    <div class="col-3"></div>
</div>


