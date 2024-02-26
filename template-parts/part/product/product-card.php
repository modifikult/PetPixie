<?php
    global $product;

    $taxonomy = 'product_cat';

    if (is_singular('post') || is_page_template('template-page/single-page.php')) {
        $id = get_sub_field('product');
        $product = wc_get_product($id);
    } else {
        $id = get_the_ID();
    }

    $amount_of_monthly_purchases = get_field('amount_of_monthly_purchases', $id);
    $rating = get_field('rating', $id);
    $description = $product->get_short_description();
    $product_link_amazon = get_field('product_link_amazon', $id);
    $is_prime = get_field('is_prime', $id);
    $prime_delivery_time = get_field('prime_delivery_time', $id);

    $product_class = '';
    $gallery_show = false;
    $product_wrap_class = '';

    if (isset($args['gallery_show'])) {
        $gallery_show = $args['gallery_show'];

        if ($gallery_show) {
            $video_type = get_field('video_type');
            $video_file = get_field('video_file');
            $video_poster = get_field('video_poster');
            $video_link = get_field('video_link');
        }
    }
    if (isset($args['product_class'])) {
        $product_class = $args['product_class'];
    }
    if (isset($args['product_wrap_class'])) {
        $product_wrap_class = $args['product_wrap_class'];
    }
?>

<div <?php wc_product_class($product_class, $product); ?>>
    <div class="card card-product <?php echo $product_wrap_class; ?>">
        <div class="card-image-wrapper gallery--slider">
            <?php if ($product->get_gallery_image_ids() && $gallery_show) : ?>
                <?php $gallery_images = $product->get_gallery_image_ids(); ?>

                <div class="image-slider general--slider">
                    <?php foreach ($gallery_images as $idx => $image_id) : ?>
                        <?php $image_url = wp_get_attachment_image_url($image_id, 'full'); ?>
                        <div class="slider__item">
                            <img src="<?php echo $image_url; ?>" alt="<?php echo get_the_title(); ?>">
                        </div>
                    <?php endforeach; ?>
                </div>

                <?php if ($video_type === 'video_from_media_gallery' && $video_file && $video_poster) : ?>
                    <div class="modal-window">
                        <div class="close-modal">
                            <i class="bi bi-x"></i>
                        </div>
                        <div class="modal-window__wrap">
                            <?php echo $video_file['url']; ?>
                            <span class="video-src"></span>
                        </div>
                    </div>
                <?php elseif ($video_type === 'video_from_link' && $video_poster && $video_link): ?>
                    <div class="modal-window">
                        <div class="close-modal">
                            <i class="bi bi-x"></i>
                        </div>
                        <div class="modal-window__wrap">
                            <?php echo $video_link; ?>
                            <span class="video-src"></span>
                        </div>
                    </div>
                <?php endif; ?>

                <div class="image-slider thumbnail--slider">
                    <?php foreach ($gallery_images as $image_id) : ?>
                        <?php $image_url = wp_get_attachment_image_url($image_id, 'full'); ?>
                        <div class="slider__item">
                            <img src="<?php echo $image_url; ?>" alt="<?php echo get_the_title(); ?>">
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else : ?>
                <?php
                $image_id = get_post_thumbnail_id($product->get_id());
                $image_url = wp_get_attachment_image_url($image_id, 'full');
                ?>
                <div class="product-image">
                    <a href="<?php echo $product->get_permalink(); ?>" class="d-flex w-100">
                        <img src="<?php echo $image_url; ?>" alt="<?php echo $product->get_title(); ?>">
                    </a>
                </div>
            <?php endif; ?>

            <?php $term_slug = 'best-seller'; ?>

            <?php if (has_term($term_slug, 'product_tab', get_the_ID())) : ?>
                <div class="product-label">
                    <?php echo get_inline_svg('featured-label.svg'); ?>
                </div>
            <?php endif; ?>

        </div>
        <div class="card-content">
            <div class="card-badge-info">
                <?php $category_ids = $product->get_category_ids(); ?>
                <?php get_cat_terms($category_ids, $taxonomy); ?>

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
                <div
                    class="card-price-wrapper <?php echo $product->get_sale_price() ? 'has-discount' : ''; ?> d-flex align-items-center flex-wrap">
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
                        <span class="card-avg-purhcase">
                            Avg. <?php echo $formatted_number; ?> <?php _e('people buy every month'); ?>
                        </span>
                    <?php endif; ?>
                </div>
            <?php endif; ?>

            <?php if ($description) : ?>
                <div class="card-description">
                    <?php echo $description; ?>
                </div>
            <?php endif; ?>

            <div class="card-btn d-flex flex-column">
                <?php if ($product_link_amazon) : ?>
                    <a href="<?php echo $product_link_amazon['url']; ?>" target="_blank"
                       class="btn btn-accent btn-sm"><?php _e($product_link_amazon['title']); ?></a>
                    <a href="<?php echo $product->get_permalink(); ?>"
                       target="<?php echo is_singular('post') ? '_blank' : '_self'; ?>"
                       class="btn btn-outline-dark btn-sm"><?php _e('More Detail'); ?></a>
                <?php endif; ?>
            </div>
        </div>

    </div>
</div>

