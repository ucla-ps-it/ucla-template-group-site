<?php
/**
 * Plugin Name: UCLA Template Group Site
 * Description: Plugin to allow UCLA Group to create their website
 * Version: 0.0.1
 * Author: Yasmine Khadija Talby
 * */

/**
 *
 * AUTHOR CUSTOM POST TYPE
 *
 * */

// Prevent public user to directly access this file
if (!defined('ABSPATH')) {
        exit;
}

//set the constant TEMP_DOMAIN as ucla-template-group-site
define( 'TEMP_DOMAIN', 'ucla-template-group-site');
function additional_custom_styles() {

    /* Enqueue The Styles */
    wp_enqueue_style( 'custom-template-style', plugins_url( 'template-style.css', __FILE__ ) );

}
add_action( 'wp_enqueue_scripts', 'additional_custom_styles' );
function ucla_author(){

        //set UI labels for CPT
        $labels= array(
                'name'=>__('Author Pages', 'TEMP_DOMAIN'),
                'singular_name'=>__('Author Page', 'TEMP_DOMAIN'),
                'add_new'=>__('Add New Author Page', 'TEMP_DOMAIN'),
                'edit_item'=>__('Edit Author Page', 'TEMP_DOMAIN'),
                'new_item'=>__('New Author Page', 'TEMP_DOMAIN'),
                'viem_item'=>__('View  Author Page', 'TEMP_DOMAIN'),
                'view_items'=>__('View Author Pages', 'TEMP_DOMAIN'),
                'not_found'=>__('No Author Page found.', 'TEMP_DOMAIN'),
                'not_found_in_trash'=>__(' No Author Page found in trash.', 'TEMP_DOMAIN'),
                'all_items'=>__('All Author Pages', 'TEMP_DOMAIN'),
		'menu_name'=>__('Author Pages', 'TEMP_DOMAIN')
	);
	$args= array(
		'labels'=>$labels,
                'description'=>__('Author Profile Page Template','TEMP_DOMAIN'),
                'supports'=> array('title','thumbnail'), //define core features the post type supports
                'taxonomies'=> array('role'), //taxonomy identifiers that will be registered for the post type
                'hierarchical'=>false, //this CPT is handled like a post
                'public'=> true ,//allow us to publish
                'show_in_rest' => true,//block editor?
                'has_archive'=> true,
                'menu_icon' => 'dashicons-admin-users' //set the menu icon
        );
        //register author CPT
        register_post_type('author', $args);
}
//Taxonomy
function author_taxonomy_role()
{
	register_taxonomy(
	'role',
	'author',
	array(
		'hierarchical'=>true,
		'label'=> 'Role',
		'querey_var'=>true,
		'has_archive'=>true,
		'rewrite'=>array('slug'=>'role')));}
add_action('init','author_taxonomy_role');
function add_author_roles(){
	wp_insert_term('Faculty Member','role',array('slug'=> 'faculty_member',));
	wp_insert_term('Graduate Student','role',array('slug'=>'graduate_student',));
	wp_insert_term('Researcher/Scholar','role',array('slug'=>'researcher_scholar'));
	wp_insert_term('Staff','role',array('slug'=>'staff'));
}
add_action('init','add_author_roles');
// Custom fields for author page template
	
function add_post_meta_boxes_author(){
         add_meta_box("publication-metadata-author", "Author Details", "author_metabox", "author", "advanced", "low");
}

//save fields values

function save_author_details(){
        global $post;
        if (defined('DOING_AUTOSAVE')&& DOING_AUTOSAVE){return;}
        update_post_meta($post->ID,"first_name",sanitize_text_field($_POST["first_name"]));
        update_post_meta($post->ID,"middle_name",sanitize_text_field($_POST["middle_name"]));
        update_post_meta($post->ID,"last_name",sanitize_text_field($_POST["last_name"]));
	update_post_meta($post->ID,"role",sanitize_text_field($_POST["role"]));
	update_post_meta($post->ID,"email",sanitize_text_field($_POST["email"]));
	update_post_meta($post->ID,"office",sanitize_text_field($_POST["office"]));
	update_post_meta($post->ID,"website",sanitize_text_field($_POST["website"]));
	update_post_meta($post->ID,"phone",sanitize_text_field($_POST["phone"]));

}
//call back function to render fields

