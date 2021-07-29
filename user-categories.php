<?php

if (!defined('ABSPATH')){
	exit;
}

define('UCAT_DOMAIN','ucla-template-group-site');

function register_user_category_taxonomy(){
	register_taxonomy(
		'user_category',
		'user',
		array(
			'public'=>false,
			'labels'=>array(
				'name'                          => __( 'User Categories ', 'ucla-template-group-site' ),
				'singular_name'                 => __( 'User Category', 'ucla-template-group-site' ),
				'menu_name'                     => __( 'User Category', 'ucla-template-group-site' ),
				'search_items'                  => __( 'Search User Categories', 'ucla-template-group-site' ),
				'all_items'                     => __( 'All User Categories', 'ucla-template-group-site' ),
				'edit_item'                     => __( 'Edit User Category', 'ucla-template-group-site' ),
				'update_item'                   => __( 'Update User Category', 'ucla-template-group-site' ),
				'add_new_item'                  => __( 'Add New User Category', 'ucla-template-group-site' ),
				'new_item_name'                 => __( 'New User Category', 'ucla-template-group-site' ),
	
			),
			'show_ui'           => true,
			'show_in_menu'      => true,
			'show_admin_column' => false,
			'hierarchical'      => true,
			'show_in_rest'      => true,
			'rewrite'           => array(
				'slug'       => __( 'team-member-role', 'ucla-template-group-site' ),
				'with_front' => false,
			),
		)
	);

}

add_action('init','register_user_category_taxonomy');

function register_user_category_taxonomy_admin_page(){
	/*get the taxonomy object for user category*/
	$taxo= get_taxonomy('user_category');
	/*add a new admin page under users to display our taxonomy*/
	add_users_page(
		esc_attr($taxo->labels->menu_name),
		esc_attr($taxo->labels->menu_name),
		$taxo->cap->manage_terms,
		'edit-tags.php?taxonomy='.$taxo->name);
}
add_action('admin_menu','register_user_category_taxonomy_admin_page');
