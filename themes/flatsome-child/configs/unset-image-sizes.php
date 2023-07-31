<?php
function remove_default_image_sizes( $sizes ) {

    /* Default WordPress */
    unset( $sizes[ 'thumbnail' ]);       
    unset( $sizes[ 'scaled' ]); 


    // unset( $sizes[ 'woocommerce_single' ]);  
    // unset( $sizes[ 'woocommerce_thumbnail' ]);
    // unset( $sizes[ 'woocommerce_gallery_thumbnail' ]);
  
    /* With WooCommerce */
    // unset( $sizes[ 'shop_thumbnail' ]);  // Remove Shop thumbnail (180 x 180 hard cropped)
    // unset( $sizes[ 'shop_catalog' ]);    // Remove Shop catalog (300 x 300 hard cropped)
    // unset( $sizes[ 'shop_single' ]);     // Shop single (600 x 600 hard cropped)
  
    return $sizes;
  }
  
  add_filter( 'intermediate_image_sizes_advanced', 'remove_default_image_sizes' );