function author_metabox(){
        global $post;
	$custom = get_post_custom($post->ID);//retrieve  post meta fields pased on post ID
	?><p><b>First Name:</b></p><?php
        $field_first_name=$custom["first_name"][0]; //grab data from first_name
        echo "<input type=\"text\" name=\"first_name\" value=\"".$field_first_name."\" placeholder=\"Author First Name\">";
	?><br>
		<p><b>Middle Name:</b></p>
<?php
	$field_middle_name=$custom["middle_name"][0]; //grab data from middle_name
        echo "<input type=\"text\" name=\"middle_name\" value=\"".$field_middle_name."\" placeholder=\"Author Middle Name Initial\">";
	?><br>
<p><b>Last Name:</b></p>
<?php
	$field_last_name=$custom["last_name"][0]; //grab data from last_name
 	echo "<input type=\"text\" name=\"last_name\" value=\"".$field_last_name."\" placeholder=\"Author Last Name\">";
	?>
	<br>
	<p><b>E-mail:</b></p><?php
        $field_email=$custom["email"][0]; //grab data from email
        echo "<input type=\"text\" name=\"email\" value=\"".$field_email."\" placeholder=\"Author's E-mail\">";
        ?><br>
<p><b>Office Location:</b></p><?php
        $field_office=$custom["office"][0]; //grab data from office
        echo "<input type=\"text\" name=\"office\" value=\"".$field_office."\" placeholder=\"Author's Office Location\">";
        ?><br>
<p><b>Website URL:</b></p><?php
        $field_website=$custom["website"][0]; //grab data from website
        echo "<input type=\"text\" name=\"website\" value=\"".$field_website."\" placeholder=\"Author's Website URL\">";
?><br>
<p><b>Work phone number:</b></p><?php
        $field_phone=$custom["phone"][0]; //grab data from phone
        echo "<input type=\"text\" name=\"phone\" value=\"".$field_phone."\" placeholder=\"(123)456-7890\">";
        ?><br>
<?php

}

function author_template($template){
        global $post;
        if ('author' === $post->post_type){
                return plugin_dir_path(__FILE__) . 'author-template.php';
        }
        return $template;
}
//init of the author CPT
add_action('init','ucla_author',0); 
add_action('save_post','save_author_details');
add_action('admin_init','add_post_meta_boxes_author');
add_filter('single_template','author_template');

/**
 *
 * AWARDS CUSTOM POST TYPE
 *
 **/

function ucla_awards(){
	        //set UI labels for CPT
        $labels= array(
                'name'=>__('Awards', 'TEMP_DOMAIN'),
                'singular_name'=>__('Award', 'TEMP_DOMAIN'),
                'add_new'=>__('Add New Award', 'TEMP_DOMAIN'),
                'edit_item'=>__('Edit Award', 'TEMP_DOMAIN'),
                'new_item'=>__('New Award', 'TEMP_DOMAIN'),
                'viem_item'=>__('View Award', 'TEMP_DOMAIN'),
                'view_items'=>__('View Awards', 'TEMP_DOMAIN'),
                'not_found'=>__('No Award found.', 'TEMP_DOMAIN'),
                'not_found_in_trash'=>__(' No Award found in trash.', 'TEMP_DOMAIN'),
                'all_items'=>__('All Awards', 'TEMP_DOMAIN'),
                'menu_name'=>__('Awards', 'TEMP_DOMAIN')
        );
        $args= array(
                'labels'=>$labels,
                'description'=>__('Academic Awards Template','TEMP_DOMAIN'),
                'supports'=> array('title','thumbnail'), //define core features the post type supports
                'taxonomies'=> array('Role'), //taxonomy identifiers that will be registered for the post type
                'hierarchical'=>false, //this CPT is handled like a post
                'public'=> true ,//allow us to publish
                'show_in_rest' => true,//block editor?
                'has_archive'=> true,
                'menu_icon' => 'dashicons-star-empty' //set the menu icon
        );
        //register author CPT
        register_post_type('award', $args);
}

//hook into the 'init' action

add_action('init','ucla_awards',0);

function add_post_meta_boxes_awards(){
	 add_meta_box("awards-metadata", "Award Details", "award_metabox", "award", "advanced", "low");
}
add_action('admin_init','add_post_meta_boxes_awards');


