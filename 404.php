<?php get_header(); ?>

<div class="main">

    <section class="page-404">
        <div class="container">
            <div class="page-404__wrap">
                <div class="page-404__error">
                    <span>404</span>
                </div>
                <div class="page-404__title">
                    <h1><?php _e('Page not found'); ?></h1>
                </div>
                <div class="page-404__btn">
                    <a href="<?php echo get_home_url(); ?>" class="btn btn-blue btn-md">
                        <span><?php _e('Back to home'); ?></span>
                    </a>
                </div>
            </div>
        </div>
    </section>

</div>

<?php get_footer(); ?>
