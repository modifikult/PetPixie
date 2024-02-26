<?php
    $taxonomy = 'product_cat';
    $category = get_queried_object();

    $cat_id = $category->term_id;
    $cat_children = get_term_children($cat_id, $taxonomy);
?>

<?php get_header();
?>


<?php if (is_woocommerce()) :

    $category = get_queried_object();
    $category_name = $category->name;
    ?>

    <div class="main">
        <?php get_template_part('template-parts/part/page-hero'); ?>

        <?php get_template_part('template-parts/part/best-seller'); ?>

        <?php if (!$cat_children && $category_name !== 'Sale') : ?>
            <?php get_template_part('template-parts/part/category/category_tab'); ?>
        <?php else : ?>
            <?php get_template_part('template-parts/part/category/category'); ?>
        <?php endif; ?>

        <?php if ($category_name === 'Sale') : ?>
            <?php get_template_part('template-parts/part/products'); ?>

            <?php get_template_part('template-parts/blocks/categories_grid'); ?>

            <?php get_template_part('template-parts/blocks/social_cta'); ?>
        <?php endif; ?>

        <?php if (have_rows('global_blocks')) : ?>
            <?php while (have_rows('global_blocks')) : the_row() ?>
                <?php get_template_part('template-parts/blocks/' . get_row_layout()); ?>
            <?php endwhile; ?>
        <?php else : ?>

        <?php endif; ?>

    </div>
<?php else : ?>

<?php endif; ?>

<?php get_footer(); ?>


