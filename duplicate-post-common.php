<?php
defined( 'ABSPATH' ) || exit;

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
function duplicate_post_init(){
    add_action('wp_before_admin_bar_render','duplicate_post_admin_bar_render');
}
add_action('init','duplicate_post_init');