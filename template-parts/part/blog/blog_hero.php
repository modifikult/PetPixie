<?php
    $taxonomy = 'featured';

    $args = [
        'post_type' => 'post',
        'posts_per_page' => 3,
        'tax_query' => array([
            'taxonomy' => $taxonomy,
            'field' => 'slug',
            'terms' => 'top-featured'
        ])
    ];

    $query = new WP_Query($args);
?>

<?php if ($query->have_posts()) : ?>

    <section class="blog-hero slider">
        <div class="container">
            <div class="blog-hero__wrap">
                <div class="blog-hero__slider default--slider">
                    <?php while ($query->have_posts()) : $query->the_post(); ?>
                        <?php
                        $thumbnail_url = get_the_post_thumbnail_url();
                        $thumbnail_caption = get_the_post_thumbnail_caption() ?: get_the_title();
                        $title = get_the_title();
                        $desc = get_the_excerpt();
                        ?>
                        <div class="blog-hero__slider-item d-flex flex-column flex-md-row">
                            <?php if ($thumbnail_url) : ?>
                                <div class="item__left">
                                    <div class="item__image">
                                        <a href="<?php the_permalink(); ?>">
                                            <img src="<?php echo $thumbnail_url; ?>"
                                                 alt="<?php echo $thumbnail_caption; ?>">
                                        </a>
                                    </div>
                                </div>
                            <?php endif; ?>
                            <?php if ($title || $desc) : ?>
                                <div class="item__right d-flex flex-column justify-content-center">
                                    <div class="item__badge">
                                        <?php
                                            $term_ids = wp_get_post_terms(get_the_ID(), $taxonomy, array('fields' => 'ids'));
                                        ?>

                                        <?php foreach ($term_ids as $term_id) : ?>
                                            <?php $category = get_term($term_id, $taxonomy); ?>

                                            <?php $term_color = get_field('category_color', $taxonomy . '_' . $category->term_id); ?>
                                            <span class="badge <?php echo $term_color; ?>">
                                                <a href="<?php echo get_term_link($category); ?>"><?php echo $category->name; ?></a>
                                            </span>
                                        <?php endforeach; ?>
                                    </div>
                                    <?php if ($title) : ?>
                                        <h2 class="item__title">
                                            <a href="<?php the_permalink(); ?>"><?php echo $title; ?></a>
                                        </h2>
                                    <?php endif; ?>
                                    <?php if ($desc) : ?>
                                        <div class="item__text">
                                            <?php echo $desc; ?>
                                        </div>
                                    <?php endif; ?>
                                    <a href="<?php echo esc_url(get_permalink()); ?>"
                                       class="item__btn btn btn-tertiary">
                                        <span><?php _e('Read More'); ?></span>
                                        <i class="btn-icon bi-arrow-right"></i>
                                    </a>
                                </div>
                            <?php endif; ?>
                        </div>
                    <?php endwhile; ?>

                    <?php wp_reset_postdata(); ?>
                </div>
            </div>
        </div>
    </section>

<?php endif; ?>


