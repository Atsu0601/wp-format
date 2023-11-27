<?php get_header() ?>

<main class="l-main">
<div class="l-inner">
<?php get_template_part('temple-parts/breadcrumbs'); ?>
  <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
      <h1><?php the_title() ?></h1>
      <?php the_content() ?>
  <?php endwhile;
  endif; ?>
</div>
</main>

<?php get_footer() ?>
