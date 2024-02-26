<?php
    $header_logo = get_field('header_logo', 'option')
?>

<header class="header">
    <div class="container">
        <div class="header__wrap">
            <div class="header-open">
                <span></span>
            </div>

            <?php if ($header_logo) : ?>
                <div class="header__logo">
                    <a href="<?php echo get_home_url(); ?>">
                        <img src="<?php echo $header_logo['url']; ?>"
                             alt="<?php echo ($header_logo['alt']) ? $header_logo['alt'] : $header_logo['title']; ?>">
                    </a>
                </div>
            <?php endif; ?>

            <div class="header__content">
                <div class="header__nav">
                    <nav class="header__nav-item">
                        <?php wp_nav_menu([
                            'menu' => 'header-menu',
                            'container' => null,
                            'menu_class' => 'menu',
                            'echo' => true,
                            'fallback_cb' => 'wp_page_menu',
                            'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                            'depth' => 0,
                        ]); ?>
                    </nav>
                </div>
            </div>

            <div class="header__country">
                <div class="header__country-item">
                    <span class="item__icon">
                        <?php echo get_inline_svg('country-flag-1.svg');?>
                    </span>
                    <span class="item__label">Unites States / USD</span>
                </div>
            </div>
        </div>
    </div>

    <div class="header__mob">
        <div class="header__nav">
            <div class="header-close">
                <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M0.21967 1.28033C-0.0732234 0.987437 -0.0732234 0.512563 0.21967 0.21967C0.512563 -0.0732233 0.987439 -0.0732233 1.28033 0.21967L9 7.93934L16.7197 0.21967C17.0126 -0.0732233 17.4874 -0.0732233 17.7803 0.21967C18.0732 0.512563 18.0732 0.987437 17.7803 1.28033L10.0607 9L17.7803 16.7197C18.0732 17.0126 18.0732 17.4874 17.7803 17.7803C17.4874 18.0732 17.0126 18.0732 16.7197 17.7803L9 10.0607L1.28033 17.7803C0.987438 18.0732 0.512564 18.0732 0.219671 17.7803C-0.0732224 17.4874 -0.0732224 17.0126 0.219671 16.7197L7.93934 9L0.21967 1.28033Z" fill="white"/>
                </svg>
            </div>
            <nav class="header__nav-item">
                <?php wp_nav_menu([
                    'menu' => 'header-menu',
                    'container' => null,
                    'menu_class' => 'menu',
                    'echo' => true,
                    'fallback_cb' => 'wp_page_menu',
                    'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                    'depth' => 0,
                ]); ?>
            </nav>
        </div>
    </div>
</header>
