<?php
    // Template Name: Sale Page
    // Template Post Type: page
?>

<?php get_header(); ?>

<div class="main">
    <?php get_template_part('template-parts/part/page-hero'); ?>

    <?php get_template_part('template-parts/part/best-seller'); ?>

    <?php get_template_part('template-parts/part/category/category'); ?>

    <?php if (have_rows('global_blocks')) : ?>
        <?php while (have_rows('global_blocks')) : the_row() ?>
            <?php get_template_part('template-parts/blocks/' . get_row_layout()); ?>
        <?php endwhile; ?>
    <?php else : ?>

    <?php endif; ?>

</div>

<?php get_footer(); ?>
