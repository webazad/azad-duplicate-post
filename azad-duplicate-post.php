<?php
/* 
Plugin Name: Azad Duplicate Post
Description: The easiest way to duplicate psot.
Plugin URI: gittechs.com/plugin/azad-duplicate-post 
Author: Md. Abul Kalam Azad
Author URI: gittechs.com/author
Author Email: webdevazad@gmail.com
Version: 0.0.0.1
License: GPL2
License URI: http://www.gnu.org/licenses/gpl-2.0.html
Text Domain: azad-duplicate-post
Domain Path: /languages
*/

defined( 'ABSPATH' ) || exit;

use Inc\Activate;
use Inc\Deactivate;

require_once( ABSPATH . 'wp-admin/includes/plugin.php' );
$plugin_data = get_plugin_data( __FILE__ );

define( 'adp_url', plugin_dir_url( __FILE__ ) );
define( 'adp_path', plugin_dir_path( __FILE__ ) );
define( 'adp_plugin', plugin_basename( __FILE__ ) );
define( 'adp_version', $plugin_data['Version'] );
define( 'adp_name', $plugin_data['Name'] );

function activate_azad(){
    Activate::activate();	
}
register_activation_hook(__FILE__,'activate_azad');

function deactivate_azad(){
    Deactivate::deactivate();
}
register_deactivation_hook(__FILE__,'deactivate_azad');

if(file_exists(dirname(__FILE__) . '/vendor/autoload.php')){
    require_once dirname(__FILE__) . '/vendor/autoload.php';
}
if ( class_exists( 'Inc\\Init' ) ) :    
    Inc\Init::register_services();
endif;

/**
 * Initialise the internationalisation domain
 */
function duplicate_post_load_plugin_textdomain() {
    load_plugin_textdomain( 'duplicate-post', FALSE, basename( dirname( __FILE__ ) ) . '/languages/' );
}
add_action( 'plugins_loaded', 'duplicate_post_load_plugin_textdomain' );

function azad_duplicate_post_settings( $actions, $plugin_file, $plugin_data, $context){
    array_unshift($actions,'<a href="' . menu_page_url('ultimatemember', false) . '">' . esc_html('Settings','azad-duplicate-post') . '</a>');
    return $actions;
}
add_filter('plugin_action_links_'.plugin_basename(__FILE__),'azad_duplicate_post_settings',10,4);

require_once(dirname(__FILE__).'/duplicate-post-common.php');

if(is_admin()){
    require_once(dirname(__FILE__).'/duplicate-post-admin.php');
}
