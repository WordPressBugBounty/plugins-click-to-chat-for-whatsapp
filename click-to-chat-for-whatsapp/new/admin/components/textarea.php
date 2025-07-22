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
<div class="row ctc_component_textarea <?php echo $parent_class ?>">
    <div class="input-field col s12">
        <textarea name="<?php echo $dbrow ?>[<?php echo $db_key ?>]" style="min-height: 84px;" placeholder="<?php echo $placeholder ?>" id="pre_filled" class="materialize-textarea input-margin"><?php echo $db_value ?></textarea>    
        <label for="pre_filled"><?php echo $label ?></label>
        <p class="description"><?php echo $description ?></p>
    </div>
</div>