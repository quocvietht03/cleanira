<?php
/**
 * Import pack hooks
 *
 * @package Import Pack
 */

add_action( 'admin_init', 'cleanira_import_pack_defineds' );
add_action( 'admin_menu', 'cleanira_register_import_menu' );
