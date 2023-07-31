<?php
/**
 * Create wp_varsvote_favorites table
 */
function varsvote_db_create_favorite_table_full()
{
    global $wpdb;
    $charset_collate = $wpdb->get_charset_collate();
    $table_name  = $wpdb->prefix . 'varsvote_favorites';
    $create_table = "CREATE TABLE IF NOT EXISTS `{$table_name}` (
        `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
        `username` varchar(255) NOT NULL,
        `email` varchar(255) NOT NULL,
        `phone_number` varchar(20) NOT NULL,
        -- `policy_confirmation` boolean NOT NULL DEFAULT FALSE,
        `user_ip` varchar(45) NOT NULL,
        `post_id` bigint(20) UNSIGNED NOT NULL,
        `date` timestamp NOT NULL,
        PRIMARY KEY (id),
        FOREIGN KEY (`post_id`) REFERENCES {$wpdb->prefix}posts(`ID`) ON DELETE CASCADE ON UPDATE CASCADE
    ) {$charset_collate};";
    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($create_table);
}
add_action('admin_init', 'varsvote_db_create_favorite_table_full');
// add_action('admin_init', 'varsvote_db_create_favorite_table_EXT');
