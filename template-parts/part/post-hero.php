<?php
    global $post;

    $taxonomy = 'category';
    $term_ids = wp_get_post_terms($post->ID, $taxonomy, array('fields' => 'ids'));

    $what_type_of_media = get_field('what_type_of_media');
    $video = get_field('video');
    $image = get_field('image');
    $text_under_media = get_field('text_under_media');
    $subtitle = get_field('subtitle');
?>

<?php if ($video || $image) : ?>
    <section class="post-hero">
        <div class="container">
            <div class="post-hero__wrap">
                <div class="post-hero__media">
                    <?php if ($what_type_of_media == 'video' && $video) : ?>
                        <?php echo $video; ?>
                    <?php elseif ($what_type_of_media == 'image' && $image): ?>
                        <img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt'] ?: $image['title']; ?>">
                    <?php endif; ?>
                </div>
                <?php if ($text_under_media) : ?>
                    <div class="post-hero__text-under">
                        <?php echo $text_under_media; ?>
                    </div>
                <?php endif; ?>

                <?php if (get_the_title()) : ?>
                    <div class="post-hero__title">
                        <h1>
                            <?php the_title(); ?>
                        </h1>
                    </div>
                <?php endif; ?>

                <?php if (is_singular('post')) : ?>
                    <div class="post-hero__badge">
                        <?php foreach ($term_ids as $term_id) : ?>
                            <?php $category = get_term($term_id, $taxonomy); ?>

                            <?php $term_color = get_field('category_color', $taxonomy . '_' . $category->term_id); ?>
                            <span class="badge <?php echo $term_color; ?>">
                                <a href="<?php echo get_term_link($category); ?>"><?php echo $category->name; ?></a>
                            </span>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>

                <?php if ($subtitle) : ?>
                    <div class="post-hero__subtitle">
                        <?php echo $subtitle; ?>
                    </div>
                <?php endif; ?>

                <hr>
            </div>
        </div>
    </section>
<?php endif; ?>
