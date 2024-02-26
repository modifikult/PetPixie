<?php
    /**
     * The template for displaying product content within loops
     *
     * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
     *
     * HOWEVER, on occasion WooCommerce will need to update template files and you
     * (the theme developer) will need to copy the new files to your theme to
     * maintain compatibility. We try to do this as little as possible, but it does
     * happen. When this occurs the version of the template file will be bumped and
     * the readme will list any important changes.
     *
     * @see     https://docs.woocommerce.com/document/template-structure/
     * @package WooCommerce\Templates
     * @version 3.6.0
     */

    defined('ABSPATH') || exit;

    global $product;

    // Ensure visibility.
    if (empty($product) || !$product->is_visible()) {
        return;
    }

    $taxonomy = 'product_cat';

//    $our_likes = get_field('our_likes');
//    $our_dislikes = get_field('our_dislikes');
    $amount_of_monthly_purchases = get_field('amount_of_monthly_purchases');
    $rating = get_field('rating');
    $description = $product->get_short_description();
    $product_link_amazon = get_field('product_link_amazon');
    $is_prime = get_field('is_prime');
    $prime_delivery_time = get_field('prime_delivery_time');
?>

<li <?php wc_product_class('col-12 col-md-6 col-lg-4', $product); ?>>
    <div class="card card-product">
        <div class="card-image-wrapper text-center">
            <div class="product-image">
                <a href="<?php echo $product->get_permalink(); ?>">
                    <img
                        src="<?php the_post_thumbnail_url(); ?>"
                        alt="<?php echo $product->get_title(); ?>"
                        class="card-image"
                    >
                </a>
            </div>

            <?php $term_slug = 'best-seller';?>

            <?php if(has_term($term_slug, 'product_tab', get_the_ID())) :?>
                <div class="product-label">
                    <?php echo get_inline_svg('featured-label.svg'); ?>
                </div>
            <?php endif; ?>
        </div>
        <div class="card-content">
            <div class="card-badge-info">
                <?php $category_ids = $product->get_category_ids();?>
                <?php get_cat_terms($category_ids, $taxonomy);?>

                <?php if ($is_prime && $prime_delivery_time) : ?>

                    <span class="prime-delivery">
                        <img src="<?php echo get_template_directory_uri(); ?>/public/images/logo-prime.png"
                             alt="" class="prime-image">
                        <?php echo $prime_delivery_time; ?>
                    </span>

                <?php endif; ?>

            </div>

            <?php if ($product->get_title()) : ?>
                <h3 class="card-title">
                    <a href="<?php echo $product->get_permalink(); ?>">
                        <?php echo $product->get_title(); ?>
                    </a>
                </h3>
            <?php endif; ?>

            <?php if ($rating || $rating === 0) : ?>
                <?php
                $i = 0;
                $star = round($rating);
                ?>

                <div class="card-rating d-flex align-items-center">
                    <div class="ratings">
                        <?php while ($i < 5) : ?>
                            <i class="<?php echo $i < $rating ? 'bi bi-star-fill rating-color' : 'bi bi-star rating-color'; ?> "></i>
                            <?php $i++; ?>
                        <?php endwhile; ?>
                    </div>

                    <span class="review-count"><?php echo $rating; ?><?php _e(' outstanding'); ?></span>
                </div>
            <?php endif; ?>

            <?php if ($product->get_regular_price()) : ?>
                <div class="card-price-wrapper <?php echo $product->get_sale_price() ? 'has-discount' : ''; ?> d-flex align-items-center flex-wrap">
                    <?php if ($product->get_sale_price()) : ?>
                        <span class="card-price discounted">
                            <?php echo wc_price($product->get_sale_price()); ?>
                        </span>
                    <?php endif; ?>

                        <span class="card-price original">
                            <?php echo wc_price($product->get_regular_price()); ?>
                        </span>

                    <?php if ($amount_of_monthly_purchases) : ?>
                        <?php $formatted_number = number_format($amount_of_monthly_purchases); ?>
                        <span class="card-avg-purhcase w-100">
                            Avg. <?php echo $formatted_number; ?> <?php _e('people buy every month'); ?>
                        </span>
                    <?php endif; ?>
                </div>
            <?php endif; ?>

            <?php if($description) :?>
                <div class="card-description">
                    <?php echo $description;?>
                </div>
            <?php endif; ?>

            <div class="card-btn d-flex flex-column">
                <?php if ($product_link_amazon) : ?>
                    <a href="<?php echo $product_link_amazon['url']; ?>" target="_blank"
                       class="btn btn-accent btn-md"><?php _e($product_link_amazon['title']); ?></a>
                    <a href="<?php echo $product->get_permalink(); ?>"
                       class="btn btn-outline-dark btn-md"><?php _e('More Detail'); ?></a>
                <?php endif; ?>
            </div>
        </div>

    </div>
</li>
