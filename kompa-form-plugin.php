<?php
/**
 * Plugin Name: Kompa Form Plugin
 * Author: Kevin Estrada
 * Description: Create forms using shortcode [Kompa-Form-Plugin]
 */

 // define shortcode
 add_shortcode ('Kompa-Form-Plugin', 'Kompa_Plugin_Form');
 
 function Kompa_Plugin_Form(){
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
            <label for="id">E-mail:</label>
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