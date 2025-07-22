<?php
/**
 * REST API for Click to Chat for WhatsApp
 * 
 * Provides REST endpoints to get plugin settings data:
 * - /get_ht_ctc_chat_var      : Returns chat-related settings
 * - /get_ht_ctc_variables     : Returns all variables/settings
 *
 * @package Click to Chat for WhatsApp
 * @since 4.23
 * 
 * stub file. 
 *  commented the initilization and at 
 *      admin.php where this file is included.
 *      initialization at the end of this file.
 *      constructor
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! class_exists( 'HT_CTC_Rest_API' ) ) :

class HT_CTC_Rest_API {

    // public function __construct() {
    //     $this->init();
    // }

    /**
     * Initialize REST API endpoints.
     */
    public function init() {
        add_action( 'rest_api_init', [ $this, 'register_routes' ] );
    }

    /**
     * Register REST routes.
     */
    public function register_routes() {

        register_rest_route( 'click-to-chat-for-whatsapp/v1', '/get_ht_ctc_chat_var', [
            'methods'             => 'GET',
            'callback'            => [ $this, 'get_ht_ctc_chat_var' ],
            'permission_callback' => '__return_true',
        ] );

        register_rest_route( 'click-to-chat-for-whatsapp/v1', '/get_ht_ctc_variables', [
            'methods'             => 'GET',
            'callback'            => [ $this, 'get_ht_ctc_variables' ],
            'permission_callback' => '__return_true',
        ] );
    }

    /**
     * Endpoint: /get_ht_ctc_chat_var
     * Returns WhatsApp chat configuration variables.
     */
    public function get_ht_ctc_chat_var( $request ) {

        // Load security class only when needed — prevents auto-executing code in files
        require_once HT_CTC_PLUGIN_DIR . 'new/inc/commons/class-ht-ctc-security.php';

        // Validate request via referer, nonce, and user-agent checks
        $check = HT_CTC_Security::validate_rest_request( $request );
        if ( $check !== true ) {
            return $check;
        }

        // Load settings data class only after validation
        require_once HT_CTC_PLUGIN_DIR . 'new/inc/commons/class-ht-ctc-settings-data.php';
        $data = HT_CTC_Settings_Data::get_ht_ctc_chat_var();

        return rest_ensure_response( $data );
    }

    /**
     * Endpoint: /get_ht_ctc_variables
     * Returns all plugin variables/settings.
     */
    public static function get_ht_ctc_variables( $request ) {

        // Load security class only when needed — avoids early side effects
        require_once HT_CTC_PLUGIN_DIR . 'new/inc/commons/class-ht-ctc-security.php';

        // Validate request via referer, nonce, and user-agent checks
        $check = HT_CTC_Security::validate_rest_request( $request );
        if ( $check !== true ) {
            return $check;
        }

        // Load settings data class only after validation
        require_once HT_CTC_PLUGIN_DIR . 'new/inc/commons/class-ht-ctc-settings-data.php';
        $data = HT_CTC_Settings_Data::get_ht_ctc_variables();

        return rest_ensure_response( $data );
    }

}

// stub for HT_CTC_Rest_API instance
// new HT_CTC_Rest_API(); // Optional: You can auto-init elsewhere

endif; // End class check