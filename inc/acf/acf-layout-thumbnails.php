<?php

    /**
     * ACF Extended plugin + ACF PRO required
     */


// Hero

    add_filter('acfe/flexible/thumbnail/layout=hero', 'hero_layout_thumbnail', 10, 3);
    function hero_layout_thumbnail($thumbnail, $field, $layout)
    {

        // Must return an URL or Attachment ID
        return get_template_directory_uri() . '/public/images/layout-thumbnails/hero.png';

    }

// Features

    add_filter('acfe/flexible/thumbnail/layout=features', 'features_layout_thumbnail', 10, 3);
    function features_layout_thumbnail($thumbnail, $field, $layout)
    {

        // Must return an URL or Attachment ID
        return get_template_directory_uri() . '/public/images/layout-thumbnails/features.png';

    }


// Blog Posts

    add_filter('acfe/flexible/thumbnail/layout=blog_posts', 'blog_posts_layout_thumbnail', 10, 3);
    function blog_posts_layout_thumbnail($thumbnail, $field, $layout)
    {

        // Must return an URL or Attachment ID
        return get_template_directory_uri() . '/public/images/layout-thumbnails/blog_posts.png';

    }


// Product Categories Grid

    add_filter('acfe/flexible/thumbnail/layout=categories_grid', 'categories_grid_layout_thumbnail', 10, 3);
    function categories_grid_layout_thumbnail($thumbnail, $field, $layout)
    {

        // Must return an URL or Attachment ID
        return get_template_directory_uri() . '/public/images/layout-thumbnails/categories_grid.png';

    }


// Product Tabs

    add_filter('acfe/flexible/thumbnail/layout=product_tabs', 'product_tabs_layout_thumbnail', 10, 3);
    function product_tabs_layout_thumbnail($thumbnail, $field, $layout)
    {

        // Must return an URL or Attachment ID
        return get_template_directory_uri() . '/public/images/layout-thumbnails/product_tabs.png';

    }


// Social CTA

    add_filter('acfe/flexible/thumbnail/layout=social_cta', 'social_cta_layout_thumbnail', 10, 3);
    function social_cta_layout_thumbnail($thumbnail, $field, $layout)
    {

        // Must return an URL or Attachment ID
        return get_template_directory_uri() . '/public/images/layout-thumbnails/social_cta.png';

    }


// Team

    add_filter('acfe/flexible/thumbnail/layout=team', 'team_layout_thumbnail', 10, 3);
    function team_layout_thumbnail($thumbnail, $field, $layout)
    {

        // Must return an URL or Attachment ID
        return get_template_directory_uri() . '/public/images/layout-thumbnails/team.png';

    }

// Content block

    add_filter('acfe/flexible/thumbnail/layout=content_block', 'content_block_layout_thumbnail', 10, 3);
    function content_block_layout_thumbnail($thumbnail, $field, $layout)
    {

        // Must return an URL or Attachment ID
        return get_template_directory_uri() . '/public/images/layout-thumbnails/content_block.png';

    }

    // Media | Content

    add_filter('acfe/flexible/thumbnail/layout=media_content', 'media_content_layout_thumbnail', 10, 3);
    function media_content_layout_thumbnail($thumbnail, $field, $layout)
    {

        // Must return an URL or Attachment ID
        return get_template_directory_uri() . '/public/images/layout-thumbnails/media_content.png';

    }

    // Product block

    add_filter('acfe/flexible/thumbnail/layout=product_block', 'product_block_layout_thumbnail', 10, 3);
    function product_block_layout_thumbnail($thumbnail, $field, $layout)
    {

        // Must return an URL or Attachment ID
        return get_template_directory_uri() . '/public/images/layout-thumbnails/product_block.png';

    }

    // Other posts

    add_filter('acfe/flexible/thumbnail/layout=category_other_posts', 'other_posts_layout_thumbnail', 10, 3);
    function other_posts_layout_thumbnail($thumbnail, $field, $layout)
    {

        // Must return an URL or Attachment ID
        return get_template_directory_uri() . '/public/images/layout-thumbnails/other_posts.png';

    }
