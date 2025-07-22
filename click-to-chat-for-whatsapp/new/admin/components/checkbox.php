<?php
/**
 * checkbox
 */

if ( ! defined( 'ABSPATH' ) ) exit;

$title = (isset($input['title'])) ? esc_attr($input['title']) : '';
$parent_class = (isset($input['parent_class'])) ? $input['parent_class'] : '';
$label = (isset($input['label'])) ? $input['label'] : '';
$description = (isset($input['description'])) ? $input['description'] : '';



?>
<div class="row ctc_component_checkbox <?php echo $parent_class ?>">
    <div class="input-field col s12">
        <p>
            <label class="ctc_checkbox_label">
                <input name="<?php echo $dbrow ?>[<?php echo $db_key ?>]" type="checkbox" class="<?php echo $db_key ?>" value="1" <?php checked( $db_value, 1 ); ?> />
                <span><?php echo $title ?></span>
            </label>
        </p>
        <?php
        if ('' !== $description) {
            ?>
            <p class="description"><?php echo $description ?></p>
            <?php
        }
        ?>
    </div>
</div>