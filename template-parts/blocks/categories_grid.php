<?php
    $taxonomy = 'product_cat';

    $cat_args = array(
        'taxonomy' => $taxonomy,
        'orderby' => 'menu_order',
        'order' => 'ASC',
        'hide_empty' => true,
        'parent' => 0,
    );

    $categories = get_terms($cat_args);

    $blog_categories_order = get_field('blog_categories_order');
?>

<?php if ($categories) : ?>

    <section id="product-categories" class="product-categories <?php echo (is_tax() || is_home()) ? 'order-' . $blog_categories_order : ''; ?>">
        <div class="container">
            <div class="product-categories__wrap d-flex flex-wrap row">

                <?php foreach ($categories as $category) : ?>
                    <?php get_template_part('template-parts/part/category/category-card', null, array(
                        'category' => $category,
                        'taxonomy' => $taxonomy,
                    )); ?>
                <?php endforeach; ?>

            </div>
        </div>
    </section>

<?php endif; ?>

