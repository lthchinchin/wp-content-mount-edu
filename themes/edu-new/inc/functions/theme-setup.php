<?php

function resdii_theme_setup()
{

    // Add theme support.
    add_theme_support('automatic-feed-links');
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('html5', array('comment-list', 'comment-form', 'search-form', 'gallery', 'caption'));
    add_theme_support('woocommerce');

    // Disables the block editor.
    add_filter('use_block_editor_for_post', '__return_false');
    add_filter('use_widgets_block_editor', '__return_false');

    // Register nav menu.
    register_nav_menus(array(
        'primary'   => __('Primary Menu', 'RESDII'),
        'secondary' => __('Secondary Menu', 'RESDII'),
        'footer' => __('Footer Menu', 'RESDII'),
        'menu_mobile'    => __('Menu Mobile', '' . Theme_Name . ''),
        'footer1'        => __('Footer 1 Menu', '' . Theme_Name . ''),
        'footer2'        => __('Footer 2 Menu', '' . Theme_Name . ''),
        'footer3'        => __('Footer 3 Menu', '' . Theme_Name . '')
        ));

    // Create ACF Plugin theme options
    if (function_exists('acf_add_options_page')) {
        acf_add_options_page(array(
            'page_title' => __('Cài đặt Website', 'RESDII'),
            'menu_title' => __('Cài đặt Website', 'RESDII'),
            'menu_slug'  => 'theme-settings',
            'capability' => 'manage_options',
            'redirect'   => false
        ));
    }

    // Hide admin bar
    show_admin_bar(false);

    
}
add_action('after_setup_theme', 'resdii_theme_setup');

function resdii_theme_widget()
{

    if (function_exists('register_sidebar')) {
        register_sidebar(array(
            'name'          => __('Sidebar', 'RESDII'),
            'id'            => 'RESDII-sidebar',
            'before_widget' => '<aside id="%1$s" class="widget %2$s">',
            'after_widget'  => '</aside>',
            'before_title'  => '<h4 class="widget-title">',
            'after_title'   => '</h4>',
        ));
    }
}
add_action('widgets_init', 'resdii_theme_widget');

function resdii_theme_scripts()
{
    $uri = get_template_directory_uri();
    $slug = get_queried_object()->post_name;
    $home = get_home_url();
    // CSS
    wp_enqueue_style('bootstrap-style', $uri . '/assets/libs/bootstrap/css/bootstrap.min.css', array(), THEME_VER);
    wp_enqueue_style('video-js-css', $uri . '/assets/libs/videojs/video.min.css', array(), THEME_VER);
    wp_enqueue_style('swiper-css', $uri . '/assets/libs/swiper/swiper-bundle.min.css', array(), THEME_VER);
    wp_enqueue_style('aos-animate', $uri . '/assets/libs/aos/aos.css', array(), THEME_VER);
    wp_enqueue_style('fontawesome', $uri . '/assets/libs/fontawesome/all.min.css', array(), THEME_VER);
    if(!IS_MOBILE){
    wp_enqueue_style('mmenujs', $uri . '/assets/libs/mmenujs/css/mmenu.min.css', array(), THEME_VER, 'all');
    }
    wp_enqueue_style('style', $uri . '/assets/css/style.css', array(), THEME_VER);

    // JS
    wp_enqueue_script('hcsticky-script', $uri . '/assets/libs/hc-sticky/hc-sticky.js', array(), THEME_VER, true);
    wp_enqueue_script('bootstrap-script', $uri . '/assets/libs/bootstrap/js/bootstrap.bundle.min.js', array(), THEME_VER, true);
    wp_enqueue_script('video-js-script', $uri . '/assets/libs/videojs/video.min.js', array(), THEME_VER, true);
    wp_enqueue_script('aos-script', $uri . '/assets/libs/aos/aos.js', array(), THEME_VER, true);
    wp_enqueue_script('swiper-script', $uri . '/assets/libs/swiper/swiper-bundle.min.js', array(), THEME_VER, true);
    if(!IS_MOBILE){
        wp_enqueue_script('mmenujs', $uri . '/assets/libs/mmenujs/js/mmenu.min.js', array(), THEME_VER, true);
    }
    // wp_enqueue_script('common-script', $uri . '/assets/js/common.js', array('jquery'), THEME_VER, true);
    wp_enqueue_script('scroll-script', $uri . '/assets/js/jquery.scrollintoview.js', array('jquery'), THEME_VER, true);
    wp_enqueue_script('main-script', $uri . '/assets/js/main.js', array('jquery'), THEME_VER, true);
    wp_localize_script('main-script', 'MYSCRIPT', 
    array(
        'ajaxUrl' => admin_url('admin-ajax.php'), 
        'themeDirUrl' => $uri, 
        'currentSlug'=> $slug, 
        'home_url' => $home,
        'islogged' => is_user_logged_in(),
        'currentUser' => get_current_user_id(),
        'isMobileMode' => IS_MOBILE,
        'DEV_MODE' => true,
    ));
}

add_action('wp_enqueue_scripts', 'resdii_theme_scripts');

/**
 * Disable the emoji's
 */
function disable_emojis()
{
    remove_action('wp_head', 'print_emoji_detection_script', 7);
    remove_action('admin_print_scripts', 'print_emoji_detection_script');
    remove_action('wp_print_styles', 'print_emoji_styles');
    remove_action('admin_print_styles', 'print_emoji_styles');
    remove_filter('the_content_feed', 'wp_staticize_emoji');
    remove_filter('comment_text_rss', 'wp_staticize_emoji');
}
add_action('init', 'disable_emojis');