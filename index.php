<?php get_header(); ?>

<div class="flexible-blocks">
    <?php if (have_rows('building_blocks')) : ?>
        <?php while (have_rows('building_blocks')) : the_row() ?>
            <?php get_template_part('template-parts/blocks/' . get_row_layout()); ?>
        <?php endwhile; ?>
    <?php else : ?>

    <?php endif; ?>
</div>

<?php get_footer(); ?>
