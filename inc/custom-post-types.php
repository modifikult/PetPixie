<?php
    /*
    =====================
        Custom Post Types
    =====================
    */

    function cptui_register_my_cpt_team()
    {

        /**
         * Post Type: Team
         */

        $labels = array(
            'name' => __('Team', 'pet_pixies'),
            'singular_name' => __('Team', 'pet_pixies'),
        );

        $args = array(
            'label' => __('Team', 'pet_pixies'),
            'labels' => $labels,
            'description' => '',
            'public' => true,
            'publicly_queryable' => true,
            'show_ui' => true,
            'show_in_rest' => true,
            'rest_base' => '',
            'rest_controller_class' => 'WP_REST_Posts_Controller',
            'has_archive' => false,
            'show_in_menu' => true,
            'show_in_nav_menus' => true,
            'delete_with_user' => false,
            'exclude_from_search' => false,
            'capability_type' => 'post',
            'map_meta_cap' => true,
            'hierarchical' => false,
            'rewrite' => array(
                'slug' => 'team',
                'with_front' => true,
            ),
            'query_var' => true,
            'menu_icon' => 'dashicons-groups',
            'supports' => array('title', 'thumbnail'),
            'show_in_graphql' => false,
        );

        register_post_type('team', $args);
    }

    add_action('init', 'cptui_register_my_cpt_team');

    function cptui_register_my_cpt_features()
    {

        /**
         * Post Type: Features
         */

        $labels = array(
            'name' => __('Features', 'pet_pixies'),
            'singular_name' => __('Features', 'pet_pixies'),
        );

        $args = array(
            'label' => __('Features', 'pet_pixies'),
            'labels' => $labels,
            'description' => '',
            'public' => true,
            'publicly_queryable' => true,
            'show_ui' => true,
            'show_in_rest' => true,
            'rest_base' => '',
            'rest_controller_class' => 'WP_REST_Posts_Controller',
            'has_archive' => false,
            'show_in_menu' => true,
            'show_in_nav_menus' => true,
            'delete_with_user' => false,
            'exclude_from_search' => false,
            'capability_type' => 'post',
            'map_meta_cap' => true,
            'hierarchical' => false,
            'rewrite' => array(
                'slug' => 'features',
                'with_front' => true,
            ),
            'query_var' => true,
            'menu_icon' => 'dashicons-clipboard',
            'supports' => array('title', 'editor', 'thumbnail'),
            'show_in_graphql' => false,
        );

        register_post_type('features', $args);
    }

    add_action('init', 'cptui_register_my_cpt_features');
