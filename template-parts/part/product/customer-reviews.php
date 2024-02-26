<?php
    $reviews_title = get_field('reviews_title');
    $reviews_list = get_field('reviews_list');
?>

<?php if ($reviews_list) : ?>
    <section class="customer-reviews">
        <div class="container">
            <div class="customer-reviews__wrap">
                <?php if($reviews_title) :?>
                    <div class="section-header text-center">
                        <h5><?php echo $reviews_title; ?></h5>
                    </div>
                <?php endif; ?>

                <div class="customer-reviews__list reviews--slider">
                    <?php foreach ($reviews_list as $reviews_item) : ?>
                        <?php get_template_part('template-parts/part/product/customer-reviews-card', null, array(
                            'item' => $reviews_item
                        )); ?>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>
