<?php
    /*
        =====================
            Custom Taxonomies
        =====================
    */

    function cptui_register_my_taxes_team_specialization()
    {

        /**
         * Taxonomy: Specialization.
         */

        $labels = [
            "name" => __("Specialization", "pet_pixies"),
            "singular_name" => __("Specialization", "pet_pixies"),
        ];


        $args = [
            "label" => __("Specialization", "pet_pixies"),
            "labels" => $labels,
            "public" => true,
            "publicly_queryable" => true,
            "hierarchical" => true,
            "show_ui" => true,
            "show_in_menu" => true,
            "show_in_nav_menus" => true,
            "query_var" => true,
            "rewrite" => ['slug' => 'team-specialization', 'with_front' => true,],
            "show_admin_column" => false,
            "show_in_rest" => true,
            "show_tagcloud" => false,
            "rest_base" => "team_specialization",
            "rest_controller_class" => "WP_REST_Terms_Controller",
            "rest_namespace" => "wp/v2",
            "show_in_quick_edit" => true,
            "sort" => true,
            "show_in_graphql" => false,
        ];

        register_taxonomy("team_specialization", ["team"], $args);
    }

    add_action('init', 'cptui_register_my_taxes_team_specialization');


    function cptui_register_my_taxes_product_product_tab()
    {

        /**
         * Taxonomy: Product Tab.
         */

        $labels = [
            "name" => __("Product Tab", "pet_pixies"),
            "singular_name" => __("Product Tab", "pet_pixies"),
        ];


        $args = [
            "label" => __("Product Tab", "pet_pixies"),
            "labels" => $labels,
            "public" => true,
            "publicly_queryable" => true,
            "hierarchical" => true,
            "show_ui" => true,
            "show_in_menu" => true,
            "show_in_nav_menus" => true,
            "query_var" => true,
            "rewrite" => ['slug' => 'product-tab', 'with_front' => true,],
            "show_admin_column" => false,
            "show_in_rest" => true,
            "show_tagcloud" => false,
            "rest_base" => "product_tab",
            "rest_controller_class" => "WP_REST_Terms_Controller",
            "rest_namespace" => "wp/v2",
            "show_in_quick_edit" => true,
            "sort" => true,
            "show_in_graphql" => false,
        ];
        register_taxonomy("product_tab", ["product"], $args);
    }

    add_action('init', 'cptui_register_my_taxes_product_product_tab');

    function cptui_register_my_taxes_post_featured()
    {

        /**
         * Taxonomy: Featured.
         */

        $labels = [
            "name" => __("Featured", "pet_pixies"),
            "singular_name" => __("Featured", "pet_pixies"),
        ];


        $args = [
            "label" => __("Featured", "pet_pixies"),
            "labels" => $labels,
            "public" => true,
            "publicly_queryable" => true,
            "hierarchical" => true,
            "show_ui" => true,
            "show_in_menu" => true,
            "show_in_nav_menus" => true,
            "query_var" => true,
            "rewrite" => ['slug' => 'featured', 'with_front' => true,],
            "show_admin_column" => false,
            "show_in_rest" => true,
            "show_tagcloud" => false,
            "rest_base" => "featured",
            "rest_controller_class" => "WP_REST_Terms_Controller",
            "rest_namespace" => "wp/v2",
            "show_in_quick_edit" => true,
            "sort" => true,
            "show_in_graphql" => false,
        ];
        register_taxonomy("featured", ["post"], $args);
    }

    add_action('init', 'cptui_register_my_taxes_post_featured');
