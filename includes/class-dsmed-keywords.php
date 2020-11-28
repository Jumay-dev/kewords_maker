<?php

class Dsmed_keywords {
    protected $dsmed_keywords_name;
    protected $dsmed_keywords_version;

    public function __construct() {
        if ( defined( 'PLUGIN_NAME_VERSION' ) ) {
			$this->dsmed_keywords_version = PLUGIN_NAME_VERSION;
		} else {
			$this->dsmed_keywords_version = '0.0.1';
        }
        $this->dsmed_keywords_name = 'DS.med keywords';
        $this->load_depedences();
        $this->define_admin_hooks();
    }

    private function define_admin_hooks() {
        $plugin_admin = new Dsmed_keywords_admin();
    }

    public function load_depedences() {
        require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-dsmed-keywords-admin.php';
    }

    public function run() {
        global $wpdb;
    }
}