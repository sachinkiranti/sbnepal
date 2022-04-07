<div class="wrap">
    <h1><?php _e( 'Add new Result', 'prasadi-result-sys' ); ?></h1>

    <?php $items = prasadi_result_sys_faculty_get_all_faculty(); ?>

    <form action="" method="post">
        <input type="hidden" name="FORM_HANDLER" value="prasadi_result_sys_result" />

        <table class="form-table">
            <tbody>
            <tr class="row-symbol-number">
                <th scope="row">
                    <label for="symbol_number"><?php _e( 'Symbol Number', 'prasadi-result-sys' ); ?></label>
                </th>
                <td>
                    <input type="text" name="symbol_number" id="symbol_number" class="regular-text" placeholder="<?php echo esc_attr( '', 'prasadi-result-sys' ); ?>" value="" required="required" />
                </td>
            </tr>
            <tr class="row-result">
                <th scope="row">
                    <label for="result"><?php _e( 'Result', 'prasadi-result-sys' ); ?></label>
                </th>
                <td>
                    <input type="text" name="result" id="result" class="regular-text" placeholder="<?php echo esc_attr( '', 'prasadi-result-sys' ); ?>" value="" required="required" />
                </td>
            </tr>
            <tr class="row-appointment-date">
                <th scope="row">
                    <label for="appointment_date"><?php _e( 'Appointment Date', 'prasadi-result-sys' ); ?></label>
                </th>
                <td>
                    <input type="text" name="appointment_date" id="appointment_date" class="regular-text" placeholder="<?php echo esc_attr( '', 'prasadi-result-sys' ); ?>" />
                </td>
            </tr>

            <tr class="row-appointment-time">
                <th scope="row">
                    <label for="appointment_time"><?php _e( 'Appointment Time', 'prasadi-result-sys' ); ?></label>
                </th>
                <td>
                    <input type="text" name="appointment_time" id="appointment_time" class="regular-text" placeholder="<?php echo esc_attr( '', 'prasadi-result-sys' ); ?>" />
                </td>
            </tr>


            <tr class="row-meeting-link">
                <th scope="row">
                    <label for="meeting_link"><?php _e( 'Zoom Meeting Link', 'prasadi-result-sys' ); ?></label>
                </th>
                <td>
                    <textarea name="meeting_link" id="meeting_link"placeholder="<?php echo esc_attr( '', 'prasadi-result-sys' ); ?>" rows="5" cols="30"></textarea>
                </td>
            </tr>
            <tr class="row-meeting-id">
                <th scope="row">
                    <label for="meeting_id"><?php _e( 'Zoom Meeting ID', 'prasadi-result-sys' ); ?></label>
                </th>
                <td>
                    <input type="text" name="meeting_id" id="meeting_id" class="regular-text" placeholder="<?php echo esc_attr( '', 'prasadi-result-sys' ); ?>" value="" />
                </td>
            </tr>
            <tr class="row-password">
                <th scope="row">
                    <label for="password"><?php _e( 'Zoom Meeting Password', 'prasadi-result-sys' ); ?></label>
                </th>
                <td>
                    <input type="text" name="password" id="password" class="regular-text" placeholder="<?php echo esc_attr( '', 'prasadi-result-sys' ); ?>" value="" />
                </td>
            </tr>

            <tr class="row-faculty-id">
                <th scope="row">
                    <label for="faculty_id"><?php _e( 'Faculty', 'prasadi-result-sys' ); ?></label>
                </th>
                <td>
                    <?php if (count($items)> 0) : ?>
                        <br>
                        <select name="faculty_id" id="faculty_id" required style="width: 100%;">
                            <?php foreach ($items as $faculty) { ?>
                                <option value="<?php echo $faculty->id; ?>"><?php echo ucwords($faculty->faculty_name); ?></option>
                            <?php } ?>
                        </select>
                    <?php endif; ?>
                </td>
            </tr>

            </tbody>
        </table>

        <input type="hidden" name="field_id" value="0">

        <?php wp_nonce_field( 'prasadi_result_sys_result' ); ?>
        <?php submit_button( __( 'Add New Result', 'prasadi-result-sys' ), 'primary', 'Submit' ); ?>

    </form>
</div>