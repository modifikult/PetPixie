<?php
    $team_title = get_field('team_title', 'option');
    $team_list = get_field('team_list', 'option');

    $team_order = get_field('team_order');
?>

<?php if ($team_title && $team_list) : ?>
    <section class="team <?php echo (is_tax() || is_home()) ? 'order-' . $team_order : ''; ?>">
        <div class="container">
            <div class="team__wrap d-flex justify-content-between align-items-center">
                <div class="team__title">
                    <h3 class="text-center text-lg-start">
                        <?php echo $team_title; ?>
                    </h3>
                </div>
                <div class="team__list d-flex">
                    <?php foreach ($team_list as $post) : ?>
                        <?php setup_postdata($post); ?>
                        <?php get_template_part('template-parts/part/team-card'); ?>
                    <?php endforeach; ?>
                    <?php wp_reset_postdata(); ?>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>
