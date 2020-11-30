<?php

class Dsmed_keywords_admin {
    public function __construct() {
        add_action("admin_menu", array($this, "options_page"));
    }

    public function options_page() {
        add_options_page(
            "DS.Med keywords",
            "DS.Med keywords",
            "manage_options",
            "import_options",
            array($this, 'render')
        );
    }

    public function render() {
        include plugin_dir_path(dirname(__FILE__)) . 'admin/index.html';
    }
}