function save_award_details(){
	global $post;
	if (defined('DOING_AUTOSAVE')&& DOING_AUTOSAVE){return;}
	update_post_meta($post->ID, "name",sanitize_text_field($_POST["name"]));
	update_post_meta($post->ID, "date",sanitize_text_field($_POST["date"]));
	update_post_meta($post->ID, "location",sanitize_text_field($_POST["location"]));
}
add_action('save_post','save_award_details');
function award_metabox(){
        global $post;
	$custom = get_post_custom($post->ID);//retrieve post meta fields based on post ID
	?>
<p><b>Name/Title:</b></p>
<?php
	$field_data_name = $custom["name"][0]; //grab data from "name"
	echo "<input type=\"text\" name=\"name\" value=\"".$field_data_name."\" placeholder=\"Award Name\">";
	?><br>
<p><b>Year:</b></p>
<?php
	$field_data_date = $custom["date"][0]; //grab data from "date"
	echo "<input type=\"text\" name=\"date\" value=\"".$field_data_date."\" placeholder=\"Award Year\">";
	?><br>
<p><b>Location:</b></p>
<?php
	$field_data_location = $custom["location"][0]; //grab data from "location"
	echo "<input type=\"text\" name=\"location\" value=\"".$field_data_location."\" placeholder=\"Award Location\">";
}
function award_template($template){
	global $post;
	if ('award' === $post->post_type){
		return plugin_dir_path( __FILE__ ) . 'award-template.php';
	}
	return $template;
}
add_filter('single_template','award_template');
/**
 *
 * AREA OF EXPERTISE  CUSTOM  POST  TYPE
 *
 **/
function ucla_areas_of_expertise(){
                //set UI labels for CPT
        $labels= array(
                'name'=>__('Areas of Expertise', 'TEMP_DOMAIN'),
                'singular_name'=>__('Area of Expertise', 'TEMP_DOMAIN'),
                'add_new'=>__('Add New Area of Expertise', 'TEMP_DOMAIN'),
                'edit_item'=>__('Edit Area of Expertise', 'TEMP_DOMAIN'),
                'new_item'=>__('New Area of Expertise', 'TEMP_DOMAIN'),
                'viem_item'=>__('View Area of Expertise', 'TEMP_DOMAIN'),
                'view_items'=>__('View Areas of Expertise', 'TEMP_DOMAIN'),
                'not_found'=>__('No Area of Expertise found.', 'TEMP_DOMAIN'),
                'not_found_in_trash'=>__(' No Area of Expertise found in trash.', 'TEMP_DOMAIN'),
                'all_items'=>__('All Areas of Expertise', 'TEMP_DOMAIN'),
                'menu_name'=>__('Area of Expertise', 'TEMP_DOMAIN')
        );
        $args= array(
                'labels'=>$labels,
                'description'=>__('Area of Expertise of the group','TEMP_DOMAIN'),
                'supports'=> array('title','editor','thumbnail'), //define core features the post type supports
                'taxonomies'=> array('Role'), //taxonomy identifiers that will be registered for the post ype
                'hierarchical'=>false, //this CPT is handled like a post
                'public'=> true ,//allow us to publish
                'show_in_rest' => false,//block editor?
                'has_archive'=> true,
                'menu_icon' => 'dashicons-admin-site' //set the menu icon
        );
        //register author CPT
        register_post_type('area_of_expertise', $args);
}

//hook into the 'init' action

add_action('init','ucla_areas_of_expertise',0);
function AOE_template($template){
        global $post;
        if ('area_of_expertise' === $post->post_type){
                return plugin_dir_path( __FILE__ ) . 'AOE-template.php';
        }
        return $template;
}
add_filter('single_template','AOE_template');

