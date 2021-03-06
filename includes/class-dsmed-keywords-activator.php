<?php

class Dsmed_keywords_activator {
    public static function activate() {
        defined('ABSPATH') or die('Абсолютного пути не существует(db)');

        // Создаем таблицу для хранения значений
        global $wpdb;
        $pref = $wpdb->get_blog_prefix();
        $table_name = $pref . 'dsmed_keymaker';
        $charset_collate = "DEFAULT CHARACTER SET $wpdb->charset COLLATE $wpdb->collate";
        require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );

        $keymaker_table = "CREATE TABLE $table_name (
            id int(11) unsigned NOT NULL auto_increment,
            query text(200),
            keywords text(10000),
            PRIMARY KEY  (id),
            KEY id (id)
            ) $charset_collate;";

        dbDelta( $keymaker_table );
        return TRUE;
    }
}