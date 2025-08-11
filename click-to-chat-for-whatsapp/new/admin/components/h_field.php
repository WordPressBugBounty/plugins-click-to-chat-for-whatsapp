<?php
/**
 * template: hidden fields
 * 
 * @since 3.28
 */

if ( ! defined( 'ABSPATH' ) ) exit;

?>
<input name="<?php echo esc_attr($dbrow) ?>[<?php echo esc_attr($db_key) ?>]" type="hidden" style="display:none;" value="<?php echo esc_attr($db_value) ?>"/>