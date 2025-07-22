<?php
/**
 * 
 * 
 */


if ( ! defined( 'ABSPATH' ) ) exit;

if ( ! class_exists( 'HT_CTC_Security' ) ) :

class HT_CTC_Security {


    /**
     * Checks referer, nonce, and optionally bounce (custom logic).
     * 
     * @param WP_REST_Request $request
     * @return WP_REST_Response|true
     */
    public static function validate_rest_request($request) {

        try { 
            $site_url = get_site_url();
            $referer = isset($_SERVER['HTTP_REFERER']) ? esc_attr($_SERVER['HTTP_REFERER']) : '';

            // Referer check
            if (strpos($referer, $site_url) === false) {
                return new WP_REST_Response(['error' => 'Invalid referer'], 403);
            }

            // Nonce check (optional, only if frontend sends it)
            $nonce = $request->get_header('x_wp_nonce');
            
            // ht_ctc_nonce
            if (! wp_verify_nonce($nonce, 'wp_rest')) {
                return new WP_REST_Response(['error' => 'Invalid nonce'], 403);
            }

            // Optional: Bounce or User-Agent logic (custom abuse logic)
            $user_agent = isset($_SERVER['HTTP_USER_AGENT']) ? esc_attr($_SERVER['HTTP_USER_AGENT']) : '';
            if (empty($user_agent)) {
                return new WP_REST_Response(['error' => 'Invalid user agent'], 403);
            }

        } catch (Throwable $e) {
            return new WP_REST_Response(['Catch: error' => 'Server error'], 500);
        }
        
        return true; // All checks passed
    }



}

// new HT_CTC_Security();

endif; // END class_exists check