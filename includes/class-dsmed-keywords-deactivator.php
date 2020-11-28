<?php

class Dsmed_keywords_deactivator {
    public static function deactivate() {
        global $wpdb;
        defined('ABSPATH') or die('Абсолютного пути не существует(db)');
        $pref = $wpdb->get_blog_prefix();
        $table_name = $pref . 'dsmed_keymaker';
        $charset_collate = "DEFAULT CHARACTER SET $wpdb->charset COLLATE $wpdb->collate";
        require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );

        $delete_keymaker_table = "DROP TABLE '$table_name'";
        $wpdb->query($delete_keymaker_table);
    }
}