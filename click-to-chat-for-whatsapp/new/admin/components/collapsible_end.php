<?php
/**
 * collapsible - end code
 * 
 */

if ( ! defined( 'ABSPATH' ) ) exit;

$description = (isset($input['description'])) ? $input['description'] : '';

if ('' !== $description) {
    ?>
    <p class="description"><?php echo $description ?></p>
    <?php
}
?>

</div>
</li>
</ul>