<?php

function create_custom_cpts() {
    // Cruise CPT
    $cruise_labels = array(
        'name'               => _x('Cruises', 'Post Type General Name', 'textdomain'),
        'singular_name'      => _x('Cruise', 'Post Type Singular Name', 'textdomain'),
        'menu_name'          => __('Cruises', 'textdomain'),
        'all_items'          => __('All Cruises', 'textdomain'),
        'add_new_item'       => __('Add New Cruise', 'textdomain'),
        'edit_item'          => __('Edit Cruise', 'textdomain'),
        'view_item'          => __('View Cruise', 'textdomain'),
        'search_items'       => __('Search Cruises', 'textdomain'),
    );

    $cruise_args = array(
        'label'              => __('Cruise', 'textdomain'),
        'labels'             => $cruise_labels,
        'public'             => true,
        'menu_position'      => 5,
        'menu_icon'          => 'dashicons-location-alt',
        'supports'           => array('title', 'editor', 'thumbnail', 'excerpt', 'custom-fields'),
        'has_archive'        => false, // Disable archive
        'rewrite'            => array('slug' => 'cruises', 'with_front' => false),
        'show_in_rest'       => true,
    );

    register_post_type('cruise', $cruise_args);

    // Destination CPT (New, no longer "location")
    $destination_labels = array(
        'name'               => _x('Destinations', 'Post Type General Name', 'textdomain'),
        'singular_name'      => _x('Destination', 'Post Type Singular Name', 'textdomain'),
        'menu_name'          => __('Destinations', 'textdomain'),
        'all_items'          => __('All Destinations', 'textdomain'),
        'add_new_item'       => __('Add New Destination', 'textdomain'),
        'edit_item'          => __('Edit Destination', 'textdomain'),
        'view_item'          => __('View Destination', 'textdomain'),
        'search_items'       => __('Search Destinations', 'textdomain'),
    );

    $destination_args = array(
        'label'              => __('Destination', 'textdomain'),
        'labels'             => $destination_labels,
        'public'             => true,
        'menu_position'      => 6,
        'menu_icon'          => 'dashicons-admin-site',
        'supports'           => array('title', 'thumbnail', 'excerpt', 'custom-fields'),
        'has_archive'        => true,
        'rewrite'            => array('slug' => 'destinations', 'with_front' => false), // Set slug to 'destinations'
        'show_in_rest'       => true,
    );

    register_post_type('destination', $destination_args); // New post type key is 'destination'
}

add_action('init', 'create_custom_cpts');
