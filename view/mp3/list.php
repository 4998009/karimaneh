<style>
    .audio-action i {
        font-size: 71px !important;
    }

    .audio-action i:active {
        margin-top: 1px;
    }

    .single .flex {
        justify-content: center;
    }

    .cover {
        border-radius: 50%;
        width: 100px;
        height: 100px;
        object-fit: cover;
        transition: all .2s ease-in-out;
    }
</style>
<?

foreach ($data as $item) { ?>

    <div class="row audioBox flex">

        <div class="col-2 col-sm-12">
            <a href="<?= getUrl() . 'mp3/id/' . $item->id ?>">
                <img class="cover"
                     src="<?= $item->cover_path ?>"
                     alt="<?= $item->artist ?>">
            </a>
        </div>

        <div class="col-10 col-sm-12 audioTitle">
            <div class="row">

                <div class="col-6 col-sm-12 prl10">
                    <h3 class="margin00 titr">
                        <a href="<?= getUrl() . 'mp3/id/' . $item->id ?>">
                            <?= $item->title ?>
                        </a>
                    </h3>
                    <span class="artist"><a href="/artist/id/<?= $item->artistId ?>"><?= $item->artist ?></a></span><br>
                </div>

                <div class="col-2  col-sm-12 ">
                    <span class="type"><?= $item->type ?></span>

                </div>


                <div class="col-4 col-sm-12 ">
                    <div>
                        <div class="flex-row audio-action">

                             <span onclick="togglePlay('<?= $item->id ?>','<?= $item->download_path ?>')"
                                   class="flex btn playIcon">
                                    <i class="mdi mdi-play" id="<?= $item->id ?>"></i>
                                </span>

                            <span class="small" id="tracktime"><?= $item->length ?></span>



                            <a href="<?= $item->download_path ?>" class="flex btn">
                                <i class="mdi mdi-download"></i>
                                <span class="small"><?= $item->download_size ?></span>
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

<? }
