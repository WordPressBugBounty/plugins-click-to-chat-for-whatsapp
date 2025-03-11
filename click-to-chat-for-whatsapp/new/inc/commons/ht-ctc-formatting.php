<?php
/**
 * Formatting API
 * 
 * WooSingle product pages
 * 	update variable values - call to action, prefilled...
 * 
 * @since 3.4
 */

if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Variables.. woocommerce single product pages..
 * 
 * @uses 
 * 
 * @since 3.4
 * @param string $value		input value to convert variables on product page
 */
if ( ! function_exists('ht_ctc_woo_single_product_page_variables') ) {

    function ht_ctc_woo_single_product_page_variables( $value ) {

        // if woocommerce single product page
        if ( function_exists( 'is_product' ) && function_exists( 'wc_get_product' )) {
            if ( is_product() ) {

                $product = wc_get_product();

                $name = $product->get_name();
                // $title = $product->get_title();
                $price = $product->get_price();
                $regular_price = $product->get_regular_price();
                $sku = $product->get_sku();
                $price_formatted = '';
                
                // $price_formatted - get thousand separator, decimal separator, currency symbol
                if ( function_exists( 'wc_price' ) ) {
                    // $price_formatted = strip_tags( wc_price( $price ) );
                    $price_formatted = html_entity_decode( strip_tags( wc_price( $price ) ));
                } else {
                    $price_formatted = $price;
                }

                // variables works in default pre_filled also for woo pages.
                $value = str_replace( array('{product}', '{{price}}', '{price}', '{regular_price}', '{sku}' ),  array( $name, $price_formatted, $price, $regular_price, $sku ), $value );
            }
        }

        return $value;
    }
}