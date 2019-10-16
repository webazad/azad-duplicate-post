<?php
defined( 'ABSPATH' ) || exit;

function azad_duplicate_post_is_current_user_allowed_to_copy(){
    return current_user_can('copy_posts');
}

function azad_duplicate_post_is_post_type_enabled(){
    $post_types_enabled = get_option('asdf',array());
}

function azad_duplicate_post_get_copy_user_level(){
    return get_option('duplicate_post_copy_user_level');
}
function duplicate_post_get_clone_post_link( $id = 0, $context = 'display', $draft = true){
    if($draft){
        $action_name = 'duplicate_post_save_as_new_post_draft';
    }else{
        $action_name = 'duplicate_post_save_as_new_post';
    }
    if('display' == $context){
        $action = '?action='.$action_name.'&amp;post='.$post->ID;
    }else{
        $action = '?action='.$action_name.'&post='.$post->ID;
    }
    $post_type_object = get_post_type_object($post->post_type);
    if(!$post_type_object){
        return;
    }
    wp_nonce_url(apply_filters('duplicate_post_get_clone_post_link',admin_url('admin.php',$action),$post->ID,$context),'duplicate-post_' . $post->ID);
}

function azad_duplicate_post_clone_post_link($id=0,$context='display',$draft=true){
    if($draft){
        $action_name = 'duplicate_post_save_as_new_post_draft';
    }else{
        $action_name = 'duplicate_post_save_as_new_post';
    }
    if('display' == $context){
        $action = '?action='.$action_name.'&amp;post='.$post->ID;
    }else{
        $action = '?action='.$action_name.'&post='.$post->ID;
    }
    $post_type_object = get_post_type_object($post->post_type);
    if(!$post_type_object){
        return;
    }
    wp_nonce_url(apply_filters('azad_duplicate_post_clone_post_link',));
}

function azad_duplicate_post_get_original(){
    $post_types_enabled = get_option('asdf',array());
}

function duplicate_post_admin_bar_render(){
    if(! is_admin_bar_showing()){
        return;
    }
    global $wp_admin_bar;
    $current_object = get_queried_object();
    if(!empty($current_object)){
        if(true){
            $wp_admin_bar->add_menu(
                array(
                    'id' => 'azad-duplicate-post',
                    'title'=>'Duplicate post Get',
                    'href'=>'asdf'
                )
            );
        }
    }else if(is_admin() && isset($_GET['post'])){
        $id = $_GET['post'];
        $post = get_post($id);
        if(! is_null($post)){
            $wp_admin_bar->add_menu(
                array(
                    'id' => 'azad-duplicate-post',
                    'title'=>'Duplicate post admin',
                    'href'=>'asdf'
                )
            );
        }        
    }else{
        $wp_admin_bar->add_menu(
            array(
                'id' => 'azad-duplicate-post',
                'title'=>'Duplicate postelse',
                'href'=>'asdf'
            )
        );
    }    
}
function duplicate_post_add_css(){
    
}
function duplicate_post_init(){
    add_action('wp_before_admin_bar_render','duplicate_post_admin_bar_render');
    add_action('wp_enqueue_scripts','duplicate_post_add_css');
    add_action('admin_enqueue_scripts','duplicate_post_add_css');
}
add_action('init','duplicate_post_init');