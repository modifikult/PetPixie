<?php
    global $post;

    $taxonomy = 'product_cat';

    $parent_term = '';

    if (is_singular('product')) {
        $category_ids = wp_get_post_terms($post->ID, $taxonomy, array('fields' => 'ids'));
        $parent_term_id = wp_get_post_terms($post->ID, $taxonomy, array('fields' => 'ids', 'parent' => 0));
        $current_term = array_diff($category_ids, $parent_term_id);
        $parent_term = get_term($parent_term_id[0], $taxonomy);

        $child_terms = get_terms(array(
            'taxonomy' => $taxonomy,
            'exclude' => $current_term,
            'parent' => $parent_term_id[0],
            'hide_empty' => false
        ));
    } else {
        $current_term = get_queried_object();
        $parent_term = get_term($current_term->parent, $taxonomy);

        $child_terms = get_terms(array(
            'taxonomy' => $taxonomy,
            'exclude' => array($current_term->term_id),
            'parent' => $current_term->parent,
            'hide_empty' => false
        ));
    }

    $other_categories_order = get_field('other_categories_order');
?>

<?php if ($child_terms) : ?>
    <section class="other-categories <?php echo is_tax() ? 'order-' . $other_categories_order : ''; ?>">
        <div class="container">
            <div class="other-categories__wrap">
                <div class="other-categories__title">
                    <h5>
                        <?php _e('Other ' . $parent_term->name . ' Categories'); ?>
                    </h5>
                </div>
                <ul class="other-categories__list row">
                    <?php foreach ($child_terms as $child) : ?>
                        <?php

                        $title = get_term_meta($child->term_id, 'other_posts_category_title', true);
                        $text = get_term_meta($child->term_id, 'other_posts_category_text', true);
                        $thumbnail_id = get_woocommerce_term_meta($child->term_id, 'thumbnail_id');
                        $thumbnail = wp_get_attachment_image_src($thumbnail_id, 'full');
                        ?>
                        <?php if ($thumbnail[0]) : ?>
                            <li class="other-categories__list-item col-12 col-md-6 col-lg-4 col-xl-3">
                                <a href="<?php echo get_term_link($child->term_id); ?>" class="item__wrap">
                                    <?php if ($thumbnail_id) : ?>
                                        <div class="item__image">
                                            <img src="<?php echo esc_url($thumbnail[0]); ?>"
                                                 alt="<?php echo $child->name; ?>">
                                        </div>
                                    <?php endif; ?>
                                    <?php if ($title) : ?>
                                        <div class="item__title">
                                            <h6><?php echo $title; ?></h6>
                                        </div>
                                        <?php else :?>
                                        <div class="item__title">
                                            <h6><?php echo $child->name; ?></h6>
                                        </div>
                                    <?php endif; ?>
                                    <?php if ($text) : ?>
                                        <div class="item__text">
                                            <?php echo $text; ?>
                                        </div>
                                    <?php endif; ?>
                                </a>
                            </li>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    </section>

<?php endif; ?>
