<?php
    $what_posts_display = get_field('what_posts_display', 'option');
    $blog_posts_list = get_field('blog_posts_list', 'option');
    $blog_title_sup = get_field('blog_title_sup', 'option');
    $blog_title = get_field('blog_title', 'option');
    $blog_description = get_field('blog_description', 'option');

    $args = array(
        'post_type' => 'post',
        'posts_per_page' => 3,
        'orderby' => 'date',
        'order' => 'DESC'
    );

    $query = new WP_Query($args);

    $blog_order = get_field('blog_order');
?>

<?php if ($query->have_posts() || $blog_posts_list) : ?>
    <section class="blog-articles <?php echo (is_tax() || is_home()) ? 'order-' . $blog_order : ''; ?>">
        <div class="container">

            <?php if ($blog_title_sup || $blog_title) : ?>
                <div class="blog-articles__header">

                    <?php if ($blog_title_sup) : ?>
                        <span class="blog-articles__title-sup"><?php echo $blog_title_sup; ?></span>
                    <?php endif; ?>

                    <?php if ($blog_title) : ?>
                        <h2 class="blog-articles__title"><?php echo $blog_title; ?></h2>
                    <?php endif; ?>

                    <?php if ($blog_description) : ?>
                        <div class="blog-articles__desc"><?php echo $blog_description; ?></div>
                    <?php endif; ?>

                </div>
            <?php endif; ?>

            <div class="blog-articles__body">
                <ul class="blog-articles__list row">
                    <?php if ($what_posts_display === 'last_3_posts') : ?>

                        <?php if ($query->have_posts()) : ?>
                            <?php while ($query->have_posts()) : $query->the_post() ?>
                                <?php get_template_part('template-parts/part/blog/blog-card'); ?>
                            <?php endwhile; ?>
                        <?php endif; ?>

                        <?php wp_reset_postdata(); ?>

                    <?php endif; ?>

                    <?php if ($what_posts_display === 'choose_3_posts') : ?>

                        <?php if ($blog_posts_list): ?>
                            <?php foreach ($blog_posts_list as $post): ?>
                                <?php setup_postdata($post); ?>
                                <?php get_template_part('template-parts/part/blog/blog-card'); ?>
                            <?php endforeach; ?>

                            <?php wp_reset_postdata(); ?>

                        <?php endif; ?>

                    <?php endif; ?>
                </ul>

            </div>
            <div class="blog-articles__footer text-center">
                <a href="<?php echo get_post_type_archive_link('post'); ?>"
                   class="btn btn-pink btn-lg"><?php _e('View More'); ?></a>
            </div>
        </div>
    </section>
<?php endif; ?>
