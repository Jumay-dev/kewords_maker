<?php
/**
 * @link              http://ds-med.ru
 * @since             1.0.0
 * @package           DS.med keywords maker
 *
 * @wordpress-plugin
 * Plugin Name:       DS.med keywords
 * Plugin URI:        https://ds-med.ru/
 * Description:       Добавляет keywords к указаным путям
 * Version:           0.0.1
 * Author:            Jumay-dev
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

function activate_dsmed() {
    require_once plugin_dir_path( __FILE__ ) . 'includes/class-dsmed-keywords-activator.php';
    Dsmed_keywords_Activator::activate();
}

function deactivate_dsmed() {
    require_once plugin_dir_path( __FILE__ ) . 'includes/class-dsmed-keywords-deactivator.php';
    Dsmed_keywords_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_dsmed' );
register_deactivation_hook( __FILE__, 'deactivate_dsmed');


require plugin_dir_path( __FILE__ ) . 'includes/class-dsmed.php';

function run_dsmed() {

	$plugin = new Dsmed();
	$plugin->run();

}
run_dsmed();