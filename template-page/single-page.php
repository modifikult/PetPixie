<?php
    // Template Name: Single Page
    // Template Post Type: Page
?>

<?php get_header(); ?>

<div class="main">
    <div class="page-title">
        <div class="container">
            <h2>
                <?php the_title(); ?>
            </h2>
        </div>
    </div>

    <?php if( function_exists( 'aioseo_breadcrumbs' ) ) : ?>
        <div class="breadcrumbs">
            <div class="container">
                <div class="breadcrumbs__wrap">
                    <?php aioseo_breadcrumbs();?>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <?php get_template_part('template-parts/part/post-hero'); ?>

    <?php if (have_rows('building_blocks')) : ?>
        <?php while (have_rows('building_blocks')) : the_row() ?>
            <?php get_template_part('template-parts/blocks/' . get_row_layout()); ?>
        <?php endwhile; ?>
    <?php endif; ?>
</div>

<?php get_footer(); ?>
