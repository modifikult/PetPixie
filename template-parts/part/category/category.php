<?php
    $taxonomy = 'product_cat';
    $curren_term_id = get_queried_object_id();


    if (is_page_template('template-page/sale-page.php')) {
        $args = array(
            'taxonomy' => $taxonomy,
            'orderby' => 'menu_order',
            'order' => 'ASC',
            'hide_empty' => false,
            'parent' => 0
        );

        $terms = get_terms($args);
        $term_ids = wp_list_pluck($terms, 'term_id');
    } else {
        $args = array(
            'taxonomy' => $taxonomy,
            'orderby' => 'menu_order',
            'order' => 'ASC',
            'hide_empty' => false,
            'parent' => $curren_term_id
        );

        $term_ids = get_term_children($curren_term_id, $taxonomy, $args);
    }


    $product_class = 'col-12 col-md-6 col-lg-4 col-xl-3';
?>

<?php if ($term_ids) : ?>
    <section class="category">
        <div class="container">
            <div class="category__wrap">
                <?php foreach ($term_ids as $term_id) : ?>
                    <?php
                    $term = get_term_by('id', $term_id, $taxonomy);

                    if (is_page_template('template-page/sale-page.php')) {
                        $args = [
                            'post_type' => 'product',
                            'posts_per_page' => 4,
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
                                ]
                            )
                        ];
                    } else {
                        $args = [
                            'post_type' => 'product',
                            'posts_per_page' => 4,
                            'tax_query' => array([
                                'taxonomy' => $taxonomy,
                                'field' => 'term_id',
                                'terms' => $term_id
                            ])
                        ];
                    }


                    $query = new WP_Query($args);
                    ?>

                    <?php if ($query->have_posts()) :
                        $parent_category_id = $term->term_id;
                        $child_categories = get_term_children($parent_category_id, 'product_cat');

                        foreach ($child_categories as $child_category) {
                            $category = get_term_by('id', $child_category, 'product_cat');
                            $sale_category_link = false;

                            if ($category->name === 'Sale') {
                                $sale_category_link = get_term_link($category->term_id);
                                break;
                            }
                        }

                        ?>
                        <div class="category__block">
                            <div
                                class="category__block-header d-flex flex-wrap flex-md-nowrap justify-content-center justify-content-md-between align-items-center">
                                <h5 class="text-center text-md-start">
                                    <?php if (is_page_template('template-page/sale-page.php')) : ?>
                                        <span><?php echo $term->name; ?></span><?php _e(' on Sale'); ?>
                                    <?php else : ?>
                                        <?php _e('Top 10 '); ?><span><?php echo $term->name; ?></span>
                                    <?php endif; ?>
                                </h5>
                                <a href="<?php echo is_page_template('template-page/sale-page.php') ? $sale_category_link : get_term_link($term->term_id); ?>" class="btn btn-outline-dark btn-sm">
                                    <span><?php _e('Show All'); ?></span>
                                    <i class="btn-icon bi-arrow-right"></i>
                                </a>
                            </div>

                            <div class="category__block-list row g-3">
                                <?php while ($query->have_posts()) : $query->the_post(); ?>
                                    <?php get_template_part('template-parts/part/product/product-card', null, array(
                                        'product_class' => $product_class,
                                    )); ?>
                                <?php endwhile; ?>

                                <?php wp_reset_postdata(); ?>
                            </div>
                        </div>

                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
<?php endif; ?>
