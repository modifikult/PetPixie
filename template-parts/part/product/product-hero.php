<?php
    $product = wc_get_product(get_the_ID());
    $taxonomy = 'product_cat';

    $amount_of_monthly_purchases = get_field('amount_of_monthly_purchases');
    $rating = get_field('rating');
    $description = $product->get_short_description();
    $product_link_amazon = get_field('product_link_amazon');
    $is_prime = get_field('is_prime');
    $prime_delivery_time = get_field('prime_delivery_time');

    $video_type = get_field('video_type');
    $video_file = get_field('video_file');
    $video_poster = get_field('video_poster');
    $video_link = get_field('video_link');
?>

<section class="product-hero">
    <div class="container">
        <div
            class="product-hero__wrap d-flex flex-column flex-md-row justify-content-between align-items-start flex-wrap">
            <div class="product-hero__content order-2 order-md-1">
                <h1 class="title">
                    <?php echo $product->get_title(); ?>
                </h1>

                <?php if ($rating || $rating === 0) : ?>
                    <?php
                    $i = 0;
                    $star = round($rating);
                    ?>

                    <div class="rating d-flex align-items-center">
                        <div class="ratings">
                            <?php while ($i < 5) : ?>
                                <i class="<?php echo $i < $rating ? 'bi bi-star-fill rating-color' : 'bi bi-star rating-color'; ?> "></i>
                                <?php $i++; ?>
                            <?php endwhile; ?>
                        </div>

                        <span class="review-count"><?php echo $rating; ?><?php _e(' outstanding'); ?></span>
                    </div>
                <?php endif; ?>

                <div class="badge-info">
                    <?php $category_ids = $product->get_category_ids(); ?>
                    <?php get_cat_terms($category_ids, $taxonomy); ?>

                    <?php if ($is_prime && $prime_delivery_time) : ?>
                        <span class="prime-delivery">
                            <img
                                src="<?php echo get_template_directory_uri() . '/public/images/logo-prime.png'; ?>"
                                alt="" class="prime-image">
                            <?php echo $prime_delivery_time; ?>
                        </span>
                    <?php endif; ?>
                </div>

                <?php if ($product->get_regular_price()) : ?>
                    <div class="price-wrapper <?php echo $product->get_sale_price() ? 'has-discount' : '';?> d-flex align-items-center flex-wrap">
                        <?php if ($product->get_sale_price()) : ?>
                            <span class="price discounted">
                                <?php echo wc_price($product->get_sale_price()); ?>
                            </span>
                        <?php endif; ?>

                        <span class="price original">
                            <?php echo wc_price($product->get_regular_price()); ?>
                        </span>

                        <?php if ($amount_of_monthly_purchases) : ?>
                            <?php $formatted_number = number_format($amount_of_monthly_purchases); ?>
                            <span class="avg-purchase">
                                Avg. <?php echo $formatted_number; ?> <?php _e('people buy every month'); ?>
                            </span>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>

                <?php if($description) :?>
                    <div class="description">
                        <?php echo $description;?>
                    </div>
                <?php endif; ?>

                <?php if ($product_link_amazon) : ?>
                    <div class="buttons d-flex flex-column">
                        <a href="<?php echo $product_link_amazon['url']; ?>" target="_blank"
                           class="btn btn-accent btn-lg">
                            <span><?php _e($product_link_amazon['title']); ?></span>
                            <i class="btn-icon bi-arrow-right"></i>
                        </a>
                    </div>
                <?php endif; ?>

            </div>
            <div class="product-hero__image gallery--slider order-1 order-md-2">
                <?php if ($product->get_gallery_image_ids()) : ?>
                    <?php $gallery_images = $product->get_gallery_image_ids(); ?>

                    <div class="product-hero__image-slider general--slider">
                        <?php foreach ($gallery_images as $idx => $image_id) : ?>
                            <?php $image_url = wp_get_attachment_image_url($image_id, 'full'); ?>
                            <div class="slider__item">
                                <img src="<?php echo $image_url; ?>" alt="<?php echo get_the_title(); ?>">

                                <?php $term_slug = 'best-seller';?>

                                <?php if(has_term($term_slug, 'product_tab', $product->get_id())) :?>
                                    <div class="product-label">
                                        <?php echo get_inline_svg('featured-label.svg'); ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        <?php endforeach; ?>
                    </div>

                    <div class="product-hero__image-slider thumbnail--slider">
                        <?php foreach ($gallery_images as $image_id) : ?>
                            <?php $image_url = wp_get_attachment_image_url($image_id, 'full'); ?>
                            <div class="slider__item">
                                <img src="<?php echo $image_url; ?>" alt="<?php echo get_the_title(); ?>">
                            </div>
                        <?php endforeach; ?>
                    </div>

                <?php else : ?>
                    <div class="product-image">
                        <img src="<?php the_post_thumbnail_url(); ?>" alt="<?php echo $product->get_title(); ?>">

                        <?php $term_slug = 'best-seller';?>

                        <?php if(has_term($term_slug, 'product_tab', $product->get_id())) :?>
                            <div class="product-label">
                                <?php echo get_inline_svg('featured-label.svg'); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>
