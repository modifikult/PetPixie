<?php
    global $post;

    $taxonomy = 'category';

    $term_ids = wp_get_post_terms($post->ID, $taxonomy, array('fields' => 'ids'));

    $thumbnail_url = get_the_post_thumbnail_url();
    $thumbnail_caption = get_the_post_thumbnail_caption() ? get_the_post_thumbnail_caption() : get_the_title();
    $title = get_the_title();
    $desc = get_the_excerpt();
    $link = get_the_permalink();
    $category = get_queried_object_id();

	if (isset($args['blog_card_class'] )) :
    	$blog_card_class = $args['blog_card_class'] ? : 'blog-card__pixie';
	endif;
?>

<li class="blog-card col-sm-12 col-lg-4 <?php if (isset($args['blog_card_class'] )) :  echo $blog_card_class; endif; ?>">
    <?php if ($thumbnail_url) : ?>
        <a href="<?php echo get_permalink(); ?>">
            <figure class="blog-card__figure">
                <img src="<?php echo $thumbnail_url; ?>"
                     alt="<?php echo $thumbnail_caption; ?>">
            </figure>
        </a>
    <?php endif; ?>

    <div class="blog-card__badge">
        <?php foreach ($term_ids as $term_id) : ?>
            <?php $category = get_term($term_id, $taxonomy); ?>

            <?php $term_color = get_field('category_color', $taxonomy . '_' . $category->term_id); ?>
            <span class="badge <?php echo $term_color; ?>">
            <a href="<?php echo get_term_link($category); ?>"><?php echo $category->name; ?></a>
        </span>
        <?php endforeach; ?>
    </div>

    <h5 class="blog-card__title">
        <a href="<?php echo get_permalink(); ?>">
            <?php echo $title; ?>
        </a>
    </h5>

    <?php if ($desc) : ?>
        <div class="blog-card__desc"><?php echo $desc; ?></div>
    <?php endif; ?>

    <div class="blog-card__btn">
        <a href="<?php echo $link; ?>" class="btn btn-tertiary btn-sm">
            <span><?php _e('Read more'); ?></span>
            <i class="btn-icon bi-arrow-right"></i>
        </a>
    </div>
</li>
