<?php

if(!defined('WP_UNISTALL_PLUGIN')){
    if(!defined('ABSPATH')){
        header('Location:/your_header/');
        die();
    }
}
global $wpdb,$table_prefix;
$wp_book = $table_prefix.'book';
//Droping table directly from DB.
$q="DROP TABLE `$wp_book`";
$wpdb->query($q);