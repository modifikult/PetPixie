<?php

    add_action('wp_ajax_filter_posts', 'filter_posts');
    add_action('wp_ajax_nopriv_filter_posts', 'filter_posts');

    function filter_posts()
    {
        $term_slug = $_REQUEST['termSlug']; // data property
        $term_taxonomy = $_REQUEST['termTaxonomy']; // data property

        if ($term_slug === 'all') {
            $args = [
                'post_type' => 'post',
                'posts_per_page' => -1,
            ];
        } else {
            $args = [
                'post_type' => 'post',
                'posts_per_page' => -1,
                'tax_query' => array(
                    [
                        'taxonomy' => $term_taxonomy,
                        'field' => 'slug',
                        'terms' => $term_slug
                    ]
                )
            ];
        }

        $query = new WP_Query($args);

        if ($query->have_posts()) :?>
            <div class="blog-categories__list row">
                <?php $i = 0; ?>
                <?php while ($query->have_posts()) : $query->the_post(); ?>
                    <?php if ($i < 20) : ?>
                        <?php $blog_card_class = ' element-show'; ?>
                    <?php else : ?>
                        <?php $blog_card_class = ' element-hidden'; ?>
                    <?php endif; ?>

                    <?php get_template_part('template-parts/part/blog/blog-card', null, array('blog_card_class' => $blog_card_class)); ?>

                    <?php $i++; ?>
                <?php endwhile; ?>

                <?php wp_reset_postdata(); ?>
            </div>

            <?php if ($query->post_count > 20) : ?>
                <div class="blog-categories__btn w-100">
                    <a href="#" class="btn btn-dark view-more-btn btn-lg" data-quanity-show="20">
                        <?php _e('View More'); ?>
                    </a>
                </div>
            <?php endif;

        else :
            echo 'Post not found';
        endif;

        wp_die();
    }
