<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
    <meta name="keywords" content="">
    <meta name="format-detection" content="telephone=no" />
    <title><?php echo trim(wp_title('', false));
            if (wp_title('', false)) {
                echo '｜';
            }
            bloginfo('description'); ?></title>
    <?php if (is_single()) : ?>
        <?php if ($post->post_excerpt) { ?>
            <meta name="description" content="<? echo $post->post_excerpt; ?>" />
        <?php } else {
            $summary = strip_tags($post->post_content);
            $summary = str_replace("\n", "", $summary);
            $summary = mb_substr($summary, 0, 120) . "…"; ?>
            <meta name="description" content="<?php echo $summary; ?>" />
        <?php } ?>
    <?php elseif (is_home() || is_front_page()) : ?>
        <meta name="description" content="<?php bloginfo('description'); ?>" />
    <?php else : ?>
        <meta name="description" content="<?php the_excerpt(); ?>" />
    <?php endif; ?>
    <!-- アイコン -->
    <link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri() ?>/assets/images/common/favicon.ico" />
    <link rel="apple-touch-icon-precomposed" href="<?php echo get_stylesheet_directory_uri() ?>/assets/images/common/apple-touch-icon.png"/>

    <script src="<?php echo get_stylesheet_directory_uri() ?>/assets/js/jquery.min.js"></script>
    <link href="<?php echo get_stylesheet_uri(); ?>" rel="stylesheet">
    <link href="<?php echo get_stylesheet_directory_uri() ?>/assets/css/style.css" rel="stylesheet">
    <script src="<?php echo get_stylesheet_directory_uri() ?>/assets/js/script.js"></script>
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <?php wp_body_open(); ?>

    <header class="l-header">
        <div class="l-inner"></div>
    </header>