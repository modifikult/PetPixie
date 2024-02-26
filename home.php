<?php get_header(); ?>

<div class="main">

    <div class="page-title">
        <div class="container">
            <h1>
                <?php echo _e('Pet Pixies ') . get_the_title(get_option('page_for_posts'));?>
            </h1>
        </div>
    </div>

    <?php get_template_part('template-parts/part/breadcrumbs') ?>

    <?php get_template_part('template-parts/part/blog/blog_hero') ?>

    <?php get_template_part('template-parts/part/blog/blog_categories') ?>


    <?php if (have_rows('global_blocks', get_option('page_for_posts'))) : ?>
        <?php while (have_rows('global_blocks', get_option('page_for_posts'))) : the_row() ?>
            <?php get_template_part('template-parts/blocks/' . get_row_layout()); ?>
        <?php endwhile; ?>
    <?php else : ?>

    <?php endif; ?>
</div>

<?php get_footer(); ?>
