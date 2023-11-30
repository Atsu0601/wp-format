<?php get_header() ?>

<main class="l-main">
    <div class="l-inner">
        <?php get_template_part('temple-parts/breadcrumbs'); ?>

        <div class="">
            <?php get_search_form(); ?>

            <?php if (have_posts()) : ?>
                <?php if (isset($_GET['s']) && empty($_GET['s'])) : ?>
                    <p>検索キーワードが未入力です。</p>
                <?php else : ?>
                    <p>“<?php echo $_GET['s']; ?>”の検索結果：<?php echo $wp_query->found_posts; ?>件</p>
                <?php endif; ?>

                <ul class="">
                    <?php while (have_posts()) : the_post(); ?>
                        <li class="__lists">
                            <a href="<?php the_permalink(); ?>">
                                <div class="">
                                    <?php
                                    // サムネイルが設定されているかを確認
                                    if (has_post_thumbnail()) {
                                        the_post_thumbnail('large');
                                    } else {
                                        // サムネイルが設定されていない場合、カスタマイザーで設定された画像を表示
                                        $noimage_url = get_theme_mod('noimage_img_input');
                                        if ($noimage_url) {
                                            echo '<img src="' . esc_url($noimage_url) . '" alt="No Image">';
                                        }
                                    }
                                    ?>
                                </div>
                                <h3 class="">
                                    <?php
                                    if (mb_strlen($post->post_title, 'UTF-8') > 20) {
                                        $title = mb_substr($post->post_title, 0, 20, 'UTF-8');
                                        echo $title . '……';
                                    } else {
                                        echo $post->post_title;
                                    }
                                    ?>
                                </h3>
                                <time class=""><?php the_time("Y/m/d"); ?></time>
                                <div class="">
                                    <?php
                                    $terms = get_the_terms($post->ID, 'blog-cat');
                                    foreach ($terms as $term) {
                                        echo '<span>' . $term->name . '</span>';
                                    }
                                    ?>
                                </div>
                                <p class="">
                                    <?php
                                    if (mb_strlen($post->post_content, 'UTF-8') > 55) {
                                        $content = str_replace('\n', '', mb_substr(strip_tags($post->post_content), 0, 55, 'UTF-8'));
                                        echo $content . '…';
                                    } else {
                                        echo str_replace('\n', '', strip_tags($post->post_content));
                                    }
                                    ?>
                                </p>
                            </a>
                        </li>
                    <?php endwhile; ?>
                </ul>
            <?php else : ?>
                <p>検索されたキーワードに該当する記事はありませんでした</p>
            <?php endif; ?>

            <div class="l-pagenation">
                <?php get_template_part('temple-parts/pager'); ?>
            </div>
        </div>
    </div>
</main>

<?php get_footer() ?>