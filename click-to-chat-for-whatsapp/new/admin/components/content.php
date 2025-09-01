<?php
/**
 * content template
 */

if ( ! defined( 'ABSPATH' ) ) exit;

$title = (isset($input['title'])) ? $input['title'] : '';
$parent_class = (isset($input['parent_class'])) ? $input['parent_class'] : '';
$description = (isset($input['description'])) ? $input['description'] : '';

?>

<div class="row ctc_component_content <?php echo esc_attr($parent_class) ?>">
    <?php

    // title
    if ('' !== $title) {
        ?>
        <p class="description ht_ctc_subtitle"><?php echo esc_html($title); ?></p>
        <?php
    }

    // description
    if ('' !== $description) {
        ?>
        <p class="description"><?php echo wp_kses_post( $description ); ?></p>
        <?php
    }

    ?>
</div>