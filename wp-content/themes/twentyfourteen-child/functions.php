<?php

require_once ('inc/widget-fx-simple.php');
require_once ('inc/widget-fx-carousel.php');
require_once ('inc/widget-fx-conversion.php');

add_action( 'wp_enqueue_scripts', 'enqueue_my_styles' );
add_action( 'wp_enqueue_scripts', 'enqueue_my_scripts');

function enqueue_my_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri().'/style.css' );
    wp_enqueue_style( 'bootstrap', '//stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css');
}

function enqueue_my_scripts() {
    wp_enqueue_script( 'widget-script', get_stylesheet_directory_uri().'/js/widget.js', array( 'jquery' ), '1.0.0', true  );
}


add_action( 'widgets_init', 'my_register_sidebars' );
function my_register_sidebars() {
    
    for ($sidebars = 1; $sidebars <=3; $sidebars++){
        register_sidebar(
            array(
                'id'            => 'sidebar-footer-'.$sidebars,
                'name'          => 'Sidebar Footer '.$sidebars,
                'description'   => 'Sidebar '. $sidebars .'in the footer.',
            )
        );
    }         
}
