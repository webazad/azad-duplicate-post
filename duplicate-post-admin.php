<?php
defined( 'ABSPATH' ) || exit;

if(! is_admin()){
    return;
}
require_once(dirname(__FILE__).'/duplicate-post-options.php');
//require_once(dirname(__FILE__).'/compat/duplicate-post-wpml.php');
//require_once(dirname(__FILE__).'/compat/duplicate-post-jetpack.php');

function duplicate_post_get_installed_version(){
    return get_option('azad_duplicate_version');
}

function duplicate_post_get_current_version(){
    return AZAD_DUPLICATE_POST_VERSION;
}

add_action('admin_init','duplicate_post_admin_init');
function duplicate_post_admin_init(){
    duplicate_post_plugin_upgrade();
    if(get_option('duplicate_post_show_row') == 1){

    }
    if(get_site_option('duplicate_post_show_notice') == 1){
        if(true){
            echo 'asdf';
        }
    }
    if(get_option('duplicate_post_show_submitbox') == 1){

    }
    add_action( 'admin_notices', 'duplicate_post_show_update_notice' );
    add_filter('plugin_row_meta','duplicate_post_add_plugin_links',10,2);
    add_action('admin_notices','duplicate_post_action_admin_notice');
}
function duplicate_post_show_update_notice(){
    if(! current_user_can('manage_options')){
        return;
    }
    $class = 'notice is-dismissible';
    $message = '<strong>'.sprintf(__("What\'s new in Duplicdate Post version %s:",'asdf'),adp_version).'</strong><br/>';
    $message .= esc_html__('Fixes for some bugs and incompatibalities with CF7, WPML, custom post types with custom compatibalities.','azad-duplicate-post').'<br/>';
    $message .= '<em><a href="#">'.esc_html__("Checkout the documentation","azad-duplicate-post").'</a> -- ' . sprintf(__('Please <a href="%s"> review the settings </a> to make sure it works as you expect.','azad-duplicate-post'),admin_url('qwer')) . '</em><br/>';
    $message .= esc_html__('Serving the WordPress community since November 2007.','azad-duplicate-post'). sprintf(wp_kses(__('<strong> Help me develop the plugin and provide support by <a href="%s">donating even a small sum.</a></strong>'),array('a'=>array('href'=>array()))),'http://www.gittechs.com');
    global $wp_version;
    if(version_compare($wp_version,'4.2',0)){
        $message .= ' | <a  id="duplicate-post-dismiss-notice" href="javascript:duplicate_post_dismiss_notice();">'.__('Dismiss this notice','azad-duplicate-post').'</a>';
    }
    echo '<div class="wrap notice-warning '.$class.'"><p>' . $message . '</p></div>';
    echo '<script>
        function duplicate_post_dismiss_notice(){
            var data = {
                "action" : "duplicate_post_dismiss_notice"
            };
            jQuery.post(ajaxurl,data,function(response){
                jQuery("#duplicate-post-notice").hide();
            });
        }
        jQuery(document).ready(function(){
            jQuery("body").on("click",".notice-dismiss",function(){
                duplicate_post_dismiss_notice();
            });
        });
    </script>';
}
function duplicate_post_dismiss_notice(){

}
function duplicate_post_plugin_upgrade(){

}
function duplicate_post_add_plugin_links($links,$file){
    if($file == plugin_basename(dirname(__FILE__)) . '/azad-duplicate-post.php'){
        $links[] = '<a href="http://www.gittechs.com">' . esc_html('Documentation','azad-duplicate-post') . '</a>';
        $links[] = '<a href="http://www.gittechs.com">' . esc_html('Donate','azad-duplicate-post') . '</a>';
    }
    return $links;
}

function duplicate_post_action_admin_notice(){
    remove_query_arg('cloned');
}