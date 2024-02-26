<?php

    function theme_setup()
    {

        // Register nav menus
        register_nav_menus(
            array(
                'header-menu' => __('Header Menu', 'pet_pixies'),
                'footer-menu-top' => __('Footer Menu Top', 'pet_pixies'),
                'footer-menu-bottom' => __('Footer Menu Bottom', 'pet_pixies'),
            )
        );
    }

    add_action('after_setup_theme', 'theme_setup');

