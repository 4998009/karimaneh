<style>
    .gallery {
        display: flex;
        align-items: flex-start;
        justify-content: center;
        flex-flow: wrap;
    }

    .gallery li:hover .caption {
        /*display: block;*/
    }

    .caption {
        /*word-break: break-word;*/
        display: none;
    }

    .gallery li {
        background: #3e3e43;

    }

    .gallery img {
        width: 100%;
        object-fit: cover;
        height: 140px;
        height: 30vh;
    }

</style>
<?
echo "<h2>" . $data[0]->title . "</h2>";
$keywords = str_replace(' ',',', $data[0]->description);
$meta = 'تصاویر '. $data[0]->title . '_' . $data[0]->description;
$pageTitle = $data[0]->title;
$description = 'هیئت عاشورائیان زنجان | وارثان شهدا';
?>

<div class="gallery"><?


    foreach ($data as $item) {
        // var_dump($item);
        if (strpos($item->cover_path, '.jpg') !== false && strpos($item->original_image_path, '.jpg') !== false) { ?>


            <li class="col-3 col-sm-6" onclick="preview('<?= $item->original_image_path; ?>',true)">
                <img
                        src="<?= $item->cover_path; ?>"
                        alt="<?= $item->description; ?>">
                <div class="caption">
                    <?= $item->title; ?>
                </div>

            </li>
            <?
        }
    }
    ?>


</div>


<?
//$meta = $data[0]->description;
echo "<p class='desc'>" . $data[0]->description . "</p>";
?>