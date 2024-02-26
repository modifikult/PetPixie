<?php
    $benefits_title = get_field('benefits_title');
    $benefits_list = get_field('benefits_list');
    $benefits_image = get_field('benefits_image');
    $benefits_button_show = get_field('benefits_button_show');

    $product_link_amazon = get_field('product_link_amazon');

?>

<?php if ($benefits_title && $benefits_list && $benefits_image) : ?>
    <section class="product-benefits">
        <div class="container">
            <div class="product-benefits__wrap">
                <div class="product-benefits__title">
                    <h5><?php echo $benefits_title; ?></h5>
                </div>
                <div class="product-benefits__content d-flex flex-wrap flex-md-nowrap justify-content-between">
                    <div class="product-benefits__col col-left">
                        <ol class="product-benefits__list">
                            <?php foreach ($benefits_list as $list_item) : ?>
                                <?php
                                $title = $list_item['item_title'];
                                $text = $list_item['item_text'];
                                ?>
                                <li class="product-benefits__list-item d-flex flex-column">
                                    <?php if ($title) : ?>
                                        <h6 class="item__title">
                                            <?php echo $title; ?>
                                        </h6>
                                    <?php endif; ?>
                                    <?php if ($text) : ?>
                                        <span class="item__text">
                                            <?php echo $text; ?>
                                        </span>
                                    <?php endif; ?>
                                </li>
                            <?php endforeach; ?>
                        </ol>

                        <?php if ($benefits_button_show && $product_link_amazon) : ?>
                            <div class="product-benefits__button d-flex flex-column">
                                <a href="<?php echo $product_link_amazon['url']; ?>"
                                   class="btn btn-accent btn-lg" target="_blank">
                                    <span><?php echo $product_link_amazon['title']; ?></span>
                                    <i class="btn-icon bi-arrow-right"></i>
                                </a>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="product-benefits__col col-right">
                        <div class="product-benefits__image">
                            <img src="<?php echo $benefits_image['url']; ?>"
                                 alt="<?php echo $benefits_image['alt'] ?: $benefits_image['title']; ?>">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>
