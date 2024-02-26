<?php

    remove_action('woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10);


// Hook into the 'init' action
add_action('init', 'create_sale_subcategory');

function create_sale_subcategory() {
    $taxonomy = 'product_cat'; // Replace with your desired taxonomy slug
    $term_name = 'On Sale';

    // Get all top-level categories
    $top_level_categories = get_terms(array(
        'taxonomy' => $taxonomy,
        'parent' => 0,
        'hide_empty' => false,
    ));

    foreach ($top_level_categories as $top_level_category) {
        // Check if the 'On Sale' subcategory doesn't exist
        $sale_subcategory = term_exists($term_name, $taxonomy, $top_level_category->term_id);
        if (!$sale_subcategory) {
            $new_term = wp_insert_term($term_name, $taxonomy, array(
                'parent' => $top_level_category->term_id
            ));

            // Check if the term creation was successful
            if (!is_wp_error($new_term)) {
                // Success! The 'On Sale' subcategory was created
                // You can perform additional actions here if needed
            } else {
                // Failed to create the 'On Sale' subcategory
                // Handle the error here if necessary
            }
        }
    }
}

// Hook into the 'save_post' action
add_action('save_post_product', 'assign_sale_categories', 10, 3);

function assign_sale_categories($post_id, $post, $update) {
    // Check if the post is a product and it's being updated
    if (get_post_type($post_id) === 'product' && $update) {
        // Check if the 'On Sale' term is assigned to the 'product_tab' taxonomy
        $product_tabs = wp_get_post_terms($post_id, 'product_tab');
        $has_sale_term = false;
        foreach ($product_tabs as $product_tab) {
            if ($product_tab->term_id === 56) {
                $has_sale_term = true;
                break;
            }
        }

        // Assign the product to the sale subcategories of active top-level parent categories
        if ($has_sale_term) {
            // Get all active top-level parent categories from the 'product_cat' taxonomy
            $top_categories = get_terms(array(
                'taxonomy' => 'product_cat',
                'parent' => 0,
                'hide_empty' => false,
            ));

            // Loop through each top-level category
            foreach ($top_categories as $top_category) {
                // Check if the top-level category is active for the current product
                $is_assigned = has_term($top_category->term_id, 'product_cat', $post_id);

                if ($is_assigned) {
                    // Get the 'On Sale' subcategory of the current top-level category by name
                    $child_categories = get_terms(array(
                        'taxonomy' => 'product_cat',
                        'child_of' => $top_category->term_id,
                        'name' => 'On Sale',
                        'hide_empty' => false,
                    ));

                    // Assign the product to each 'On Sale' subcategory
                    foreach ($child_categories as $child_category) {
                        wp_set_object_terms($post_id, $child_category->term_id, 'product_cat', true);
                    }
                }
            }
        } else {
            // Unassign the product from all 'On Sale' categories
            $sale_categories = get_terms(array(
                'taxonomy' => 'product_cat',
                'name' => 'On Sale',
                'hide_empty' => false,
            ));

            foreach ($sale_categories as $sale_category) {
                wp_remove_object_terms($post_id, $sale_category->term_id, 'product_cat');
            }
        }
    }
}

// Register custom cron interval (every hour)
add_filter('cron_schedules', 'register_custom_cron_interval');
function register_custom_cron_interval($schedules) {
    $schedules['hourly'] = array(
        'interval' => 3600, // 1 hour in seconds
        'display' => __('Once Hourly')
    );
    return $schedules;
}

// Schedule the cron job
add_action('wp', 'schedule_sale_category_assignment');
function schedule_sale_category_assignment() {
    if (!wp_next_scheduled('assign_sale_categories_cron')) {
        wp_schedule_event(time(), 'hourly', 'assign_sale_categories_cron');
    }
}

// Hook into the scheduled cron job
add_action('assign_sale_categories_cron', 'assign_sale_categories_cronjob');
function assign_sale_categories_cronjob() {
    $products = get_posts(array(
        'post_type' => 'product',
        'posts_per_page' => -1,
    ));

    foreach ($products as $product) {
        $post_id = $product->ID;
        assign_sale_categories($post_id, $product, true);
    }
}
