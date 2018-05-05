<style>
    .gallery {
        display: flex;
        align-items: flex-start;
        justify-content: center;
        flex-flow: wrap;
    }

    .gallery li:hover .caption {
        /*display: block;*/
        transition: all 0.2s;
    }

    .caption {
        /*word-break: break-word;*/
        /*display: none;*/
        transition: all 0.2s;
    }

    .gallery li {
        background: #3e3e43;
        transition: all 0.2s;
        margin-top:0;
        width: 50%;
        text-align: center;
    }

    .gallery img {
        width: 100%;
        object-fit: cover;
        height: auto;
        transition: all 0.2s;

    }

</style>
<div class="gallery"><?
    foreach ($data as $item) {
        // var_dump($item);
        if (strpos($item->cover_path, '.jpg') !== false && strpos($item->original_image_path, '.jpg') !== false) { ?>

            <!--        onclick="preview('--><?//=$item->original_image_path;?><!--',true)"-->

            <li class="col-3 col-sm-6">
                <a href="https://www.noohoo.ir/photo/index/<?= $item->category_id ?>"> <img
                            src="<?= $item->cover_path; ?>"
                            alt="<?= $item->title; ?>">
                    <div class="caption">
                        <?= $item->title; ?>
                    </div>
                </a>
            </li>
        <?
        }
    }
    ?>


</div>