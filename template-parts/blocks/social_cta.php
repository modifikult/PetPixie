<?php
    $social_image = get_field('social_image', 'option');
    $social_list = get_field('social_list', 'option');

    $social_cta_order = get_field('social_cta_order');
?>

<?php if ($social_image || $social_list) : ?>
    <section class="social-media <?php echo (is_tax() || is_home()) ? 'order-' . $social_cta_order : ''; ?>">
        <div class="container">
            <div
                class="social-media__wrap d-flex justify-content-center justify-content-lg-between align-items-center flex-wrap flex-lg-nowrap">
                <?php if ($social_image) : ?>
                    <div class="social-media__image order-2 order-lg-1">
                        <div class="social-media__image-wrap">
                            <img src="<?php echo $social_image['url']; ?>"
                                 alt="<?php echo $social_image['alt'] ? $social_image['alt'] : $social_image['title']; ?>">
                        </div>
                    </div>
                <?php endif; ?>

                <?php if ($social_list) : ?>
                    <ul class="social-media__list d-flex flex-wrap order-1 order-lg-2">
                        <?php foreach ($social_list as $list) : ?>
                            <?php get_template_part('template-parts/part/social-card', null, array(
                                'list' => $list
                            )); ?>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>

                <div class="social-media__pet-icon pet-icon-1">
                    <?php echo get_inline_svg('pet-icon-1.svg'); ?>
                </div>

                <div class="social-media__pet-icon pet-icon-2">
                    <?php echo get_inline_svg('pet-icon-2.svg'); ?>
                </div>

                <div class="social-media__pet-icon pet-icon-3">
                    <?php echo get_inline_svg('pet-icon-3.svg'); ?>
                </div>

                <div class="social-media__pet-icon pet-icon-4">
                    <?php echo get_inline_svg('pet-icon-4.svg'); ?>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>
