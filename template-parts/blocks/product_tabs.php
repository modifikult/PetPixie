<?php
    $taxonomy = 'product_tab';
    $exclude_category1 = get_term_by('term_id', 56, $taxonomy);
//    $exclude_category2 = get_term_by('slug', 'best-seller', $taxonomy);

    if (is_front_page()) {
        $exclude_categories = array();

        $parent_terms = get_terms(array(
            'taxonomy' => $taxonomy,
            'orderby' => 'term_order',
            'hide_empty' => true,
            'parent' => 0,
        ));

        foreach ($parent_terms as $parent_term) {
            $checkbox_value = get_term_meta($parent_term->term_id, 'show_on_homepage', true);
            if ($checkbox_value !== '1') {
                $exclude_categories[] = $parent_term->term_id;
            }
        }

        $tab_args = array(
            'taxonomy' => $taxonomy,
            'orderby' => 'term_order',
            'hide_empty' => true,
            'exclude' => $exclude_categories,
            'parent' => 0,
        );
    } else {
        $tab_args = array(
            'taxonomy' => $taxonomy,
            'orderby' => 'term_order',
            'hide_empty' => true,
            'exclude' => [$exclude_category1->term_id],
            'parent' => 0,
        );
    }

    $tabs = get_terms($tab_args);

    $first_tab = true;
    $first_content = true;
?>

<?php if ($tabs) : ?>
    <section id="product-tabs" class="products-tabs">
        <div class="container">
            <ul class="nav nav-pills nav-fill gap-3" id="pills-tab" role="tablist">
                <?php foreach ($tabs as $tab) : ?>
                    <?php
                    $args = [
                        'post_type' => 'product',
                        'tax_query' => array([
                            'taxonomy' => $taxonomy,
                            'field' => 'slug',
                            'terms' => $tab->slug
                        ])
                    ];

                    $query = new WP_Query($args);
                    ?>

                    <?php if ($query->have_posts()) : ?>
                        <li class="nav-item col-12 col-md-auto" role="presentation">
                            <button class="nav-link <?php echo ($first_tab) ? 'active' : ''; ?>"
                                    id="pills-<?php echo $tab->slug; ?>-tab"
                                    data-bs-toggle="pill"
                                    data-bs-target="#pills-<?php echo $tab->slug; ?>"
                                    type="button" role="tab" aria-controls="pills-<?php echo $tab->slug; ?>"
                                    aria-selected="true">
                                <?php if ($tab->slug == 'new-arrival') : ?>
                                    <span><?php _e('Top New'); ?></span> <?php echo $tab->name; ?>
                                <?php else : ?>
                                    <span><?php _e('Top Most'); ?></span> <?php echo $tab->name; ?>
                                <?php endif; ?>
                            </button>
                        </li>

                        <?php $first_tab = false; ?>
                    <?php endif; ?>
                <?php endforeach; ?>
            </ul>
            <div class="tab-content" id="pills-tabContent">
                <?php foreach ($tabs as $tab) : ?>
                    <div class="tab-pane fade <?php echo ($first_content) ? 'show active' : ''; ?>"
                         id="pills-<?php echo $tab->slug; ?>" role="tabpanel"
                         aria-labelledby="pills-<?php echo $tab->slug; ?>-tab"
                         tabindex="0">

                        <div class="row products-tabs-row g-4">
                            <?php
                                $args = [
                                    'post_type' => 'product',
                                    'posts_per_page' => 6,
                                    'tax_query' => array([
                                        'taxonomy' => $taxonomy,
                                        'field' => 'slug',
                                        'terms' => $tab->slug
                                    ])
                                ];

                                $query = new WP_Query($args);
                            ?>

                            <?php if ($query->have_posts()) : ?>
                                <?php while ($query->have_posts()) : $query->the_post(); ?>
                                    <?php wc_get_template_part('content', 'product'); ?>
                                <?php endwhile; ?>
                                <?php $first_content = false; ?>
                            <?php endif; ?>
                            <?php wp_reset_postdata(); ?>

                        </div>

                        <div class="products-tabs__btn">
                            <?php
                                $cat_id = $tab->term_id;
                                $cat_link = get_category_link($cat_id);
                            ?>
                            <a href="<?php echo $cat_link; ?>" class="btn btn-dark btn-lg">
                                <?php _e('View All'); ?>
                            </a>
                        </div>
                    </div>
                <?php endforeach ?>
            </div>

        </div>
    </section>
<?php endif; ?>

