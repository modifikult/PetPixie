<?php
    if (isset($args)) {
        $product = $args['product_features'];
        $product_image = $product['image'];
        $product_title = $product['title'];
        $product_description = $product['description'];
    }
?>

<div class="product-features__card">
    <div class="card__wrap">
        <?php if ($product_image) : ?>
            <div class="card__image">
                <img src="<?php echo esc_url($product_image['url']); ?>"
                     alt="<?php echo $product_image['alt'] ?: $product_image['title']; ?>">
            </div>
        <?php endif; ?>

        <?php if($product_title) :?>
            <div class="card__title">
                <?php echo $product_title;?>
            </div>
        <?php endif; ?>

        <?php if($product_description) :?>
            <div class="card__description">
                <?php echo $product_description;?>
            </div>
        <?php endif; ?>
    </div>
</div>

