<?php
    $features_title = get_field('features_title', 'option');
    $features_list = get_field('features_list', 'option');
?>

<?php if ($features_list) : ?>
    <section class="website-features">
        <div class="container">
            <?php if($features_title) :?>
                <div class="section-header">
                    <h5><?php echo $features_title; ?></h5>
                </div>
            <?php endif; ?>

            <div class="row g-4 row-cols-1 row-cols-lg-3">
                <?php foreach ($features_list as $post) : ?>
                    <?php setup_postdata($post); ?>
                    <?php get_template_part('template-parts/part/feature-card'); ?>
                <?php endforeach; ?>
                <?php wp_reset_postdata(); ?>
            </div>
        </div>
    </section>
<?php endif; ?>
