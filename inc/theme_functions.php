<?php

    /*
        =====================
            Get SVG file content
        =====================
    */
    function get_inline_svg($name)
    {
        if ($name) :
            return file_get_contents(esc_url(get_template_directory_uri() . '/src/images/icons/' . $name));
        endif;
        return '';
    }

    function get_cat_terms($category_ids, $taxonomy)
    {
        $sorted_category_ids = array();

        $categories = get_terms(array(
            'taxonomy' => $taxonomy,
            'include' => $category_ids,
            'orderby' => 'parent',
            'order' => 'ASC',
        ));

        foreach ($categories as $category) {
            if ($category->parent == 0) {
                $sorted_category_ids[] = $category->term_id;

                foreach ($categories as $child_category) {
                    if ($child_category->parent == $category->term_id) {
                        $sorted_category_ids[] = $child_category->term_id;
                    }
                }
            }
        }

        foreach ($sorted_category_ids as $category_id) { ?>
            <?php $category = get_term($category_id, $taxonomy); ?>

            <?php $term_color = get_field('category_color', $taxonomy . '_' . $category->term_id); ?>
            <span class="badge <?php echo $term_color; ?>">
                <a href="<?php echo get_term_link($category); ?>"><?php echo $category->name; ?></a>
            </span>
        <?php }

    } ?>
