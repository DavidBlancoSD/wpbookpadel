<div class="wrap">
 <h1>Hola!</h1>
 <p>Este es mi primer plugin!</p>
</div>

<h3>Añadir localizaciones</h3>
<table class="form-table">
    <tr>
        <th>
            <label for="nuevocampo">Nombre del sitio</label>
        </th>
        <td>
            <input type="text" name="nuevocampo" id="nuevocampo" value="<?php echo esc_attr( get_the_author_meta( 'nuevocampo', $user->ID ) ); ?>" class="regular-text" /><br />
            <span class="description">Lugar o localización. Ejemplo: Cáceres, Coria, Plasencia.</span>
        </td>
    </tr>
    <tr>
        <th>
            <label for="nuevocampo2">Dirección</label>
        </th>
        <td>
            <input type="text" name="nuevocampo2" id="nuevocampo2" value="<?php echo esc_attr( get_the_author_meta( 'nuevocampo2', $user->ID ) ); ?>" class="regular-text" /><br />
            <span class="description">Dirección del sitio.</span>
        </td>
        <p>
            <label for="my_meta_box_select">Pistas: </label>
    		<select name="my_meta_box_select" id="my_meta_box_select">
    			<option value="Pista 1" <?php selected( $selected, 'pista1' ); ?>>Pista 1</option>
    			<option value="Pista 2" <?php selected( $selected, 'pista2' ); ?>>Pista 2</option>
    			<option value="Pista 3" <?php selected( $selected, 'pista3' ); ?>>Pista 3</option>
                <option value="Pista 4" <?php selected( $selected, 'pista4' ); ?>>Pista 4</option>
                <option value="Pista 5" <?php selected( $selected, 'pista5' ); ?>>Pista 5</option>
    		</select>
        </p>
    </tr>
</table>
