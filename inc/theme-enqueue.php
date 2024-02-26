<?php
    /*
    =====================
        Add Styles And Scripts
    =====================
    */

    add_action('wp_enqueue_scripts', 'theme_load_scripts');
    function theme_load_scripts()
    {
        wp_enqueue_script('jquery');
        wp_enqueue_script('main-script', get_template_directory_uri() . '/public/js/main.min.js', array('jquery'), false, true);

        //send PHP variables to JS
        wp_localize_script('main-script', 'wp_ajax',
            array(
                'ajax_url' => admin_url('admin-ajax.php'),
            )
        );

        /*theme css*/
        wp_enqueue_style('main-style', get_template_directory_uri() . '/public/css/main.min.css', array(), false, 'all');
    }

    /**
     * Admin styles
     */
    add_action('admin_enqueue_scripts', 'load_admin_style');
    function load_admin_style()
    {
        wp_enqueue_style('admin_css', get_template_directory_uri() . '/inc/admin/admin-style.css', false, '1.0.0');
    }
