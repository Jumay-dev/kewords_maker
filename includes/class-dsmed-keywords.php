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
        $prefix = $wpdb->get_blog_prefix();
        $table_name = $prefix . 'dsmed_keymaker';
        $dbname = $wpdb->dbname;

        if($_SERVER['REQUEST_METHOD'] === "GET") {
            if($_GET['action'] === 'get_keywords') {
                $result;
                $ans = $wpdb->get_results("SELECT * FROM $table_name", ARRAY_A);
                // die(json_encode($ans));
                if ($ans) {
                    $result['success'] = true;
                    $result['content'] = $ans;
                    die(json_encode($result));
                } else {
                    $result['success'] = false;
                    die(json_encode($result));
                }
            }
            
            if($_GET['action'] === 'delete_keywords') {
                $id = $_GET['id'];
                $result;
                $wpdb->query("DELETE FROM $table_name WHERE id = $id");
                $q = $wpdb->get_row("SELECT * FROM $table_name WHERE id = $id", ARRAY_A);
                if($q) {
                    $result['success'] = false;
                    $result['content'] = $wpdb->get_results("SELECT * FROM $table_name WHERE id = $id", ARRAY_A);
                    die(json_encode($result));
                } else {
                    $ans['success'] = true;
                    $ans['content'] = $wpdb->get_results("SELECT * FROM $table_name", ARRAY_A);
                    die(json_encode($ans));
                }
            }
        }

        if($_SERVER['REQUEST_METHOD'] === "POST") {
            // добавление строки
            if($_POST['action'] === 'add_keywords') {
                if (isset($_POST['query']) && isset($_POST['keywords'])) {
                    $res = $wpdb->insert($table_name, array(
                        'query' => $_POST['query'],
                        'keywords' => $_POST['keywords']
                    ));
                    if($res) {
                        $ans['success'] = true;
                        $ans['content'] = $wpdb->get_results("SELECT * FROM $table_name", ARRAY_A);
                        die(json_encode($ans));
                    } else {
                        $ans['success'] = false;
                        die(json_encode($ans));
                    }
                }
            }

            // изменение строки
            if($_POST['action'] === 'edit_keywords') {
                if (isset($_POST['id']) && isset($_POST['query']) && isset($_POST['keywords'])) {
                    $res = $wpdb->update($table_name, array(
                        'query' => $_POST['query'],
                        'keywords' => $_POST['keywords']
                    ), array('id' => $_POST['id']));
                    if($res) {
                        $ans['success'] = true;
                        $ans['content'] = $wpdb->get_results("SELECT * FROM $table_name", ARRAY_A);
                        die(json_encode($ans));
                    } else {
                        $ans['success'] = false;
                        $ans['content'] = $wpdb->get_results("SELECT * FROM $table_name", ARRAY_A);
                        die(json_encode($ans));
                    }
                } else {
                    die(json_encode('parameters not setted'));
                }
            }
        }

        add_action('wp_head', function() {
            global $wpdb;
            $prefix = $wpdb->get_blog_prefix();
            $table_name = $prefix . 'dsmed_keymaker';
            $current_request = $_SERVER['REQUEST_URI'];
            // echo urldecode($current_request);
            $q_list = $wpdb->get_results("SELECT * FROM $table_name", ARRAY_A);
            echo '<!-- Плагин DS.med keywords-->';
            foreach($q_list as $q_row) {
                if ($q_row['query'] === urldecode($current_request)) {
                    echo '<meta name="keywords" content="' . $q_row['keywords'] . '" />';
                }
            }
            echo '<!-- Конец keywords-->';
        }, 0);
    }
}