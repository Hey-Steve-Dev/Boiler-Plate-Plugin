<?php
//add scripts both javaScripts and CSS get added here as well as any other files... all scripts should have the same prefix in this cas BPP
function BPP_add_scripts(){

    //YOU CAN ENQUE MULTIPLE JAVASCRIPT AND CSS FILES HERE, MAKE SURE OTHER SCRIPTS GO FIRST
    wp_enqueue_script('BPP-shared-script', plugins_url(). '/BPP/js/shared.js');

    //the below code adds the styles and scripts to wordpress this will need to be included into the main BPP.php file

    //add main CSS  wp_enqueue_style is part of the wordpress API
    //the first argument 'BPP-main-style' is the handle, the second argument is the source, or the direct path to the file with the code on it. 
    // plugins_url() is part of the wordpress API it is concastinated with the folder/file of the css sheet to get the path. 
    wp_enqueue_style('BPP-main-style', plugins_url(). '/BPP/css/style.css');


    //add main JS file  wp_enqueue_script is part of the wordpress API
    //the first argument 'BPP-main-script' is the handle, the second argument is the source, or the direct path to the file with the code on it. 
    // plugins_url() is part of the wordpress API it is concastinated with the folder/file of the JS sheet to get the path. 
    wp_enqueue_script('BPP-main-script', plugins_url(). '/BPP/js/main.js');



    
}
// add_action hooks in the function to wordpress
// the first argument is part of the wordpress api, it inserts a script called BPP_add_scripts above
// when wordpress hits the hook wp_enqueue_scripts, it will know to add the function BPP_add_scripts
add_action('wp_enqueue_scripts', 'BPP_add_scripts');

