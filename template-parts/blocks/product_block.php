<?php
    $title = get_sub_field('title');
    $description = get_sub_field('description');
    $product = get_sub_field('product');


    $product_class = 'col-12';
    $product_wrap_class = 'd-flex flex-column align-items-center';
?>

<?php if ($product) : ?>
    <section class="product-block">
        <div class="container">
            <div class="product-block__wrap">
                <?php if ($title) : ?>
                    <div class="product-block__title">
                        <h3>
                            <?php echo $title; ?>
                        </h3>
                    </div>
                <?php endif; ?>

                <?php if ($description) : ?>
                    <div class="product-block__desc">
                        <?php echo $description; ?>
                    </div>
                <?php endif; ?>

                <?php get_template_part('template-parts/part/product/product-card', null, array(
                    'product_class' => $product_class,
                    'product_wrap_class' => $product_wrap_class,
                    'gallery_show' => true
                )); ?>
            </div>
        </div>
    </section>
<?php endif; ?>
