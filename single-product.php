<?php
    $product_id = get_the_ID();
    $product_categories = get_the_terms($product_id, 'product_cat');

    if($product_categories && !is_wp_error($product_categories)) {
        foreach ($product_categories as $product_category) {
            if ($product_category->parent > 0 && $product_category->term_id !== 56 && $product_category->name !== 'Sale') {
                $product_subcategory = get_term($product_category->term_id, 'product_cat');
            }
        }
    }
?>

<?php get_header(); ?>

<div class="main">

    <div class="page-title">
        <div class="container">
            <h2>
                <?php echo $product_subcategory->name;?>
            </h2>
        </div>
    </div>

    <?php get_template_part('template-parts/part/breadcrumbs'); ?>

    <?php get_template_part('template-parts/part/product/product-hero'); ?>

    <?php get_template_part('template-parts/part/product/content-block'); ?>

    <?php get_template_part('template-parts/part/product/video-block'); ?>

    <?php get_template_part('template-parts/part/product/product-highlights'); ?>

    <?php get_template_part('template-parts/part/product/product-features'); ?>

    <?php get_template_part('template-parts/part/product/our-likes-dislikes'); ?>

    <?php get_template_part('template-parts/part/product/customer-reviews'); ?>

    <?php get_template_part('template-parts/part/product/product-benefits'); ?>

    <?php get_template_part('template-parts/part/product/product-faq'); ?>

    <?php get_template_part('template-parts/part/product/sticky-product'); ?>

    <?php get_template_part('template-parts/part/best-seller'); ?>

    <?php get_template_part('template-parts/blocks/category_other_posts'); ?>

    <?php get_template_part('template-parts/blocks/blog_posts'); ?>

    <?php get_template_part('template-parts/blocks/categories_grid'); ?>

    <?php get_template_part('template-parts/blocks/social_cta'); ?>
</div>

<?php get_footer(); ?>
