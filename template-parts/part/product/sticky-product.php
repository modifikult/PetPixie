<?php
    $product = wc_get_product(get_the_ID());

    $image_url = get_the_post_thumbnail_url(get_the_ID());
    $image_caption = get_the_post_thumbnail_caption() ?: get_the_title();
    $title = get_the_title();
    $rating = get_field('rating');
    $amount_of_monthly_purchases = get_field('amount_of_monthly_purchases');
    $product_link_amazon = get_field('product_link_amazon');
?>

<section class="sticky-product">
    <div class="container">
        <div class="sticky-product__wrap d-flex flex-wrap flex-md-nowrap align-items-center">
            <?php if ($image_url) : ?>
                <div class="sticky-product__img">
                    <img src="<?php echo $image_url; ?>" alt="<?php echo $image_caption; ?>">
                </div>
            <?php endif; ?>
            <div class="sticky-product__content d-flex flex-wrap">
                <div class="sticky-product__title">
                    <h6>
                        <?php echo $title; ?>
                    </h6>
                </div>
                <?php if ($rating || $rating === 0) : ?>
                    <?php
                    $i = 0;
                    $star = round($rating);
                    ?>

                    <div class="sticky-product__rating d-flex align-items-center">
                        <div class="sticky-product__rating-stars d-flex align-items-center">
                            <?php while ($i < 5) : ?>
                                <i class="<?php echo $i < $rating ? 'bi bi-star-fill rating-color' : 'bi bi-star rating-color'; ?> "></i>
                                <?php $i++; ?>
                            <?php endwhile; ?>
                        </div>

                        <span
                            class="sticky-product__rating-count"><?php echo $rating; ?><?php _e(' outstanding'); ?>
                        </span>
                    </div>
                <?php endif; ?>


                <?php if ($product->get_regular_price()) : ?>
                    <div
                        class="sticky-product__price <?php echo $product->get_sale_price() ? 'has-discount' : ''; ?> d-flex align-items-center">
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
            </div>
            <?php if ($product_link_amazon) : ?>
                <div class="sticky-product__btn">
                    <a href="<?php echo $product_link_amazon['url']; ?>" target="_blank"
                       class="btn btn-accent btn-lg">
                        <span><?php _e($product_link_amazon['title']); ?></span>
                        <i class="btn-icon bi-arrow-right"></i>
                    </a>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>
