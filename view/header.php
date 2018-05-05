<!DOCTYPE html>
<html>
<head>


    <meta charset="UTF-8">
    <meta name="robots" content="index, follow">


    <?

    if (isset($keywords)) {

        echo '<meta name="keywords" content="' . $keywords . '">';

    } else {
        echo '<meta name="keywords" content="">';
    }


    if (isset($meta)) {
        echo '<meta name="description" content="' . $meta . '">';

    } else
        echo '<meta name="description" content="">';

    if (isset($metaog))
        echo $metaog;
    ?>


    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


    <title>
        <?
        if (isset($pageTitle))
            echo $pageTitle;
        else
            pageTitle();
        ?>
    </title>


    <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
    <link rel="stylesheet" href="<?= baseUrl() ?>/assets/fonts/fonts/material-icons.css">
    <?

    if (isset($header))
        foreach ($header as $item)
            echo $item;
    ?>


    <meta name="theme-color" content="#111">
    <meta name="msapplication-navbutton-color" content="#111">
    <meta name="apple-mobile-web-app-status-bar-style" content="#111">

    <link rel="stylesheet" href="<?= baseUrl() ?>/assets/css/bootstrap-grid.css">
    <link rel="stylesheet" href="<?= baseUrl() ?>/assets/font.css">
    <link rel="stylesheet" href="<?= baseUrl() ?>/assets/css/style.css">


    <!--    components-css-->
    <link rel="stylesheet" href="<?= baseUrl() ?>/view/nav/style.css">
    <link rel="stylesheet" href="<?= baseUrl() ?>/view/slideshow/style.css">
    <link rel="stylesheet" href="<?= baseUrl() ?>/view/filter-box/style.css">


</head>
<body>
<div class="container">

    <? require_once(getcwd() . '/view/nav/index.php'); ?>
    <? require_once(getcwd() . '/view/slideshow/index.php'); ?>
    <? require_once(getcwd() . '/view/filter-box/index.php'); ?>
    <? require_once(getcwd() . '/view/master.php'); ?>
</div>

</body>


</html>

