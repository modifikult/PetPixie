<?php
    // Add title tag for every page. Title tag should be removed from the markup
    add_theme_support('title-tag');

    // SVG support
    add_filter('upload_mimes', 'svg_upload_allow');

    function svg_upload_allow($mimes)
    {
        $mimes['svg'] = 'image/svg+xml';

        return $mimes;
    }

    add_filter('wp_check_filetype_and_ext', 'fix_svg_mime_type', 10, 5);

    function fix_svg_mime_type($data, $file, $filename, $mimes, $real_mime = '')
    {

        if (version_compare($GLOBALS['wp_version'], '5.1.0', '>=')) {
            $dosvg = in_array($real_mime, ['image/svg', 'image/svg+xml']);
        } else {
            $dosvg = ('.svg' === strtolower(substr($filename, -4)));
        }

        if ($dosvg) {
            if (current_user_can('manage_options')) {
                $data['ext'] = 'svg';
                $data['type'] = 'image/svg+xml';
            } else {
                $data['ext'] = false;
                $data['type'] = false;
            }

        }

        return $data;
    }

    function change_post_labels()
    {
        global $wp_post_types;
        $labels = &$wp_post_types['post']->labels;

        // Change the labels
        $labels->name = 'Blog';
        $labels->singular_name = 'Blog';
        $labels->menu_name = 'Blog';

        // Change the slug
        $args = &$wp_post_types['post'];
        $args->rewrite = array(
            'slug' => 'blog',
            'with_front' => true,
        );
    }

    add_action('init', 'change_post_labels');

    function add_custom_content_after_images($content)
    {
        preg_match_all('/<img[^>]+>/i', $content, $image_matches);

        if (isset($image_matches[0]) && !empty($image_matches[0])) {
            foreach ($image_matches[0] as $image_tag) {
                preg_match('/wp-image-(\d+)/i', $image_tag, $image_id_matches);
                $image_id = isset($image_id_matches[1]) ? $image_id_matches[1] : 0;

                $image_text = get_field('text_under', $image_id);

                $custom_content = '<div class="media-content">';
                $custom_content .= $image_tag;
                $custom_content .= '<span>' . $image_text . '</span>';
                $custom_content .= '</div>';

                $content = str_replace($image_tag, $custom_content, $content);
            }
        }

        return $content;
    }

    add_filter('the_content', 'add_custom_content_after_images');

    add_image_size('custom-thumbnail', 612, 408, true);

    function add_custom_thumbnail_size($sizes)
    {
        return array_merge($sizes, array(
            'custom-thumbnail' => __('Custom Thumbnail'),
        ));
    }

    add_filter('image_size_names_choose', 'add_custom_thumbnail_size');

    function custom_yoast_breadcrumbs_first_item_icon($output)
    {
        $custom_html = '<i class="bi bi-house-door-fill"></i>';

        $first_link_position = strpos($output, 'Home');

        if ($first_link_position !== false) {
            $output = substr_replace($output, $custom_html, $first_link_position, 0);
        }

        return $output;
    }

    add_filter('wpseo_breadcrumb_output', 'custom_yoast_breadcrumbs_first_item_icon', 10, 1);

    function display_featured_taxonomy($column, $post_id)
    {
        if ($column === 'featured') {
            $terms = get_the_terms($post_id, 'featured');

            if ($terms && !is_wp_error($terms)) {
                $taxonomy_names = array();

                foreach ($terms as $term) {
                    $taxonomy_names[] = $term->name;
                }

                echo implode(', ', $taxonomy_names);
            }
        }
    }

    add_action('manage_posts_custom_column', 'display_featured_taxonomy', 10, 2);

    function add_featured_taxonomy_column_header($columns)
    {
        $columns['featured'] = 'Featured';
        return $columns;
    }

    add_filter('manage_posts_columns', 'add_featured_taxonomy_column_header');

    function add_lazyload_attribute($html, $url, $attr)
    {
        if (strpos($html, 'oembed') !== false) {
            $html = str_replace('src', 'data-src', $html);
            $html = str_replace('frameborder="0"', 'frameborder="0" data-lazy="true"', $html);
            $html = str_replace('allowfullscreen', 'allowfullscreen data-lazy="true"', $html);
            $html = '<div class="lazyload">' . $html . '</div>';
        }

        return $html;
    }

    add_filter('embed_oembed_html', 'add_lazyload_attribute', 10, 3);
    add_filter('video_embed_html', 'add_lazyload_attribute');

    function add_show_on_homepage_product_tab_field($term)
    {
        $term_id = $term->term_id;
        $checkbox_value = get_term_meta($term_id, 'show_on_homepage', true);
        ?>
        <tr class="form-field">
            <th scope="row"><label for="show-on-homepage"><?php _e('Show on homepage', 'pet_pixies'); ?></label></th>
            <td>
                <input type="checkbox" name="show_on_homepage" id="show-on-homepage"
                       value="1" <?php checked($checkbox_value, '1'); ?>>
            </td>
        </tr>
        <?php
    }

    add_action('product_tab_edit_form_fields', 'add_show_on_homepage_product_tab_field');

    function save_show_on_homepage_product_tab_field($term_id)
    {
        if (isset($_POST['show_on_homepage'])) {
            update_term_meta($term_id, 'show_on_homepage', '1');
        } else {
            delete_term_meta($term_id, 'show_on_homepage');
        }
    }

    add_action('edited_product_tab', 'save_show_on_homepage_product_tab_field');

    function add_custom_taxonomy_fields($term, $fields)
    {
        $term_id = $term->term_id;
        foreach ($fields as $field) {
            $field_name = $field['name'];
            $field_label = $field['label'];
            $field_value = get_term_meta($term_id, $field_name, true);
            ?>
            <tr class="form-field">
                <th scope="row"><label
                        for="<?php echo esc_attr($field_name); ?>"><?php echo esc_html($field_label); ?></label></th>
                <td>
                    <?php if ($field['type'] === 'title') : ?>
                        <textarea name="<?php echo esc_attr($field_name); ?>" id="<?php echo esc_attr($field_name); ?>"
                                  rows="1"><?php echo esc_textarea($field_value); ?></textarea>
                    <?php else : ?>
                        <textarea name="<?php echo esc_attr($field_name); ?>"
                                  id="<?php echo esc_attr($field_name); ?>"><?php echo esc_textarea($field_value); ?></textarea>
                    <?php endif; ?>
                </td>
            </tr>
            <?php
        }
    }

    function save_custom_taxonomy_fields($term_id, $fields)
    {
        foreach ($fields as $field) {
            $field_name = $field['name'];
            if (isset($_POST[$field_name])) {
                $field_value = wp_kses_post($_POST[$field_name]);
                update_term_meta($term_id, $field_name, $field_value);
            } else {
                delete_term_meta($term_id, $field_name);
            }
        }
    }

    $custom_fields = array(
        array(
            'name' => 'other_posts_category_title',
            'label' => 'Other posts category title',
            'type' => 'title',
        ),
        array(
            'name' => 'other_posts_category_text',
            'label' => 'Other posts category text',
            'type' => 'text',
        ),
    );

    add_action('product_cat_edit_form_fields', function ($term) use ($custom_fields) {
        add_custom_taxonomy_fields($term, $custom_fields);
    });

    add_action('edited_product_cat', function ($term_id) use ($custom_fields) {
        save_custom_taxonomy_fields($term_id, $custom_fields);
    });


    function custom_menu_item_filter($items, $args)
    {
        foreach ($items as $item) {
            $acf_value = get_field('highlight_this_item', $item);

            if ($acf_value === true) {
                $item->title = '<span class="highlight--item">' . $item->title . '</span>';
            }
        }
        return $items;
    }

    add_filter('wp_nav_menu_objects', 'custom_menu_item_filter', 10, 2);

    function add_blog_to_breadcrumb($crumbs)
    {
        if (is_single()) {
            $blogCrumb[] = [
                'label' => 'Blog',
                'link' => get_permalink(get_option('page_for_posts')),
            ];

            array_splice($crumbs, 1, 0, $blogCrumb);
        }

        return $crumbs;
    }

    add_filter('aioseo_breadcrumbs_trail', 'add_blog_to_breadcrumb');

