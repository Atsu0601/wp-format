<?php get_header(); ?>

<main class="l-main">
<div class="l-inner">
<?php get_template_part('temple-parts/breadcrumbs'); ?>
    <h1><?php the_title(); ?></h1>
    <?php if(have_posts()): ?>
        <?php while(have_posts()): the_post(); ?>
            <?php the_content(); ?>
        <?php endwhile; ?>
    <?php else: ?>
        <p>お探しの記事は見つかりませんでした。<br />
        <?php endif; ?>

        <div class="next_prev_post">
            <?php if (get_next_post()):?>
                <?php previous_post_link('&laquo; %link', '前の記事へ'); ?>
            <?php endif; ?>
            <?php if (get_previous_post()):?>
                <?php next_post_link('%link &raquo;', '次の記事へ'); ?>
            <?php endif; ?>
        </div>
    </div>
</main>

<?php get_footer(); ?>
