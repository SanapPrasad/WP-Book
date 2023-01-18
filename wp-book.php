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
        `book_name` VARCHAR(50) NOT NULL,
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

// Shortcode for showing book info
function shows_books_info(){
    global $wpdb,$table_prefix;
    $wp_book=$table_prefix.'book';
    $q="SELECT * FROM `$wp_book`;";
    $result=$wpdb->get_results($q);
  
    ob_start();
    ?>
    <table>
        <thead> 
            <tr>
                <th>#</th>
                <th>ID</th>
                <th>BOOK NAME</th>
                <th>AUTHOR NAME</th>
                <th>PRICE</th>
                <th>PUBLISHER</th>
                <th>YEAR</th>
                <th>EDITION</th>
                <th>URL</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $i=0;
                foreach($result as $row){
            ?>
            <tr>
                <td> <?php echo ++$i ?></td>
                <td> <?php echo $row->ID; ?></td>
                <td><?php echo $row->book_name; ?></td>
                <td><?php echo $row->author_name; ?></td>
                <td><?php echo $row->price; ?></td>
                <td><?php echo $row->publisher; ?></td>
                <td><?php echo $row->year; ?></td>
                <td><?php echo $row->edition; ?></td>
                <td><?php echo '<a href='.$row->url.'>'.$row->url.'</a>'; ?></td>
            </tr>
            <?php
                };
            ?>
        </tbody>

    </table>
    <?php
    $html=ob_get_clean();
    return $html;
}

add_shortcode('book','shows_books_info');



?>