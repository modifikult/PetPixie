<?php if (is_singular('post')) : ?>
    <?php get_template_part('template-parts/part/related-articles'); ?>
<?php else : ?>
    <?php get_template_part('template-parts/part/blog-articles'); ?>
<?php endif; ?>
