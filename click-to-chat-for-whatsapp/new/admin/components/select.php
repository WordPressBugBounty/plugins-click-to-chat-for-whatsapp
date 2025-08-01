<?php
/**
 * Color
 * 
 * 
 * list - is an array of values.. adding direclty..
 * list_cb - get from ht-h-list.php
 */

if ( ! defined( 'ABSPATH' ) ) exit;

$title = (isset($input['title'])) ? $input['title'] : '';
$description = (isset($input['description'])) ? $input['description'] : '';
$parent_class = (isset($input['parent_class'])) ? $input['parent_class'] : '';
$parent_id = (isset($input['parent_id'])) ? $input['parent_id'] : '';
$select_class = (isset($input['select_class'])) ? $input['select_class'] : '';

// list
$list = [];

if (isset($input['list'])) {
    $list = $input['list'];
} elseif (isset($input['list_cb'])) {
    $list_cb = $input['list_cb'];

    $lists_file = plugin_dir_path( HT_CTC_PLUGIN_FILE ) . 'new/admin/components/list/ht-ctc-admin-list-page.php';
    if ( is_file( $lists_file ) ) {
        include_once $lists_file;
        $lists_instance = HT_CTC_Admin_List_Page::instance();
        $list = ( class_exists('HT_CTC_Admin_List_Page') && method_exists('HT_CTC_Admin_List_Page',$list_cb) ) ? $lists_instance->$list_cb() : [];
    }

}

?>
<div class="row ctc_component_select <?php echo $parent_class ?>" id="<?php echo $parent_id ?>" style="margin:0;">
    <?php
    if ( '' !== $title ) {
    ?>
    <p class="description"><?php _e( $title, 'click-to-chat-for-whatsapp' ); ?> </p>
    <?php
    }
    ?>
    <div class="row">
        <div class="input-field col s12">
            <select name="<?php echo $dbrow ?>[<?php echo $db_key ?>]" class="<?php echo $select_class ?>">
                <?php
                foreach ($list as $k => $v) {
                    ?>
                    <option value="<?php echo $k ?>" <?php echo $db_value == $k ? 'SELECTED' : ''; ?> ><?php echo $v ?></option>
                    <?php
                }
                ?>
            </select>
            <p class="description"><?php echo $description ?></p>
        </div>
    </div>
</div>