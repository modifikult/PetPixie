<?php
    $title_h1 = get_sub_field('title_h1');
    $content = get_sub_field('content');
    $link = get_sub_field('link');
    $link_outline = get_sub_field('link_outline');
    $image = get_sub_field('image');
?>

<?php if ($title_h1 && $content && $image) : ?>
    <section class="hero">
        <div class="container">
            <div class="hero__wrap row">
                <div class="hero__col col-left col-md-8 col-lg-6">
                    <div class="hero__title">
                        <h1 class=""><?php echo $title_h1; ?></h1>
                    </div>
                    <div class="hero__desc">
                        <?php echo $content; ?>
                    </div>
                    <?php if ($link || $link_outline) : ?>
                        <div class="hero__btn d-flex flex-wrap">
                            <?php if ($link) : ?>
                                <a href="<?php echo esc_url($link['url']); ?>"
                                   class="btn btn-blue btn-lg"><?php echo $link['title']; ?></a>
                            <?php endif; ?>
                            <?php if ($link_outline) : ?>
                                <a href="<?php echo esc_url($link_outline['url']); ?>"
                                   class="btn btn-outline-blue btn-lg"><?php echo $link_outline['title']; ?></a>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="hero__col col-right col-md-4 col-lg-6">
                    <div class="hero__image">
                        <img src="<?php echo $image['url']; ?>"
                             alt="<?php echo ($image['alt']) ? $image['alt'] : $image['title']; ?>" class="no-lazy">
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>
