<?php
/**
 * 
 * enqueue styles
 *
 */
function my_theme_enqueue_styles() {
    wp_enqueue_style( 'addon-css', get_stylesheet_directory_uri() . '/assets/css/addon.css?v=' . time());
}
add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_styles',100 );
function my_custom_links() {
    ?>
    <link href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Round" rel="stylesheet">
    <!-- <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,300,0,0" /> -->
        <!-- <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet"> -->
        <!-- <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined:opsz,wght,fill,grad@48,300,0,0" rel="stylesheet"> -->
        
    <?php
}
add_action( 'wp_head', 'my_custom_links' );
/**
 * 
 * confs
 *
 */
include "configs/editor-conf.php";
include "configs/unset-image-sizes.php";

echo "WP_112";