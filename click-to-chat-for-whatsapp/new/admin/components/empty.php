<?php
/**
 * empty field. hidden type.. useful to save some value in table instead of keeping empty. to prevent some errors
 */

if ( ! defined( 'ABSPATH' ) ) exit;

$db_value = '1';
?>
<input name="<?php echo $dbrow ?>[<?php echo $db_key ?>]" type="text" hidden style="display:none;" value="<?php echo $db_value ?>"/>