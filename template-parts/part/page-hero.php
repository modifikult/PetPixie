<?php
    $taxonomy = 'product_cat';
    $category = get_queried_object();

    if (is_page_template('template-page/sale-page.php')) {
        $hero_title = get_field('hero_title', get_the_ID());
        $hero_subtitle = get_field('hero_subtitle', get_the_ID());
        $hero_image = get_field('hero_image', get_the_ID());
    } else if ($category->name == 'Sale') {
//        $parent_term = get_field('hero_title', $taxonomy . '_' . $category->term_id);
        $hero_title = get_field('hero_title', $taxonomy . '_' . $category->term_id);
        $hero_subtitle = get_field('hero_subtitle', $taxonomy . '_' . $category->term_id);
        $hero_image = get_field('hero_image', $taxonomy . '_' . $category->term_id);
    } else {
        $hero_title = get_field('hero_title', $taxonomy . '_' . $category->term_id);
        $hero_subtitle = get_field('hero_subtitle', $taxonomy . '_' . $category->term_id);
        $hero_image = get_field('hero_image', $taxonomy . '_' . $category->term_id);
    }

    if ($category->parent !== 0) {
        $cat_thumbnail_id = get_woocommerce_term_meta($category->parent, 'thumbnail_id', true);
        $cat_thumbnail = wp_get_attachment_image_src($cat_thumbnail_id, 'custom-thumbnail');
    } else {
        $cat_thumbnail_id = get_woocommerce_term_meta($category->term_id, 'thumbnail_id', true);
        $cat_thumbnail = wp_get_attachment_image_src($cat_thumbnail_id, 'custom-thumbnail');
    }
?>

<?php if ($hero_title) : ?>
    <section class="page-hero">
        <div class="container">
            <div class="page-hero__wrap d-lg-flex align-items-center">
                <div class="page-hero__text">
                    <h1>
                        <?php echo $hero_title; ?>
                    </h1>

                    <?php if ($hero_subtitle) : ?>
                        <span>
                            <?php echo $hero_subtitle; ?>
                        </span>
                    <?php endif; ?>

                </div>
                <?php if ($hero_image) : ?>
                    <div class="page-hero__image hero__image">
                        <img src="<?php echo esc_url($hero_image['url']); ?>"
                             alt="<?php echo esc_attr($hero_image['alt'] ?: $hero_image['title']); ?>">
                    </div>
                <?php elseif ($cat_thumbnail) : ?>
                    <div class="page-hero__image category__image">
<!--                        --><?php //the_post_thumbnail('custom-thumbnail');?>
                        <img src="<?php echo $cat_thumbnail[0]; ?>" alt="">
                    </div>
                <?php endif; ?>

            </div>
        </div>
    </section>
<?php endif; ?>

