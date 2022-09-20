<?php
if (is_user_logged_in()) {
    echo 'Welcome Incsub';
} else {
    echo 'Please Login';
}

//


add_action( 'user_new_form', 'bks_add_person_reg_number_field' );
add_action( 'edit_user_profile', 'bks_add_person_reg_number_field' );
add_action( 'show_user_profile', 'bks_add_person_reg_number_field' );


function bks_add_student_reg_number_field( $user ) {
    ?>
    <h3><?php _e("Extra profile information", "blank"); ?></h3>
    <table class="form-table">
        <tr>
            <th><label for="student_reg_number"><?php _e("Person Registration Number"); ?></label></th>
            <td>
                <?php if (is_object($user)) { ?>
                    <input type="text" name="person_reg_number" id="person_reg_number" value="<?php echo esc_attr( get_the_author_meta( 'person_reg_number', $user->ID )); ?>" class="regular-text" readonly disabled="disabled"/><br />
                <?php } else { ?>
                    <input type="text" name="person_reg_number" id="person_reg_number" class="regular-text" /><br />
                    <span class="description"><?php _e("Please enter person registration number."); ?></span>
                <?php } ?>
            </td>
        </tr>
    </table>
<?php }


add_action( 'user_register', 'bks_person_reg_number_field' );

function bks_person_reg_number_field($user_id) {
    

    if(!current_user_can('manage_options'))
        return false;

    $reg_value = get_user_meta($user_id, 'person_reg_number', true);
    if (isset( $_POST['person_reg_number']) &&  $_POST['person_reg_number'] !== $reg_value) {
        update_user_meta($user_id, 'person_reg_number', $_POST['person_reg_number'].'-'.$user_id);
    }
}
