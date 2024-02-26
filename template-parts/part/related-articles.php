<?php
    $taxonomy = 'category';
    $term_slug = get_query_var('category_name');
    $term_object = get_term_by('slug', $term_slug, $taxonomy);

    $args = [
        'post_type' => 'post',
        'posts_per_page' => 3,
        'post__not_in' => array(get_the_ID()),
        'tax_query' => array(
            [
                'taxonomy' => $taxonomy,
                'field' => 'slug',
                'terms' => $term_slug
            ]
        )
    ];

    $query = new WP_Query($args);
?>

<?php if ($query->have_posts()) : ?>
    <section class="related-articles">
        <div class="container">
            <div class="related-articles__wrap">
                <div class="related-articles__title d-flex align-items-center justify-content-between flex-wrap flex-md-nowrap">
                    <h4><?php echo _e('More Posts within ') . $term_object->name; ?></h4>

                    <a href="<?php echo get_term_link($term_object->term_id); ?>" class="btn btn-sm">
                        <span><?php _e('View All'); ?></span>
                        <i class="btn-icon bi-arrow-right"></i>
                    </a>
                </div>

                <div class="related-articles__list row">
                    <?php while ($query->have_posts()) : $query->the_post(); ?>
                        <?php get_template_part('template-parts/part/blog/blog-card'); ?>
                    <?php endwhile; ?>

                    <?php wp_reset_postdata(); ?>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>

