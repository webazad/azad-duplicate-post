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
    return adp_version;
}

add_action('admin_init','duplicate_post_admin_init');
function duplicate_post_admin_init(){
    //duplicate_post_plugin_upgrade();
    //if(get_option('duplicate_post_show_row') == 1){
        add_filter('post_row_actions','duplicate_post_make_duplicate_link_row',10,2);
        //add_filter('page_row_actions','duplicate_post_make_duplicate_link_row',10,2);
    //}
    if(get_site_option('duplicate_post_show_notice') == 1){
        if(true){
            echo 'asdf';
        }
    }
    if(get_option('duplicate_post_show_submitbox') == 1){

    }
    add_action('admin_action_duplicate_post_save_as_new_post','duplicate_post_save_as_new_post');
    // add_action( 'admin_notices', 'duplicate_post_show_update_notice' );
    // add_filter('plugin_row_meta','duplicate_post_add_plugin_links',10,2);
    // add_action('admin_notices','duplicate_post_action_admin_notice');
}

function duplicate_post_save_as_new_post_draft(){
    duplicate_post_save_as_new_post('draft');
}
function duplicate_post_save_as_new_post(){
    
}
function duplicate_post_plugin_upgrade(){
    $installed_version = duplicate_post_get_installed_version();

    if($installed_version = duplicate_post_get_current_version()){
        return;
    }

    if( empty($installed_version)){
        $default_roles = array(
            3 => 'editor',
            8 => 'administrator'
        );
        foreach($default_roles as $level => $name){

        }
    }else{

    }

    add_option('duplicate_post_copytitle','1');
    add_option('duplicate_post_copydate','0');
    add_option('duplicate_post_copystatus','0');
    add_option('duplicate_post_copyslug','0');
    add_option('duplicate_post_copyexcerpt','1');
    add_option('duplicate_post_copycontent','1');
    add_option('duplicate_post_copythumbnail','1');
    add_option('duplicate_post_copytemplate','1');
    add_option('duplicate_post_copyformat','1');
    add_option('duplicate_post_copyauthor','0');
    add_option('duplicate_post_copypassword','0');
    add_option('duplicate_post_copyattachments','0');
    add_option('duplicate_post_copychildren','0');
    add_option('duplicate_post_copycomments','0');
    add_option('duplicate_post_copymenuorder','1');
    add_option('duplicate_post_taxonomies_blacklist',array());
    add_option('duplicate_post_blacklist','');
    add_option('duplicate_post_types_enabled',array('post','page'));
    add_option('duplicate_post_show_row','1');
    add_option('duplicate_post_show_adminbar','1');
    add_option('duplicate_post_show_submitbox','1');
    add_option('duplicate_post_show_bulkactions','1');
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

function duplicate_post_make_duplicate_link_row($actions,$post){
    if(true){
        $actions['clone'] = '<a href="'. duplicate_post_get_clone_post_link($post->ID,'display',false) .'" title="'. esc_attr__('Clone this item','azad-duplicate-post') .'">'. esc_html__('Clone','azad-duplicate-post') .'</a>';
    }
    return $actions;
}
