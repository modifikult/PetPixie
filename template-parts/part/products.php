<?php
    $term = get_queried_object();
    $taxonomy = $term->taxonomy;

    $paren_term = get_term_by('id', $term->parent, $taxonomy);

    if ($term->name === 'Sale' && !is_tax($taxonomy, 56)) {
        $term_id = $paren_term->term_id;

        $args = [
            'post_type' => 'product',
            'posts_per_page' => -1,
            'post_status' => 'publish',
            'tax_query' => array(
                'relation' => 'AND',
                [
                    'taxonomy' => $taxonomy,
                    'field' => 'term_id',
                    'terms' => $term_id
                ],
                [
                    'taxonomy' => 'product_tab',
                    'field' => 'term_id',
                    'terms' => 56
                ],
            )
        ];
    } else {
        $term_id = $term->term_id;

        $args = [
            'post_type' => 'product',
            'posts_per_page' => -1,
            'post_status' => 'publish',
            'tax_query' => array(
                [
                    'taxonomy' => $taxonomy,
                    'field' => 'term_id',
                    'terms' => $term_id
                ],
            )
        ];
    }


    $query = new WP_Query($args);

    $i = 0;

    $product_class = 'col-12';
    $product_wrap_class = 'd-flex flex-column flex-md-row';
?>

<?php if ($query->have_posts()) : ?>
    <section class="products">
        <div class="container">
            <div class="products__wrap row g-4">
                <?php while ($query->have_posts()) : $query->the_post(); ?>
                    <?php if ($i < 10) : ?>
                        <?php $product_class .= ' element-show'; ?>
                    <?php else : ?>
                        <?php $product_class .= ' element-hidden'; ?>
                    <?php endif; ?>

                    <?php get_template_part('template-parts/part/product/product-card', null, array(
                        'product_class' => $product_class,
                        'product_wrap_class' => $product_wrap_class,
                        'gallery_show' => true
                    )); ?>

                    <?php $i++; ?>
                <?php endwhile; ?>

                <?php if ($query->post_count > 10) : ?>
                    <div class="products__btn">
                        <a href="#" class="btn btn-dark view-more-btn btn-lg" data-quanity-show="10">
                            <?php _e('View More'); ?>
                        </a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </section>
<?php endif; ?>

<?php wp_reset_postdata(); ?>
