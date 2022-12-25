<?php
/**
 * Plugin Name: WP Book
 * Description: This is an wordpress book plugin example.
 * Version: 1.0
 * Author: Prasad Sanap
 * Author URI: comming soon 
 */

 if(!defined('ABSPATH')){
    header('Location:/your_header/');
    die();
}
function my_plugin_activation(){

    global $wpdb,$table_prefix;
    $wp_book = $table_prefix.'book';
    // Query of crating table.
    $q= "CREATE TABLE IF NOT EXISTS `$wp_book`(
        `ID` INT NOT NULL AUTO_INCREMENT, 
        `author_name` VARCHAR(50) NOT NULL,
        `price` VARCHAR(100) NOT NULL, 
        `publisher` VARCHAR(100) NOT NULL, 
        `year` VARCHAR(100) NOT NULL, 
        `edition` VARCHAR(100) NOT NULL, 
        `url`  VARCHAR(100), 
        PRIMARY KEY (`ID`)
    ) ENGINE = MyISAM;";
    $wpdb->query($q);
}

register_activation_hook(__FILE__,'my_plugin_activation');

function my_plugin_deactivation(){

    global $wpdb,$table_prefix;
    $wp_book = $table_prefix.'book';
    // Truncating table data 
    $q="TRUNCATE `$wp_book`";
    $wpdb->query($q);
}
register_deactivation_hook(__FILE__,'my_plugin_deactivation');


?>