<?php

    /* Theme files */
    require get_template_directory() . '/inc/theme-enqueue.php';
    require get_template_directory() . '/inc/theme-support.php';
    require get_template_directory() . '/inc/theme-setup.php';
    require get_template_directory() . '/inc/theme_functions.php';
    require get_template_directory() . '/inc/theme_woocommerce_functions.php';
    require get_template_directory() . '/inc/filter.php';

    /* Register CPT and Taxonomies */
    require get_template_directory() . '/inc/custom-post-types.php';
    require get_template_directory() . '/inc/custom-taxonomies.php';

    /* ACF functions */
    require get_template_directory() . '/inc/acf.php';
    require get_template_directory() . '/inc/acf/acf-setup.php';
    require get_template_directory() . '/inc/acf/acf-layout-thumbnails.php';
