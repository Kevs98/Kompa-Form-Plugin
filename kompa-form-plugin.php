<?php
/**
 * Plugin Name: Kompa Form Plugin
 * Author: Kevin Estrada
 * Description: Create forms using shortcode [Kompa-Form-Plugin]
 */

 register_activation_hook(__FILE__,'Kompa_Aspirants_init');

 function Kompa_Aspirants_init(){
     global $wpdb;
     $aspirants_table = $wpdb->prefix . 'aspirants';
     $charset_collate = $wpdb->get_charset_collate();
     // preparing sql consultation
     $query = "CREATE TABLE IF NOT EXISTS $aspirants_table(
         id mediumint(9) NOT NULL AUTO_INCREMENT,
         nombre varchar(40) NOT NULL,
         cedula int(13) NOT NULL,
         email varchar(25) NOT NULL,
         tel int(11) NOT NULL,
         oficio varchar(40) NOT NULL,
         kompa varchar(30) NOT NULL,
         exp smallint(4) NOT NULL,
         car smallint(4) NOT NULL,
         cai smallint(4) NOT NULL,
         created_at datetime NOT NULL,
         UNIQUE (id)
     ) $charset_collate";

    include_once ABSPATH . 'wp-admin/includes/upgrade.php';
    dbDelta($query);
 }

 // define shortcode
 add_shortcode ('Kompa-Form-Plugin', 'Kompa_Plugin_Form');
 
 function Kompa_Plugin_Form(){

    global $wpdb;
    
    if (!empty($_POST)
        AND $_POST['nombre'] != ''
        AND $_POST['id'] != ''
        AND $_POST['email'] != ''
        AND $_POST['tel'] != ''
        AND $_POST['oficio'] != ''
        AND $_POST['kompa'] != ''
        AND $_POST['exp'] != ''
        AND $_POST['car'] != ''
        AND $_POST['cai'] != ''){

        $aspirants_table = $wpdb->prefix . 'aspirants';
        $nombre          = sanitize_text_field($_POST['nombre']);
        $id              = sanitize_text_field($_POST['id']);
        $email           = sanitize_email($_POST['email']);
        $tel             = sanitize_text_field($_POST['tel']);
        $oficio          = sanitize_text_field($_POST['oficio']);
        $kompa           = (int)$_POST['kompa'];
        $exp             = (int)$_POST['exp'];
        $car             = (int)$_POST['car'];
        $cai             = (int)$_POST['cai'];
        $created_at      = date('Y-m-d H:i:s');

        $wpdb->insert(
            $aspirants_table, 
            array(
                'nombre'     => $nombre,
                'id'         => $id,
                'email'      => $email,
                'tel'        => $tel,
                'oficio'     => $oficio,
                'kompa'      => $kompa,
                'exp'        => $exp,
                'car'        => $car,
                'cai'        => $cai,
                'created_at' => $created_at
            )
        );   
    }
    ob_start();
    ?>

     <form method="post" class="kform" action="<?php get_the_permalink(); ?>">
        <div class="form-input">
            <label for="nombre">Nombre Completo:</label>
            <input type="text" name="nombre" required="required">
        </div>
        <div class="form-input">
            <label for="id">Cedula:</label>
            <input type="text" name="id" required="required">
        </div>
        <div class="form-input">
            <label for="email">E-mail:</label>
            <input type="text" name="email" required="required">
        </div>
        <div class="form-input">
            <label for="tel">Telefono:</label>
            <input type="text" name="tel" required="required">
        </div>
        <div class="form-input">
            <label for="oficio">Oficio:</label>
            <input type="text" name="oficio" required="required">
        </div>
        <div class="form-input">
            <label for="kompa">Elija categoria</label>
            <select name="kompa" required="required">
                <option value="1">Hogar</option>
                <option value="2">Automovil</option>
                <option value="3">Delivery</option>
                <option value="4">Transporte VIP</option>
            </select>
        </div>
        <div class="form-input">
            <label for="exp">Experincia:</label> <br>
            <input type="radio" name="exp" value="1" required="required"> Si <br>
            <input type="radio" name="exp" value="2" required="required"> No
        </div>
        <div class="form-input">
            <label for="car">Vehiculo Propio:</label> <br>
            <input type="radio" name="car" value="1" required="required"> Si <br>
            <input type="radio" name="car" value="2" required="required"> No
        </div>
        <div class="form-input">
            <label for="cai">Facturacion con CAI:</label> <br>
            <input type="radio" name="cai" value="1" required="required"> Si <br>
            <input type="radio" name="cai" value="2" required="required"> No
        </div>
        <div class="form-input">
            <input type="submit" value="enviar">
        </div>
     </form>

    <?php
    return ob_get_clean();
 }