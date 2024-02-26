<?php
    $taxonomy = 'category';

    $term_args = [
        'taxonomy' => $taxonomy,
        'order_by' => 'menu_order',
        'order' => 'ASC',
        'hide_empty' => true
    ];

    $terms = get_terms($term_args);

    $args = [
        'post_type' => 'post',
        'posts_per_page' => -1
    ];

    $query = new WP_Query($args);
?>


<?php if ($query->have_posts()) : ?>
    <section class="blog-categories">
        <div class="container">
            <div class="blog-categories__wrap">
                <?php if ($terms) : ?>
                    <div class="blog-categories__filter filter">
                        <a href="#" class="btn btn-grey current btn-md"
                           data-term-slug="all"
                           data-term-taxonomy="category"
                        >
                            <?php _e('All'); ?>
                        </a>
                        <?php foreach ($terms as $term) : ?>
                            <a href="#" class="btn btn-grey btn-md"
                               data-term-slug="<?php echo $term->slug; ?>"
                               data-term-taxonomy="<?php echo $term->taxonomy; ?>"
                            >
                                <?php echo $term->name; ?>
                            </a>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>

                <div class="blog-categories__content">
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
                            <a href="#" class="btn btn-dark view-more-btn btn-sm" data-quanity-show="20">
                                <?php _e('View More'); ?>
                            </a>
                        </div>
                    <?php endif; ?>
                </div>


                <div class="loading-spinner">
                    <?php echo get_inline_svg('spin.svg'); ?>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>

