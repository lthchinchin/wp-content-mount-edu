<?php
/**
 * 
 * do shortcode content single product 
 *
 */
add_action( 'woocommerce_after_add_to_cart_form', 'func_add_content_after_single_variation_func' ); /*Content below "Add to cart" Button.*/
function func_add_content_after_single_variation_func() {
    echo do_shortcode('[block id="short-contact-block"]');
}
add_action( 'woocommerce_product_meta_end', 'func_add_contact_block', 5 ); /*Content below "Product meta" .*/
function func_add_contact_block() {
   global $product;
   if ( ! $product->get_price() ) {
    echo '<br>';
    echo do_shortcode('[block id="short-contact-block"]');
   }
}
add_action( 'woocommerce_after_single_product', 'func_add_content_after_single_product_func' ); /*Content "After single product".*/
function func_add_content_after_single_product_func() {
    echo do_shortcode('[block id="bai-viet-gan-san-pham"]');
}
add_action( 'ocean_after_archive_product_title', 'func_display_desc_in_product_archives' ); /*Content "Archive product".*/
function func_display_desc_in_product_archives() {
    echo 'sndjasbndjnasdjn';
 }
/*
 * Content below content single posts.
 */
add_filter( 'the_content', 'func_add_shortcode_after_content' );
function func_add_shortcode_after_content( $content ) {    
    if( is_single() ) {
        $content .= '[block id="san-pham-gan-bai"]';
        // echo do_shortcode('[block id="san-pham-gan-bai"]');
    }
    return $content;
}

add_filter( 'gettext', 'my_custom_translations', 20 );
function my_custom_translations( $strings ) {
$text = array(
'Quick View' => 'Xem nhanh',
'SHOPPING CART' => 'Giỏ hàng',
'CHECKOUT DETAILS' => 'Thanh toán',
'ORDER COMPLETE' => 'Hoàn thành'
);

$strings = str_ireplace( array_keys( $text ), $text, $strings );
return $strings;
}
