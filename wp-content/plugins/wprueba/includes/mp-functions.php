<?php

register_deactivation_hook( __FILE__, 'padelwp_deactivate' );

function padelwp_deactivate() {

    unregister_post_type( 'padelwp_booking' );

    flush_rewrite_rules();
}

// Action hook to initialize the plugin
add_action( 'init', 'padelwp_store_init' );

//Initialize the padel booking store
function padelwp_store_init() {

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

/*
 * Add my new menu to the Admin Control Panel
 */

 // Hook the 'admin_menu' action hook, run the function named 'my_menu()'
 add_action( 'admin_menu', 'my_menu' );

// Add a new top level menu link to the ACP
function my_menu()
{

 add_menu_page(
 'Mi primer título', //Titulo del menú, es el metadata
 'Gestión de pistas de pádel', //Nombre del menú
 'manage_options', //requisito de capacidad para ver el enlace, nivel de usuario mínimo para ver el menú (capability)
 'mi-primer-slug', //Slug, archivo que se ejecuta al hacer click (debe ser diferente a cualquier otro plugin o tema)
 'nuevoMenu', //nombre de la funcion a la que llama cuando estas dentro del menú
 plugins_url( 'wprueba/images/reserva-padel.png' ), //icono
 99 //posicion del icono, si no se pone aparecerá debajo
 );

 //call register settings function
add_action( 'admin_init', 'padelwp_register_settings' );


 add_submenu_page(
 'mi-primer-slug',
 'Mi primer subtitulo',
 'Crear club',
 'manage_options',
 'mi-primer-subslug',
 'creaClub');

 add_submenu_page(
 'mi-primer-slug',
 'Mi segundo subtitulo',
 'Crear Usuarios',
 'manage_options',
 'mi-segundo-subslug',
 'creaUsuario');

 add_submenu_page(
 'mi-primer-slug',
 'Mi tercer subtitulo',
 'Gestión de calendario',
 'manage_options',
 'mi-tercer-subslug',
 'gestionCalendario');
}

function padelwp_register_settings() {

    //register our settings
    register_setting( 'padelwp-settings-group', 'padelwp_options','padelwp_sanitize_options' );

}

function nuevoMenu() { ?>

    <h1>Plugin gestor de reservas de pádel</h1>
    <table class="form-table">

        <tr>
            <th><label for="nuevocampo">Campo a añadir</label></th>

            <td>
                <input type="text" name="nuevocampo" id="nuevocampo"
                value="<?php echo esc_attr( get_the_author_meta( 'nuevocampo', $user->ID ) ); ?>"
                class="regular-text" /><br />
                <span class="description">Descripcion</span>
            </td>
            <p>
                <label for="my_meta_box_select">Pistas: </label>
        		<select name="my_meta_box_select" id="my_meta_box_select">
        			<option value="Pista 1" <?php selected( $pista, 'pista1' ); ?>>Pista 1</option>
        			<option value="Pista 2" <?php selected( $pista, 'pista2' ); ?>>Pista 2</option>
        			<option value="Pista 3" <?php selected( $pista, 'pista3' ); ?>>Pista 3</option>
                    <option value="Pista 4" <?php selected( $pista, 'pista4' ); ?>>Pista 4</option>
                    <option value="Pista 5" <?php selected( $pista, 'pista5' ); ?>>Pista 5</option>
        		</select>
            </p>
        </tr>
    </table>
    <?php ?>
    <form method="post" action="">
        <input type="submit" value="Guardar">
    </form>
<?php }

/*------ Crear Club---------*/

function creaClub(){ ?>

    <h3>Creación de clubes de pádel</h3>
    <?php
    
    ?>

<?php }

/*------ Crear Usuario---------*/

function creaUsuario(){ ?>

    <div class="wrap">
    <h2>Creación de usuarios de pádel</h2>
    <form method="post" action="">
        <?php settings_fields( 'padelwp-settings-group' ); ?>
        <?php $padelwp_options = get_option( 'padelwp_options' ); ?>
        <table class="form-table">
            <tr valign="top">
            <th scope="row">Nombre</th>
            <td><input type="text" name="padelwp_options[option_name]"
            value="<?php echo esc_attr( $padelwp_options['option_name'] ); ?>" />
            </td>
            </tr>
            <tr valign="top">
            <th scope="row">Apellido</th>
            <td><input type="text" name="padelwp_options[option_surname]"
            value="<?php echo esc_attr( $padelwp_options['option_surname'] ); ?>" />
            </td>
            </tr>
            <tr valign="top">
            <th scope="row">Email</th>
            <td><input type="text" name="padelwp_options[option_email]"
            value="<?php echo esc_attr( $padelwp_options['option_email'] ); ?>" />
            </td>
            </tr>
            <!--<tr valign="top">
            <th scope="row">URL</th>
            <td><input type="text" name="prowp_options[option_url]"
            value="<?php echo esc_url( $padelwp_options['option_url'] ); ?>" />
            </td>
            </tr>-->
        </table>
        <p><input type="submit" class="button-primary" value="Enviar" /></p>
    </form>
    </div>

    <?php
    if ( isset( $_POST['submit'] ) ) {


        $data = array(
            'email' => $_POST['option_email'],
            'name' => $_POST['option_name'],
            'surname' => $_POST['option_surname']);
        /*$data = array('email' => , 'name' => 'Pepe', 'surname' => 'Negro');*/
        $format = array('%s', '%s', '%s');

        $wpdb->insert($table_name, $data, $format);
    }
    ?>

<?php }

//Funcion para desinfectar todos los datos enviados a través del formulario
//antes de guardarlos en la base de datos. Este paso es importante ya que
//no sanitizar podría generar una vulnerabilidad.
function padelwp_sanitize_options( $input ) {

    $input['option_name'] = sanitize_text_field( $input['option_name'] );
    $input['option_surname'] = sanitize_text_field( $input['option_surname']);
    $input['option_email'] = sanitize_email( $input['option_email'] );
    //$input['option_url'] = esc_url( $input['option_url'] );

    return $input;

}

add_shortcode( 'myshortcodepadelwp', 'creaUsuario' );

function padelwp_booking_shortcode() {
    return 'hola';
}


/*------ Gestion Calendario---------*/

function gestionCalendario(){ ?>

    <h3>Gestión del calendario</h3>
    <?php get_calendar(); ?>

<?php }
