<?php
/**
 * Plugin Name:       My BPP 
 * Plugin URI:        https://example.com/plugins/the-basics/
 * Description:       Handle the basics with this plugin.
 * Version:           0.0.1
 * Author:            Steve Glick
    
  */


//exit if accessed directly
  if(!defined('ABSPATH')){
      exit;
  }

// require_one() includes one file into another file. This is adding BPP-scripts into this file. This has the effect of loading the file. 
// plugin_dir_path(__FILE__) is a shortcut, it is concastinated with rest of file name to shorten the path. 
require_once(plugin_dir_path(__FILE__).'/includes/BPP-scripts.php');

  // require_one() includes one file into another file. This is adding BPP-class into this file. This has the effect of loading the file. 
// plugin_dir_path(__FILE__) is a shortcut, it is concastinated with rest of file name to shorten the path. 
require_once(plugin_dir_path(__FILE__).'/includes/BPP-class.php');





//this registers the widget portion of the plugin
function register_BPP(){
// register_widget is part of the wordpress api, it registers the widget for use on wordpress (required)
  register_widget('BPP_Widget'); //BPP_Widet is the Class name from BPP-class.php

}
//hook in the above function. 
add_action('widgets_init', 'register_BPP'); //this adds register_BPP when the widgets_init runs.  


//below adds the admin page

function BPP_admin_menu(){
//add_menu_page() is a wordpress API,
//the first argument is the Title of the page
//the second argument is the Title as displayed on the Menu in admin. THIS NEDS CHANGED FOR CUSTOM PLUGIN
//the third arg is the permissions level that the person need to have to access this. In this case "manage_options" so anyone who can manage options in admin can use this.
//the fourth is the slug, this is used for a sub menu page 
//the fifth is the callback function, IMPORTANT, this is the function listed directly below and will be ran when this is added
//the sixth is the icon
//the seventh is the order it should appear in the menu
  add_menu_page('BPP', 'BPP Main Menu', 'manage_options','BPP-admin-menu', 'BPP_admin_menu_main', 'dashicons-cart', 4);

  //this ads a submenu page to the existing admin page. 
  //the first arguemnt is the slug from the above admin menu
  //the second arguemnt is the title of the page 
  //the third arguemnt is for the the title on the admin sub menue
  //the fourth is the managment options to set permssions of users
  //the fifth is the slug for this submenu
  //the last is the callback function that refers to the function below. 
  add_submenu_page('BPP-admin-menu','BPP Sub Items','BPP Submenu', 'manage_options','BPP-submenu-slug', 'BPP_admin_submenu_main' );

}

add_action('admin_menu','BPP_admin_menu');// when admin_menu hook is reached,  call BPP_admin_menu


 

function admin_enqueue($hook) {
	//only enque for the custom plugin admin page, this makes sure that wordpress doesn't load the scripts on all admin pages. 
    
  //echo $hook;  use this if you need to see the hook that is getting hit on new subpage. copy into the code below to add it
  //this checks the hook to see if it matches one of the pages below. If it does, it exits so the code does not get enqueued below.
  if( 'toplevel_page_BPP-admin-menu'!= $hook && 'bpp-main-menu_page_BPP-submenu-slug'!= $hook ){return;}
  
  //enqueue bootstrap (not needed but useful)
  //wp_enqueue_style("bootstrap", 'https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css');
  //enqueue style css
  wp_enqueue_style("admin_main_style", plugins_url().'/BPP/css/style.css');
  //enqueue shared JS
	wp_enqueue_script("admin_shared_script", plugins_url().'/BPP/js/shared.js');
  //enqueue admin JS
  wp_enqueue_script("admin_main_script", plugins_url().'/BPP/js/admin.js');

  
  
	
  }
  
  add_action( 'admin_enqueue_scripts', 'admin_enqueue' );
  
  
  //adds shortcode feature, you can use [MyBPP] in the site to hook in the plugin
   function BPP_Add_ShortCode($atts) {
		
		$Content .= '<h3 class="demoClass">Plugin Shortcode Output</h3>';
		 
		  return $Content;
	}
	  
    add_shortcode('MyBPP', 'BPP_Add_ShortCode');
    



    //this displays info on the admin SUBMENU page
function BPP_admin_submenu_main() {
 // global $wpdb;
  //$user_count = $wpdb->get_var( "SELECT COUNT(*) FROM $wpdb->users" );
  //echo "<p>User count is {$user_count}</p>";


 




}

//this displays info on the admin SUBMENU page
function BPP_admin_menu_main(){
  echo 'Main admin menu';
}


/*

function update_post_meta_data($meta_key, $meta_value){
  

  update_post_meta( 836, $meta_key, $meta_value );
}






function get_post_meta_data(){
  $meta_key = "key";
  $meta_value = "Value";
  update_post_meta( 836, $meta_key, $meta_value );

  $info = get_post_meta( 836, $meta_key, true );
  echo $info;
  return $info;
}



 


    //this function creates a database table 
    function BPP_db() {
      global $wpdb;
      $charset_collate = $wpdb->get_charset_collate();
      require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
     
      //* Create the table
      $table_name = $wpdb->prefix . 'myDB_BPP';
      $sql = "CREATE TABLE $table_name (
      BPP_id INTEGER NOT NULL AUTO_INCREMENT,
      BPP_name TEXT NOT NULL,
      BPP_city TEXT NOT NULL,
      PRIMARY KEY (BPP_id)
      ) $charset_collate;";
      dbDelta( $sql );


        INSERT INTO $table_name (BPP_name,  BPP_city) values ('Steve','Columbus');


     }

     register_activation_hook( __FILE__, 'BPP_db' );//this create a db table above only on install


     
     //this removes database when plugin is uninstalled
     function BPP_remove_database() {
          global $wpdb;
          $table_name = $wpdb->prefix . 'myDB_BPP';
          $sql = "DROP TABLE IF EXISTS $table_name";
          $wpdb->query($sql);
          delete_option("BPP");
     }   
     register_uninstall_hook( __FILE__, 'BPP_remove_database' );

*/





