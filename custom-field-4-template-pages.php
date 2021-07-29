<?php
function  home_add_meta_boxes(){

/*Get the page template post meta*/

$page_template =  get_post_meta($post->ID, '_wp_page_template', true);

/*If the  current page uses a specific template, output matching meta field*/

if('home-template.php'==$page_template){
	add_meta_box(
		'home-custom-metabox',
		'Home Page Details',
		'home_custom_metabox',
		'page',
		'advanced',
		'default',
	);
}
	
}
add_action('add_meta_boxes_page',  'home_add_meta_boxes');

function home_save_meta_boxes(){
	global $post;
	if (defined('DOING_AUTOSAVE')&& DOING_AUTOSAVE){return;}
	/*title*/
	update_post_meta($post->ID, "home_title",sanitize_text_field($_POST["home_title"]));
	/*subtitle*/
	 update_post_meta($post->ID, "home_subtitle",sanitize_text_field($_POST["home_subtitle"]));
}

function home_display_meta_boxes(){
	global  $post;
	$custom = get_post_custom($post->ID);
	/*title*/
	?> <b>Research Group Name: </b><?php
	$home_field_data_title = $custom["title"][0]; 
	echo "<input type=\"text\" name=\"home_title\" value=\"".$home_field_data_title."\" placeholder=\"Research Group Name\">";?><br><?php
		/*title*/
        ?> <b>Department Name: </b><?php
        $home_field_data_subtitle = $custom["subtitle"][0];
        echo "<input type=\"text\" name=\"home_subtitle\" value=\"".$home_field_data_subtitle."\" placeholder=\"Department Name\">";?><br><?php
}

add_action('publish_page',' home_save_meta_boxes');
add_action('draft_page',' home_save_meta_boxes');
add_action('future_page',' home_save_meta_boxes');

function  contact_add_meta_boxes(){

/*Get the page template post meta*/

$page_template =  get_post_meta($post->ID, '_wp_page_template', true);

/*If the  current page uses a specific template, output matching meta field*/

if('contact-template.php'==$page_template){
        add_meta_box(
                'contact-custom-metabox',
                'Contact Page Details',
                'contact_custom_metabox',
                'page',
                'advanced',
                'default',
        );
}

}
add_action('add_meta_boxes_page',  'contact_add_meta_boxes');

function contact_save_meta_boxes(){
}

function contact_display_meta_boxes(){
}

add_action('publish_page',' contact_save_meta_boxes');
add_action('draft_page',' contact_save_meta_boxes');
add_action('future_page',' contact_save_meta_boxes');
