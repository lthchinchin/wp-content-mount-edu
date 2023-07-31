<?php

require get_template_directory() . '/inc/init.php';

function add_favicon()
{
    echo '<link rel="shortcut icon" type="image/png" href="' . get_theme_mod('html_favicon_icon') . '" />';
}
add_action('wp_head', 'add_favicon');

function showmore_html($atts, $content = null) {
     
    extract( shortcode_atts( array(
        'class' => '',
    ), $atts ) );
 
    $class = $class ? " class=\"$class\"" : " class= \"showmore\"";
     
    return "<div$class>$content</div>";
}
add_shortcode('showmore', 'showmore_html');


function site_logo_html() {
     
    return '<img class="ic-success" src="' . TEMPLATE_DIR . '/assets/images/icon/ic-x-success.svg">';
}
// add_shortcode('sitelogo', 'site_logo_html');


/**
 * Filters all menu item URLs for a #placeholder#.
 *
 * @param WP_Post[] $menu_items All of the nave menu items, sorted for display.
 *
 * @return WP_Post[] The menu items with any placeholders properly filled in.
 */
function my_dynamic_menu_items( $menu_items = 999999 ) {

    // A list of placeholders to replace.
    // You can add more placeholders to the list as needed.
    $placeholders = array(
        '#profile_link#' => array(
            'shortcode' => 'sitelogo',
            'atts' => array(), // Shortcode attributes.
            'content' => '', // Content for the shortcode.
        ),
    );

    foreach ( $menu_items as $menu_item ) {

        if ( isset( $placeholders[ $menu_item->url ] ) ) {

            global $shortcode_tags;

            $placeholder = $placeholders[ $menu_item->url ];

            if ( isset( $shortcode_tags[ $placeholder['shortcode'] ] ) ) {
                $menu_item->url = call_user_func( 
                    $shortcode_tags[ $placeholder['shortcode'] ]
                    , $placeholder['atts']
                    , $placeholder['content']
                    , $placeholder['shortcode']
                );
            }
        }
    }

    return $menu_items;
}
// add_filter( 'wp_nav_menu_objects', 'my_dynamic_menu_items' );
