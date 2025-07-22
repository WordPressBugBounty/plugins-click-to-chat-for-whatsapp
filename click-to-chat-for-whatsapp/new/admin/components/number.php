<?php
/**
 * number
 */

if ( ! defined( 'ABSPATH' ) ) exit;

$title = (isset($input['title'])) ? esc_attr($input['title']) : '';
$description = (isset($input['description'])) ? esc_attr($input['description']) : '';
$label = (isset($input['label'])) ? esc_attr($input['label']) : '';
$placeholder = (isset($input['placeholder'])) ? esc_attr($input['placeholder']) : '';

$min = (isset($input['min'])) ? esc_attr($input['min']) : '';
$parent_class = (isset($input['parent_class'])) ? $input['parent_class'] : '';

$attr = '';

if ('' !== $min) {
    $attr .= " min=$min ";
}

?>
<div class="row ctc_component_number <?php echo $parent_class ?>">
    <div class="input-field col s12">
        <input name="<?php echo $dbrow ?>[<?php echo $db_key ?>]" type="number" <?php echo $attr ?> value="<?php echo $db_value ?>" placeholder="<?php echo $placeholder ?>"/>
        <label for="pre_filled"><?php echo $label ?></label>
        <p class="description"><?php echo $description ?></p>
    </div>
</div>