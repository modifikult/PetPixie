<?php

    if(isset($args)) {
        $category = $args['category'];
        $taxonomy = $args['taxonomy'];
    }

    $cat_name = $category->name;
    $cat_thumbnail_id = get_woocommerce_term_meta($category->term_id, 'thumbnail_id', true);
    $cat_thumbnail = wp_get_attachment_image_src($cat_thumbnail_id, 'full');

    $category_color = get_field('category_color', 'product_cat_' . $category->term_id);
    $category_count = 0;
?>

<div class="product-categories__card col-12 col-sm-6">
    <div
        class="product-categories__card-wrap d-flex flex-md-row flex-column flex-wrap flex-lg-nowrap <?php echo $category_color; ?>">
        <div class="card__content order-2 order-lg-1 d-flex flex-column">
            <div class="card__header">
                <span class="card__title-sup"><?php _e('Browse Top'); ?></span>
                <h3 class="card__title"><?php echo $category->name; ?></h3>
            </div>
            <div class="card__body">
                <ul class="card__subcategory-list list-group-flush">
                    <?php
                        $children_args = array(
                            'taxonomy' => $taxonomy,
                            'orderby' => 'menu_order',
                            'order' => 'ASC',
                            'hide_empty' => true,
                            'parent' => $category->term_id,
                            'meta_query' => array(
                                'relation' => 'OR',
                                array(
                                    'key' => 'post_status',
                                    'value' => 'publish',
                                    'compare' => '=',
                                ),
                                array(
                                    'key' => 'post_status',
                                    'compare' => 'NOT EXISTS',
                                ),
                            ),
                        );
                    ?>

                    <?php $subcategory_terms = get_terms($children_args);; ?>

                    <?php if ($subcategory_terms) : ?>
                        <?php foreach ($subcategory_terms as $sub_term) : ?>
                            <?php if ($category_count < 4) : ?>
                                <li class="card__subcategory-list-item">
                                    <a href="<?php echo get_term_link($sub_term); ?>" class="list-group-link">
                                        <?php _e('Top 10 '); ?><?php echo $sub_term->name; ?>
                                    </a>
                                </li>

                                <?php $category_count++; ?>
                            <?php endif; ?>

                        <?php endforeach; ?>

                    <?php endif; ?>
                </ul>
            </div>
            <div class="card__footer">
                <div class="card__btn">
                    <a href="<?php echo get_term_link($category->term_id); ?>"
                       class="btn btn-outline-dark btn-md">
                        <span><?php _e('View More Categories'); ?></span>
                        <i class="btn-icon bi-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>
        <div class="card__image d-flex align-items-md-end order-1 order-lg-2">
            <div class="card__image-wrap">
                <img src="<?php echo $cat_thumbnail[0]; ?>"
                     class="card-image" alt="<?php echo $category->name; ?>">
            </div>
        </div>
    </div>
</div>
