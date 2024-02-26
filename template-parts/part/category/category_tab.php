<?php
    $taxonomy = 'product_tab';
    $category = get_queried_object();
    $exclude_category = get_term_by('slug', 'best-seller', $taxonomy);

    $tab_args = array(
        'taxonomy' => 'product_tab',
        'orderby' => 'term_order',
        'hide_empty' => true,
        'exclude' => $exclude_category->term_id
    );

    $tabs = get_terms($tab_args);

    $first_tab = true;
    $first_content = true;

    $product_class = 'col-12';
    $product_wrap_class = 'd-flex flex-column flex-md-row';
?>

<?php if ($tabs) : ?>
    <section class="category-tabs">
        <div class="container">
            <ul class="nav nav-pills nav-fill gap-3" id="pills-tab" role="tablist">
                <?php
                    $args = [
                        'post_type' => 'product',
                        'post_status' => 'publish',
                        'posts_per_page' => 10,
                        'tax_query' => array(
                            [
                                'taxonomy' => 'product_cat',
                                'field' => 'term_id',
                                'terms' => $category->term_id
                            ],
                        )
                    ];

                    $query = new WP_Query($args);
                ?>
                <?php if ($query->have_posts()) : ?>
                    <li class="nav-item col-12 col-md-auto" role="presentation">
                        <button class="nav-link active"
                                id="pills-all-tab"
                                data-bs-toggle="pill"
                                data-bs-target="#pills-all"
                                type="button" role="tab" aria-controls="pills-all"
                                aria-selected="true">
                            <span><?php _e('Top 10'); ?></span>
                            <?php _e('All'); ?>
                        </button>
                    </li>
                    <?php $first_tab = false; ?>
                <?php endif; ?>
                <?php foreach ($tabs as $tab) : ?>
                    <?php
                    $args = [
                        'post_type' => 'product',
                        'post_status' => 'publish',
                        'posts_per_page' => 10,
                        'tax_query' => array(
                            'relation' => 'AND',
                            [
                                'taxonomy' => 'product_cat',
                                'field' => 'term_id',
                                'terms' => $category->term_id
                            ],
                            [
                                'taxonomy' => $taxonomy,
                                'field' => 'slug',
                                'terms' => $tab->slug
                            ],
                        )
                    ];

                    $query = new WP_Query($args);
                    ?>

                    <?php if ($query->have_posts()) : ?>
                        <li class="nav-item col-12 col-md-auto" role="presentation">
                            <button class="nav-link"
                                    id="pills-<?php echo $tab->slug; ?>-tab"
                                    data-bs-toggle="pill"
                                    data-bs-target="#pills-<?php echo $tab->slug; ?>"
                                    type="button" role="tab" aria-controls="pills-<?php echo $tab->slug; ?>"
                                    aria-selected="true">
                                <span><?php $tab->term_id == 56 ? _e('Supplies On') : _e('Top 10'); ?></span> <?php echo $tab->name; ?>
                            </button>
                        </li>
                    <?php endif; ?>
                <?php endforeach; ?>
            </ul>
            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active"
                     id="pills-all" role="tabpanel"
                     aria-labelledby="pills-all-tab"
                     tabindex="0">

                    <div class="row category-tabs-row g-4">
                        <?php
                            $args = [
                                'post_type' => 'product',
                                'post_status' => 'publish',
                                'posts_per_page' => 10,
                                'tax_query' => array(
                                    [
                                        'taxonomy' => 'product_cat',
                                        'field' => 'term_id',
                                        'terms' => $category->term_id
                                    ],
                                )
                            ];

                            $query = new WP_Query($args);
                        ?>

                        <?php if ($query->have_posts()) : ?>

                            <?php while ($query->have_posts()) : $query->the_post(); ?>
                                <?php get_template_part('template-parts/part/product/product-card', null, array(
                                    'product_class' => $product_class,
                                    'product_wrap_class' => $product_wrap_class,
                                    'gallery_show' => true
                                )); ?>
                            <?php endwhile; ?>

                            <?php wp_reset_postdata(); ?>

                        <?php endif; ?>


                    </div>
                </div>
                <?php foreach ($tabs as $tab) : ?>
                    <div class="tab-pane fade"
                         id="pills-<?php echo $tab->slug; ?>" role="tabpanel"
                         aria-labelledby="pills-<?php echo $tab->slug; ?>-tab"
                         tabindex="0">

                        <div class="row category-tabs-row g-4">
                            <?php
                                $args = [
                                    'post_type' => 'product',
                                    'post_status' => 'publish',
                                    'posts_per_page' => 10,
                                    'tax_query' => array(
                                        'relation' => 'AND',
                                        [
                                            'taxonomy' => 'product_cat',
                                            'field' => 'term_id',
                                            'terms' => $category->term_id
                                        ],
                                        [
                                            'taxonomy' => $taxonomy,
                                            'field' => 'slug',
                                            'terms' => $tab->slug
                                        ],
                                    )
                                ];

                                $query = new WP_Query($args);
                            ?>

                            <?php if ($query->have_posts()) : ?>

                                <?php while ($query->have_posts()) : $query->the_post(); ?>
                                    <?php get_template_part('template-parts/part/product/product-card', null, array(
                                        'product_class' => $product_class,
                                        'product_wrap_class' => $product_wrap_class,
                                        'gallery_show' => true
                                    )); ?>
                                <?php endwhile; ?>

                                <?php wp_reset_postdata(); ?>

                            <?php endif; ?>


                        </div>
                    </div>
                <?php endforeach ?>
            </div>

        </div>
    </section>
<?php endif; ?>

