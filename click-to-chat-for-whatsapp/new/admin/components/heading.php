<?php
/**
 * @deprecated 4.15 favor of new/admin/components/content.php - $title
 */

if ( ! defined( 'ABSPATH' ) ) exit;

$title = (isset($input['title'])) ? $input['title'] : '';
$parent_class = (isset($input['parent_class'])) ? $input['parent_class'] : '';

?>

<div class="row ctc_component_heading <?php echo $parent_class ?>">
    <p class="description ht_ctc_subtitle"><?php _e( $title, 'click-to-chat-for-whatsapp' ); ?> </p>
</div>