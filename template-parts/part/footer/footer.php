<?php
    $footer_logo = get_field('footer_logo', 'option');
?>

<footer class="footer">
    <div class="container">
        <div class="footer__wrap">
            <div class="footer__top">
                <?php if ($footer_logo) : ?>
                    <div class="footer__logo">
                        <a href="<?php echo home_url(); ?>">
                            <img src="<?php echo $footer_logo['url']; ?>"
                                 alt="<?php echo ($footer_logo['alt']) ? $footer_logo['alt'] : $footer_logo['title']; ?>">
                        </a>
                    </div>
                <?php endif; ?>
                <div class="footer__nav">
                    <nav>
                        <?php wp_nav_menu([
                            'menu' => 'footer-menu-top',
                            'depth' => 2,
                            'container' => 'null',
                            'menu_class' => 'menu pet-pixies__menu footer__nav-item',
                            'echo' => true
                        ]); ?>
                    </nav>
                </div>
            </div>
            <div class="footer__bottom">
                <nav>
                    <?php wp_nav_menu([
                        'menu' => 'footer-menu-bottom',
                        'container' => null,
                        'menu_class' => 'menu',
                        'echo' => true,
                        'fallback_cb' => 'wp_page_menu',
                        'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                        'depth' => 0,
                    ]); ?>
                </nav>
                <div class="footer__policy">
                    © <?php echo get_the_date('Y'); ?> Pet Pixies. All rights reserved.
                </div>
            </div>
        </div>
    </div>
</footer>
