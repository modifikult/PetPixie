<?php
    $category = get_queried_object();

    $args = [
        'post_type' => 'post',
        'posts_per_page' => -1,
        'orderby' => 'menu_order',
        'order' => 'ASC',
        'tax_query' => array(
            [
                'taxonomy' => 'category',
                'field' => 'slug',
                'terms' => $category->slug
            ]
        )
    ];

    $query = new WP_Query($args);
?>

<?php get_header(); ?>

<div class="main">
    <section class="blog-posts">
        <div class="container">
            <div class="blog-posts__wrap">

                <div class="blog-posts__title page-title">
                    <h1>
                        <?php echo $category->name; ?>
                    </h1>
                </div>

                <?php if (function_exists('aioseo_breadcrumbs')) : ?>
                    <div class="breadcrumbs">
                        <div class="breadcrumbs__wrap">
                            <?php aioseo_breadcrumbs(); ?>
                        </div>
                    </div>
                <?php endif; ?>

                <?php if ($query->have_posts()) : ?>
                    <div class="blog-posts__content">
                        <div class="blog-posts__list row">
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
                            <div class="blog-posts__btn w-100">
                                <a href="#" class="btn btn-dark view-more-btn btn-lg" data-quanity-show="20">
                                    <?php _e('View More'); ?>
                                </a>
                            </div>
                        <?php endif; ?>
                    </div>
                    <?php wp_reset_postdata(); ?>

                <?php else : ?>
                    <p><?php _e('Posts not found'); ?></p>
                <?php endif; ?>

            </div>
        </div>
    </section>
</div>

<?php get_footer(); ?>
