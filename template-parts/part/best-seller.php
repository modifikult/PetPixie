<?php
    global $post;

    $taxonomy1 = 'product_cat';
    $taxonomy2 = 'product_tab';

    $term = get_queried_object();
    $parent_term = get_term_by('id', $term->parent, $taxonomy1);

    if (is_singular('product')) {
        $best_seller_generation = get_field('best_seller_generation');

        if ($best_seller_generation === 'automatically') {
            $term_id = wp_get_post_terms($post->ID, $taxonomy1, array('fields' => 'all', 'childless' => true));
            $best_seller_title = get_field('best_seller_title');

            // New array to avoid Sale categories
            $terms = array();

            foreach ($term_id as $term) :
                if ($term->name !== "Sale") :
                    array_push($terms, $term->term_id);
                endif;
            endforeach;

            $args = array(
                'post_type' => 'product',
                'posts_per_page' => 8,
                'orderby' => 'menu_order',
                'order' => 'ASC',
                'post__not_in' => array($post->ID),
                'tax_query' => array(
                    [
                        'taxonomy' => $taxonomy1,
                        'field' => 'term_id',
                        'terms' => $terms,
                    ],
                )
            );

            $query = new WP_Query($args);
        } else if ($best_seller_generation === 'manual') {
            $best_seller_title = get_field('best_seller_title');
            $best_seller_posts = get_field('best_seller_posts');
        }
    } elseif (is_page_template('template-page/sale-page.php')) {
        $term_id = null;
        $best_seller_title = get_field('best_seller_title', get_the_ID());

        $args = array(
            'post_type' => 'product',
            'posts_per_page' => 12,
            'orderby' => 'menu_order',
            'order' => 'ASC',
            'tax_query' => array(
                'relation' => 'AND',
                [
                    'taxonomy' => $taxonomy2,
                    'field' => 'term_id',
                    'terms' => 55,
                ],
                [
                    'taxonomy' => $taxonomy2,
                    'field' => 'term_id',
                    'terms' => 56,
                ],
            )
        );

        $query = new WP_Query($args);
    } else if ($term->name == 'Sale') {
        $term_id = get_queried_object_id();
        $best_seller_title = get_field('best_seller_title', $taxonomy1 . '_' . $term_id);

        $args = array(
            'post_type' => 'product',
            'posts_per_page' => 12,
            'orderby' => 'menu_order',
            'order' => 'ASC',
            'tax_query' => array(
                'relation' => 'AND',
                [
                    'taxonomy' => $taxonomy1,
                    'field' => 'slug',
                    'terms' => $parent_term->slug,
                ],
                [
                    'taxonomy' => $taxonomy2,
                    'field' => 'term_id',
                    'terms' => 55,
                ],
                [
                    'taxonomy' => $taxonomy2,
                    'field' => 'term_id',
                    'terms' => 56,
                ]
            )
        );

        $query = new WP_Query($args);
    } else {
        $term_id = get_queried_object_id();
        $best_seller_title = get_field('best_seller_title', $taxonomy1 . '_' . $term_id);

        $args = array(
            'post_type' => 'product',
            'posts_per_page' => 12,
            'orderby' => 'menu_order',
            'order' => 'ASC',
            'post__not_in' => array($post->ID),
            'tax_query' => array(
                'relation' => 'AND',
                [
                    'taxonomy' => $taxonomy1,
                    'field' => 'term_id',
                    'terms' => $term_id,
                ],
                [
                    'taxonomy' => $taxonomy2,
                    'field' => 'term_id',
                    'terms' => 55,
                ],
            )
        );

        $query = new WP_Query($args);
    }
?>

<?php if (!is_singular('product')) : ?>
    <?php if ($query->have_posts()) : ?>
        <section class="best-seller">
            <div class="container">
                <?php if ($best_seller_title) : ?>
                    <div class="best-seller__title">
                        <h4>
                            <?php echo $best_seller_title; ?>
                        </h4>
                    </div>
                <?php endif; ?>

                <div class="best-seller__slider">
                    <?php if ($query->have_posts()) : ?>
                        <?php while ($query->have_posts()) : $query->the_post(); ?>
                            <div class="best-seller__slider-item">
                                <?php get_template_part('template-parts/part/product/product-card'); ?>
                            </div>
                        <?php endwhile; ?>
                    <?php endif; ?>

                    <?php wp_reset_postdata(); ?>
                </div>
            </div>
        </section>
    <?php endif; ?>
<?php else : ?>
    <?php if ($best_seller_generation === 'automatically') : ?>
        <?php if ($query->have_posts()) : ?>
            <section class="best-seller">
                <div class="container">
                    <?php if ($best_seller_title) : ?>
                        <div
                            class="best-seller__title d-flex align-items-center justify-content-between flex-wrap flex-md-nowrap">
                            <h4>
                                <?php echo $best_seller_title; ?>
                            </h4>

                            <?php $post_terms = wp_get_post_terms($post->ID, $taxonomy1, array('fields' => 'all', 'childless' => true)); ?>

                            <?php foreach ($post_terms as $post_term) : ?>
                                <?php if ($post_term->name !== 'Sale') : ?>
                                    <a href="<?php echo get_term_link($post_term->term_id); ?>" class="btn btn-sm">
                                        <span><?php _e('View all'); ?></span>
                                        <i class="btn-icon bi-arrow-right"></i>
                                    </a>
                                    <?php break; ?>
                                <?php endif; ?>
                            <?php endforeach; ?>

                        </div>
                    <?php endif; ?>

                    <div class="best-seller__slider">
                        <?php if ($query->have_posts()) : ?>
                            <?php while ($query->have_posts()) : $query->the_post(); ?>
                                <div class="best-seller__slider-item">
                                    <?php get_template_part('template-parts/part/product/product-card'); ?>
                                </div>
                            <?php endwhile; ?>
                        <?php endif; ?>

                        <?php wp_reset_postdata(); ?>
                    </div>
                </div>
            </section>
        <?php endif; ?>
    <?php elseif ($best_seller_generation === 'manual'): ?>
        <?php if ($best_seller_posts) : ?>
            <section class="best-seller">
                <div class="container">
                    <?php if ($best_seller_title) : ?>
                        <div class="best-seller__title">
                            <h4>
                                <?php echo $best_seller_title; ?>
                            </h4>
                        </div>
                    <?php endif; ?>

                    <div class="best-seller__slider">
                        <?php foreach ($best_seller_posts as $post) : ?>
                            <?php setup_postdata($post); ?>

                            <div class="best-seller__slider-item">
                                <?php get_template_part('template-parts/part/product/product-card'); ?>
                            </div>
                        <?php endforeach; ?>

                        <?php wp_reset_postdata(); ?>
                    </div>
                </div>
            </section>
        <?php endif; ?>
    <?php endif; ?>
<?php endif; ?>
