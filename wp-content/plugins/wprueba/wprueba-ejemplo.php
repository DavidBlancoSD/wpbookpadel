<?php
/*
Copyright 2018 DAVID_BLANCO_CANIZARES (email : david.blancocanizares@alum.uca.es)
This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 2 of the License, or
(at your option) any later version.
This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.
You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA 02110-1301
 USA
*/
?>


<?php
/**
 * Plugin Name: Ejemplo de WPrueba
 * Plugin URI: http://localhost/prueba
 * Description: Este plugin permite reservar pistas de padel por horas y por niveles.
 * Version: 1.0.0
 * Author: David Blanco
 * Author URI: http://localhost/prueba
 * License: WPv1
 * Requires at least: 1.0
 * Tested up to: 1.0
 *
 * Text Domain: wprueba-ejemplo
 * Domain Path: /
*/


defined( 'ABSPATH' ) or die( '¡Sin trampas!' );

$padelwp_db_version = '1.0';

register_activation_hook( __FILE__, 'padelwp_install' );

function padelwp_install() {
    global $wp_version;
    global $wpdb;

    if ( version_compare( $wp_version, '3.5', '<') ) {
        wp_die('Este plugin requiere una version de WordPress 3.5 o superior.');
    }

    //define the custom table name
    $table_name = $wpdb->prefix .'padelwp_book';
    //build the query to create our new table
    $sql = "CREATE TABLE " .$table_name ." (
        id mediumint(9) NOT NULL AUTO_INCREMENT,
        email text(11) NOT NULL,
        name tinytext NOT NULL,
        surname tinytext NOT NULL,
        url VARCHAR(55) NOT NULL,
        UNIQUE KEY id (id)
    );";
    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    //execute the query to create our table
    dbDelta( $sql );
    //set the table structure version
    $prowp_db_version = '1.0';
    //save the table structure version number
    //add_option( 'prowp_db_version', $prowp_db_version );

    //Añadir nonce ()

    //Añadir variable update_

    $data = array('email' => 'dav@dav.com', 'name' => 'David', 'surname' => 'Blanco');
    $format = array('%s', '%s', '%s');
    $wpdb->insert($table_name, $data, $format);
}

require_once plugin_dir_path(__FILE__) . 'includes/mp-functions.php';


/*----------------

register_activation_hook( __FILE__, 'padelwp_install' );

function padelwp_install() {
    global $wp_version;

    if ( version_compare( $wp_version, '3.5', '<') ) {
        wp_die('Este plugin requiere una version de WordPress 3.5 o superior.');
    }

    require_once plugin_dir_path(__FILE__) . 'includes/mp-functions.php';
}

register_deactivation_hook( __FILE__, 'prowp_deactivate()' );

function padelwp_deactivate() {

    unregister_post_type( 'padelwp_booking' );

    flush_rewrite_rules();
}

// Action hook to initialize the plugin
add_action( 'init', 'padelwp_store_init' );

//Initialize the padel booking store
function halloween_store_init() {

    $labels = array(
        'name' => __( 'Reservas', 'padelwp_plugin'),
        'singular_name' => __( 'Reserva', 'padelwp_plugin'),
        'add_new' => __( 'Crear Reserva', 'padelwp_plugin'),
        'edit_item' => __( 'Editar Reserva', 'padelwp_plugin'),
        'remove_new' => __( 'Eliminar Reserva', 'padelwp_plugin'),
    );

    $args = array(
        'labels' => $labels,
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'query_var' => true,
        'rewrite' => true,
        'capability_type' => 'post',
        'has_archive' => true,
        'hierarchical' => false,
        'menu_position' => null,
        'supports' => array( 'title', 'editor', 'thumbnail', 'excerpt' )
    );

    register_post_type( 'padelwp_booking', $args);

}

-------------------*/
