<?php get_header() ?>

<main class="l-main">
    <div class="l-inner">
        <?php get_template_part('temple-parts/breadcrumbs'); ?>
        <?php
        if (have_posts()) : ?>
            <h1>カテゴリー：<?php single_cat_title(); ?></h1>

            <?php while (have_posts()) : the_post(); ?>
                <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

                    <h2><a href="<?php the_permalink(); ?>"><?php echo get_the_title(); ?></a></h2>

                    <div class="post-meta">
                        <span class="post-date"><?php echo get_the_date(); ?></span>
                        <span class="category">カテゴリー : <?php the_category(', ') ?></span>
                        <span class="comment-num"><?php comments_popup_link('コメント : 0', 'コメント : 1', 'コメント : %'); ?></span>
                    </div>

                    <?php the_content('…[続きを読む]'); ?>

                </div>
            <?php
            endwhile;

            if (function_exists('wp_page_numbers')) : wp_page_numbers();
            endif; else : ?>
            <h1>記事はありません</h1>
            <p>お探しの記事は見つかりませんでした。</p>
        <?php
        endif;
        ?>
    </div>

    <div class="pagenation">
        <?php get_template_part('temple-parts/pager'); ?>
    </div>

    </div>
</main>
<?php get_footer() ?>