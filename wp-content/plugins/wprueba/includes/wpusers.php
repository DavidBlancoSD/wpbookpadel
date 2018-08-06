<?php
if ( isset( $_POST['submit'] ) ) {
    global wpdb;

    $table = $wpdb->prefix .'padelwp_book';
    $data = array(
        'email' => $_POST['option_email'],
        'name' = > $_POST['option_name'],
        'surname' => $_POST['option_surname']);
    /*$data = array('email' => , 'name' => 'Pepe', 'surname' => 'Negro');*/
    $format = array('%s', '%s', '%s');

    $wpdb->insert($table, $data, $format);
}


?>