function ucla_contact(){
	$labels= array(
		'name'=>__('Contacts','TEMP_DOMAIN'),
		'singular_name'=>__('Contact','TEMP_DOMAIN'),
		'add_new'=>__('Add New Contact','TEMP_DOMAIN'),
		'edit_item'=>__('Edit Contact','TEMP_DOMAIN'),
		'new_item'=>__('New Contact','TEMP_DOMAIN'),
		'view_item'=>__('View Contact','TEMP_DOMAIN'),
		'view_items'=>__('View Contacts','TEMP_DOMAIN'),
		'not_found'=>__('No Contact found','TEMP_DOMAIN'),
		'not_found_in_trash'=>__('No Contact found in trash','TEMP_DOMAIN'),
		'all_items'=>__(' All Contacts','TEMP_DOMAIN'),
		'menu_name'=>__('Contact','TEMP_DOMAIN'),
	);
	$args= array(
		'labels'=>$labels,
		'description'=>__('Contact informations of the group','TEMP_DOMAIN'),
		'supports'=> array('custom-fields'),
		'hierarchical'=>false, //this CPT is handled like a post
                'public'=> true ,//allow us to publish
                'show_in_rest' => false,//block editor?
                'has_archive'=> true,
                'menu_icon' => 'dashicons-phone' //set the menu icon
        );
        //register author CPT
        register_post_type('contact', $args);

}
add_action('init','ucla_contact',0);

function add_post_meta_boxes_contact(){
	add_meta_box("contact-metadata", "Contact Informations", "contact_metabox", "contact", "side", "low");
}
add_action('admin_init','add_post_meta_boxes_contact');

function save_contact_details(){
	global $post;
	if (defined('DOING_AUTOSAVE')&& DOING_AUTOSAVE){return;}
	update_post_meta($post->ID, "contact_address",sanitize_text_field($_POST["contact_address"]));
	update_post_meta($post->ID, "contact_mail",sanitize_text_field($_POST["contact_mail"]));
	update_post_meta($post->ID, "contact_phone",sanitize_text_field($_POST["contact_phone"]));
	update_post_meta($post->ID, "contact_fax",sanitize_text_field($_POST["contact_fax"]));
	update_post_meta($post->ID, "contact_email",sanitize_text_field($_POST["contact_email"]));
	update_post_meta($post->ID, "contact_website",sanitize_text_field($_POST["contact_website"]));
	update_post_meta($post->ID, "contact_delivery",sanitize_text_field($_POST["contact_delivery"]));

	}
	add_action('save_post','save_contact_details');

	function contact_metabox(){
        global $post;
        $custom = get_post_custom($post->ID);//retrieve post meta fields based on post ID
        ?>
<p><b>Address:</b></p>
<?php
        $field_data_address = $custom["contact_address"][0]; 
        echo "<input type=\"text\" name=\"contact_address\" value=\"".$field_data_address."\" placeholder=\"Address\">";
        ?><br>
<p><b>Mailing Address:</b></p>
<?php
        $field_data_mail = $custom["contact_mail"][0]; 
        echo "<input type=\"text\" name=\"contact_mail\" value=\"".$field_data_mail."\" placeholder=\"Mailing Address\">";
?><br>
<p><b>Phone number:</b></p>
<?php
        $field_data_phone = $custom["contact_phone"][0];
        echo "<input type=\"text\" name=\"contact_phone\" value=\"".$field_data_phone."\" placeholder=\"Phone number\">";
?><br>
<p><b>Fax:</b></p>
<?php
        $field_data_fax = $custom["contact_fax"][0];
        echo "<input type=\"text\" name=\"contact_fax\" value=\"".$field_data_fax."\" placeholder=\"Fax Number\">";
?><br>
<p><b>Email:</b></p>
<?php
        $field_data_email = $custom["contact_email"][0];
        echo "<input type=\"text\" name=\"contact_email\" value=\"".$field_data_email."\" placeholder=\"Email address\">";
?><br>
<p><b>Website:</b></p>
<?php
        $field_data_website = $custom["contact_website"][0];
        echo "<input type=\"text\" name=\"contact_website\" value=\"".$field_data_website."\" placeholder=\"Department Website\">";
?><br>
<p><b>Delivery Address:</b></p>
<?php
        $field_data_delivery = $custom["contact_delivery"][0];
        echo "<input type=\"text\" name=\"contact_delivery\" value=\"".$field_data_delivery."\" placeholder=\"Delivery Address\">";
        ?><br>

<?php
}

function contact_template($template){
global $post;
if ('contact'===$post->post_type){
	return plugin_dir_path(__FILE__).'contact-template.php';
}
return $template;
}
add_filter('single_template','contact_template');
