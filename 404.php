<?php get_header(); ?>

<main class="l-main">
	<div class="l-inner">
    <?php get_template_part('temple-parts/breadcrumbs'); ?>
		<div class="p-error">
			<h2 class="p-error__ttl">404</h2>
			<p class="p-error__txt">お探しのページは見つかりませんでした。</p>
			<a href="<?php echo esc_url(home_url('/')); ?>">TOPへ戻る</a>
		</div>
	</div>
    </main>
<?php get_footer(); ?>