<?php $product_features_list = get_field('product_features_list');  ?>

<?php if ($product_features_list) : ?>
    <section class="product-features">
        <div class="container">
            <div class="product-features__wrap">
                <?php foreach ($product_features_list as $product_features) : ?>
                    <?php get_template_part('template-parts/part/product/product-features-card', null, array(
                        'product_features' => $product_features,
                    )); ?>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
<?php endif; ?>
