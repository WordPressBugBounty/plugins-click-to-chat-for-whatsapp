<?php
/**
 * template: hidden fields
 * 
 * @since 3.28
 */

if ( ! defined( 'ABSPATH' ) ) exit;

?>
<input name="<?php echo $dbrow ?>[<?php echo $db_key ?>]" type="hidden" style="display:none;" value="<?php echo $db_value ?>"/>