<?php 
function yoome_child_register_scripts() {
    $parent_style = 'yoome-style';

    wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css', array('yoome-reset') );
    wp_enqueue_style( 'yoome-child-style',
        get_stylesheet_directory_uri() . '/style.css',
        array( $parent_style )
    );
}
add_action( 'wp_enqueue_scripts', 'yoome_child_register_scripts' );