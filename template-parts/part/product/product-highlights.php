<?php
    $highlights_content = get_field('highlights_content');
    $highlights_rating = get_field('highlights_rating');
    $highlights_button_show = get_field('highlights_button_show');

    $product_link_amazon = get_field('product_link_amazon');
?>

<?php if ($highlights_content) : ?>
    <section class="product-highlights">
        <div class="container">
            <div class="product-highlights__wrap d-flex flex-wrap flex-md-nowrap justify-content-between">
                <div class="product-highlights__col col-left">
                    <div class="product-highlights__content">
                        <?php echo $highlights_content; ?>
                    </div>
                    <?php if ($highlights_button_show && $product_link_amazon) : ?>
                        <div class="product-highlights__button d-flex flex-column">
                            <a href="<?php echo $product_link_amazon['url']; ?>"
                               class="btn btn-accent btn-lg" target="_blank">
                                <span><?php echo $product_link_amazon['title']; ?></span>
                                <i class="btn-icon bi-arrow-right"></i>
                            </a>
                        </div>
                    <?php endif; ?>
                </div>
                <?php if ($highlights_rating) : ?>
                    <div class="product-highlights__col col-right">
                        <div class="product-highlights__ratings">
                            <div class="product-highlights__ratings-title">
                                <h6>
                                    <?php _e('Customer ratings by features'); ?>
                                </h6>
                            </div>
                            <div class="product-highlights__ratings-content d-flex flex-column">
                                <?php foreach ($highlights_rating as $rating) : ?>
                                    <?php
                                    $rating_name = $rating['rating_name'];
                                    $rating_star = $rating['rating'];
                                    ?>
                                    <?php if ($rating_star || $rating_star === 0) : ?>
                                        <?php
                                        $i = 0;
                                        $star = round($rating_star);
                                        ?>
                                        <div class="rating d-flex">
                                            <div class="rating-name">
                                                <?php echo $rating_name;?>
                                            </div>
                                            <div class="rating-star">
                                                <?php while ($i < 5) : ?>
                                                    <?php if ($i < $star) : ?>
                                                        <i class="bi bi-star-fill rating-color"></i>
                                                    <?php else : ?>
                                                        <i class="bi bi-star rating-color"></i>
                                                    <?php endif; ?>

                                                    <?php $i++; ?>
                                                <?php endwhile; ?>
                                            </div>
                                            <span class="rating-count d-inline-flex">
                                                <?php echo $rating_star; ?>
                                            </span>
                                        </div>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>

            </div>
        </div>
    </section>
<?php endif; ?>
