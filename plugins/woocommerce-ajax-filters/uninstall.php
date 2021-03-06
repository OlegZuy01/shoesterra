<?php
/**
 * Fired when the plugin is uninstalled.
 *
 * When populating this file, consider the following flow
 * of control:
 *
 * - This method should be static
 * - Check if the $_REQUEST content actually is the plugin name
 * - Run an admin referrer check to make sure it goes through authentication
 * - Verify the output of $_GET makes sense
 * - Repeat with other user roles. Best directly by using the links/query string parameters.
 * - Repeat things for multisite. Once for a single site in the network, once sitewide.
 *
 * This file may be updated more in future version of the Boilerplate; however, this is the
 * general skeleton and outline for how the file should work.
 *
 * For more information, see the following discussion:
 * https://github.com/tommcfarlin/WordPress-Plugin-Boilerplate/pull/123#issuecomment-28541913
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    Plugin_Name
 */
// If uninstall not called from WordPress, then exit.
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	exit;
}
global $wpdb;
//Delete Variations table
$table_name = $wpdb->prefix . 'braapf_product_stock_status_parent';
$sql = "DROP TABLE IF EXISTS {$table_name};";
$wpdb->query($sql);
$table_name = $wpdb->prefix . 'braapf_product_variation_attributes';
$sql = "DROP TABLE IF EXISTS {$table_name};";
$wpdb->query($sql);
delete_option('BeRocket_aapf_variations_tables_addon_ready');
//Delete Hierarchical table
$table_name = $wpdb->prefix . 'braapf_term_taxonomy_hierarchical';
$sql = "DROP TABLE IF EXISTS {$table_name};";
$wpdb->query($sql);
delete_option('BeRocket_aapf_hierarchical_tables_addon_ready');
if ( defined( 'BR_AAPF_REMOVE_ALL_DATA' ) && true === BR_AAPF_REMOVE_ALL_DATA ) {
    
}
