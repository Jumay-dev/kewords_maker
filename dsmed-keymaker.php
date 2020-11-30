<?php
/**
 * @link              http://ds-med.ru
 * @since             1.0.0
 * @package           DS.med keywords maker
 *
 * @wordpress-plugin
 * Plugin Name:       DS.Med keywords
 * Plugin URI:        https://ds-med.ru/
 * Description:       Добавляет keywords к указаным путям
 * Version:           0.0.1
 * Author:            Jumay-dev (DS.Med)
 * Author URI:        http://ds-med.ru/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       plugin-name
 * Domain Path:       /languages
 */

if ( ! defined( 'WPINC' ) ) {
	die;
}
wp_enqueue_script("jquery");

function activate_dsmed_keywords() {
    require_once plugin_dir_path( __FILE__ ) . 'includes/class-dsmed-keywords-activator.php';
    Dsmed_keywords_activator::activate();
}

function deactivate_dsmed_keywords() {
    require_once plugin_dir_path( __FILE__ ) . 'includes/class-dsmed-keywords-deactivator.php';
    Dsmed_keywords_deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_dsmed_keywords' );
register_deactivation_hook( __FILE__, 'deactivate_dsmed_keywords');


require_once plugin_dir_path( __FILE__ ) . 'includes/class-dsmed-keywords.php';

function run_dsmed_keywords() {

	$plugin = new Dsmed_keywords();
	$plugin->run();

}
run_dsmed_keywords();