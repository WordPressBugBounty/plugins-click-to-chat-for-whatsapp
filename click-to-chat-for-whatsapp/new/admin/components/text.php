<?php
/**
 * text
 */

if ( ! defined( 'ABSPATH' ) ) exit;

$title = (isset($input['title'])) ? $input['title'] : '';
$description = (isset($input['description'])) ? $input['description'] : '';
$label = (isset($input['label'])) ? $input['label'] : '';
$placeholder = (isset($input['placeholder'])) ? $input['placeholder'] : '';
$parent_class = (isset($input['parent_class'])) ? $input['parent_class'] : '';

?>
<div class="row ctc_component_text <?php echo $parent_class ?>">
    <div class="input-field col s12">
        <input name="<?php echo $dbrow ?>[<?php echo $db_key ?>]" type="text" value="<?php echo $db_value ?>" placeholder="<?php echo $placeholder ?>"/>
        <label for="pre_filled"><?php echo $label ?></label>
        <p class="description"><?php echo $description ?></p>
    </div>
</div>