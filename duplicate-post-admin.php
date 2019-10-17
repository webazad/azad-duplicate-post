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
    duplicate_post_plugin_upgrade();
    //if(get_option('duplicate_post_show_row') == 1){
        add_filter('post_row_actions','duplicate_post_make_duplicate_link_row',10,2);
        add_filter('page_row_actions','duplicate_post_make_duplicate_link_row',10,2);
    //}
    // if(get_site_option('duplicate_post_show_notice') == 1){
    //     if(true){
    //         echo 'asdf';
    //     }
    // }
    // if(get_option('duplicate_post_show_submitbox') == 1){

    // }
    add_action('admin_action_duplicate_post_save_as_new_post','duplicate_post_save_as_new_post');
    add_action('admin_action_duplicate_post_save_as_new_post_draft','duplicate_post_save_as_new_post_draft');
    add_action( 'admin_notices', 'duplicate_post_show_update_notice' );
    // add_filter('plugin_row_meta','duplicate_post_add_plugin_links',10,2);
    add_action('admin_notices','duplicate_post_action_admin_notice');
}

function duplicate_post_save_as_new_post_draft(){
    duplicate_post_save_as_new_post('draft');
}
function duplicate_post_make_duplicate_link_row($actions, $post) {
	$actions['clone'] = '<a href="'.duplicate_post_get_clone_post_link( $post->ID , 'display', false).'" title="'
				. esc_attr__("Clone this item", 'duplicate-post')
                . '">' .  esc_html__('Clone', 'duplicate-post') . '</a>';
    $actions['edit_as_new_draft'] = '<a href="'.duplicate_post_get_clone_post_link( $post->ID).'" title="'
				. esc_attr__("Copy to a new draft", 'duplicate-post')
				. '">' .  esc_html__('New draft', 'duplicate-post') . '</a>';
	return $actions;
}
function duplicate_post_save_as_new_post($status=''){
    $id = (isset($_GET['post'])) ? $_GET['post'] : $_POST['post'];
    check_admin_referer('adp_'.$id);
    // if(! duplicate_post_is_current_user_allowed_to_copy()){
    //     wp_die(esc_html__('Current user is not allowed to copy this post.','azad-duplicate-post'));
    // }
    if(!(isset($_GET['post']) || isset($_POST['post']) || (isset($_REQUEST['action']) && 'duplicate_post_save_as_new_post' == $_REQUEST['action']))){
        wp_die(esc_html__('No post to duplicate has been supplied!','azad-duplicate-post'));
    }
    $post = get_post($id);
    if(isset($post) && $post != null){
        $post_type = $post->post_type;
        $new_id = duplicate_post_create_duplicate($post,$status);
        if($status == ''){
            $sendback = wp_get_referer();
            if(!$sendback || 
                strpos($sendback, 'post.php') !== false || 
                strpos($sendback, 'post-new.php') !== false){
                if('attachment' == $post_type){
    //                 $sendback = admin_url('upload.php');
                }else{
    //                 $sendback = admin_url('edit.php');
    //                 if(! empty($post_type)){
    //                     $sendback = add_query_arg('post_type',$post_type,$sendback);
    //                 }
                }
            }
            wp_redirect(add_query_arg(array('clonedf'=> 1, 'ids'=> $post->ID), $sendback));
        }else{
            wp_redirect(add_query_arg(array('cloned'=> 1, 'ids'=> $post->ID), admin_url('post.php?action=edit&post='.$new_id)));
        }
        exit;
    }else{
        wp_die(esc_html__('Copy creation failed, could not find original: ','azad-duplicate-post') . htmlspecialchars($id));
    }
}
function duplicate_post_create_duplicate($post,$status = '',$parent_id = ''){
    do_action('duplicate_post_pre_copy');
    // if(! duplicate_post_is_post_type_enabled($post->post_type) && $post->post_type != 'attachment'){
    //     wp_die(esc_html__('Copy features for this post type are not enabled in options page.','azad-duplicate-post'));
    //     $new_post_status = (empty($status)) ? $post->post_status : $status;
    // }
    // if($post->post_status != 'attachment'){
    //     $prefix = sanitize_text_field(get_option('duplicate_post_title_prefix'));
    //     $suffix = sanitize_text_field(get_option('duplicate_post_title_suffix'));
    //     $title = '';
    //     if(get_option('duplicate_post_copytitle') == 1){
            $title = $post->post_title;
    //         if(!empty($prefix)) $prefix." ";
    //         if(!empty($suffix)) " " . $suffix;
    //     }else{
    //         $title = '';
    //     }
    //     $title = trim($prefix . $title . $suffix);
    //     if($title == ""){
    //         $title = __('Untitled');
    //     }
    //     if(get_option('duplicate_post_copystatus') == 0){
    //         $new_post_status = 'draft';
    //     }else{
    //         if('publish' == $new_post_status || 'feature' == $new_post_status){
    //             if(is_post_type_hierarchical($post->post_type)){
    //                 if(!current_user_can('publish_pages')){
    //                     $new_post_status = 'pending';
    //                 }
    //             }else{
    //                 if(!current_user_can('publish_posts')){
    //                     $new_post_status = 'pending';
    //                 }
    //             }
    //         }
    //     }
    // }
    $new_post_author = wp_get_current_user();
    $new_post_author_id = $new_post_author->ID;
    // if(get_option('duplicate_post_copy_author') == '1'){
    //     if(is_post_type_hierarchical($post->post_type)){
    //         if(!current_user_can('edit_others_pages')){
    //             $new_post_author_id = $post->post_author;
    //         }
    //     }else{
    //         if(!current_user_can('edit_others_posts')){
    //             $new_post_author_id = $post->post_author;
    //         }
    //     }
    // }
    // $menu_order = (get_option('duplicate_post_copymenuorder') == '1') ? $post->menu_rder : 0;
    // $increase_menu_order_by = get_option('duplicate_post_increase_menu_order_by');
    // if(!empty($increase_menu_order_by) && is_numeric($increase_menu_order_by)){
    //     $menu_order += intval($increase_menu_order_by);
    // }
    $post_name = $post->post_name;
    if(get_option('duplicate_post_copyslug') != 1){
        $post_name = '';
    }
    $new_post = array(
        // 'menu_order' => $menu_order,
        'comment_status' => $post->comment_status,
        'ping_status' => $post->ping_status,
        'post_author' => $new_post_author_id,
        'post_content' => (get_option('duplicate_post_copycontent') == '1') ? $post->post_content : '',
        'post_content_filtered' => (get_option('duplicate_post_copycontent') == '1') ? $post->post_content_filtered : '',
        'post_excerpt' => (get_option('duplicate_post_copyexcerpt') == '1') ? $post->post_excerpt : '',
        'post_mime_type' => $post->post_mime_type,
        // 'post_parent' => $new_post_parent = empty($parent_id) ? $post->post_parent : $parent_id,
        'post_password' => (get_option('duplicate_post_copyepassword') == '1') ? $post->post_password : '',
        // 'post_status' => $new_post_status,
        'post_title' => $title,
        'post_type'=> $post->post_type,
        'post_name' => $post_name
    );
    do_action('duplicate_Post_post_copy');
    $new_post['post_date'] = $new_post_date = $post->post_date;
    $new_post['post_date_gmt'] = get_gmt_from_date($new_post_date);
    $new_post_id = wp_insert_post(wp_slash($new_post));
    return $new_post_id;
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
            $role = get_role($name);
            if(!empty($role)){
                $role->add_cap('copy_posts');
            }
        }
    }else{
        $min_user_level = get_option('duplicate_post_copy_user_level');
        if(! empty($min_user_level)){
            $default_roles = array(
                1 => 'contributor',
                2 => 'author',
                3 => 'editor',
                8 => 'administrator'
            );
            foreach($default_roles as $level => $name){
                $role = get_role($name);
                if($role && $min_user_level <= $level){
                    $role->add_cap('copy_posts');
                }
            }
            delete_option('duplicate_post_copy_user_level');
        }
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
    if(!empty($_REQUEST['clonedf'])){
        $copied_posts = intval($_REQUEST['clonedf']);
        printf('<div id="message" class="updated fade"><p>' . 
        _n('%s item copied.','%s item copied.',$copied_posts,'adp')
         . '</p></div>',$copied_posts);
         remove_query_arg('clonedf');
    }    
}


