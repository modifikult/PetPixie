<?php
    /**
     * Shop breadcrumb
     *
     * This template can be overridden by copying it to yourtheme/woocommerce/global/breadcrumb.php.
     *
     * HOWEVER, on occasion WooCommerce will need to update template files and you
     * (the theme developer) will need to copy the new files to your theme to
     * maintain compatibility. We try to do this as little as possible, but it does
     * happen. When this occurs the version of the template file will be bumped and
     * the readme will list any important changes.
     *
     * @see         https://docs.woocommerce.com/document/template-structure/
     * @package     WooCommerce\Templates
     * @version     2.3.0
     * @see         woocommerce_breadcrumb()
     */

    if (!defined('ABSPATH')) {
        exit;
    }

    if (is_singular('product')) {
        $parent_category = '';
        $child_categories = '';
        $terms = wp_get_post_terms(get_the_ID(), 'product_cat', array('fields' => 'all'));

        foreach ($terms as $term) {
            if ($term->parent > 0 && $term->name !== 'Sale') {
                $child_categories = $term;
            } else if($term->name !== 'Sale') {
                $parent_category = $term;
            }
        }
    } else {
        $page_obj = get_queried_object();
        $page_link = get_permalink($page_obj->ID);
        $page_title = $page_obj->post_title;
    }

?>

<?php //echo '<pre>';?>
<?php //print_r($page_obj) ;?>
<?php //echo '</pre>';?>


<nav class="woocommerce-breadcrumb">
    <a href="<?php echo get_home_url(); ?>"><i class="bi bi-house-door-fill"></i><?php _e('Home'); ?></a>
    <?php if ($parent_category) : ?>
        <a href="<?php echo esc_url(get_term_link($parent_category)); ?>"><?php echo esc_attr($parent_category->name); ?></a>
    <?php endif; ?>
    <?php if ($child_categories) : ?>
        <a href="<?php echo esc_url(get_term_link($child_categories)); ?>"><?php echo esc_attr($child_categories->name); ?></a>
    <?php endif; ?>
    <?php if ($page_obj) : ?>
        <a href="<?php echo esc_url($page_link); ?>"><?php echo esc_attr($page_title); ?></a>
    <?php endif; ?>
</nav>
