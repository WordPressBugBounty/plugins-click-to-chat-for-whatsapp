<?php
/**
 * template: add element details and summary - end
 * @since 3.35
 */
if ( ! defined( 'ABSPATH' ) ) exit;

$title = (isset($input['title'])) ? esc_attr($input['title']) : '';
$description = (isset($input['description'])) ? $input['description'] : '';
?>

<details class="ctc_details">
    <summary style="margin-bottom:8px;"><?php echo $title ?></summary>