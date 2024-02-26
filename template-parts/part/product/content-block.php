<?php
    $author = get_field('author');
    $content = get_the_content();
?>

<?php if (get_the_content()) : ?>
    <section class="content">
        <div class="container">
            <div class="content__wrap">
                <?php if ($author) : ?>
                    <div class="content__author">
                        <?php foreach ($author as $post) : ?>
                            <?php setup_postdata($post); ?>
                            <?php get_template_part('template-parts/part/team-card'); ?>
                        <?php endforeach; ?>
                        <?php wp_reset_postdata(); ?>
                    </div>
                <?php endif; ?>
                <div class="content__text">
                    <?php the_content(); ?>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>
