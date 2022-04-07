<div class="wrap">
    <h1><?php _e( 'Edit Faculty', 'prasadi-result-sys' ); ?></h1>

    <?php $item = prasadi_result_sys_faculty_get_faculty( $id ); ?>

    <form action="" method="post">

        <table class="form-table">
            <tbody>
            <tr class="row-faculty-name">
                <th scope="row">
                    <label for="faculty_name"><?php _e( 'Faculty Name', 'prasadi-result-sys' ); ?></label>
                </th>
                <td>
                    <span class="description"><?php _e('Enter the faculty Name', 'prasadi-result-sys' ); ?></span>
                    <br>
                    <input type="text" name="faculty_name" id="faculty_name" class="regular-text" placeholder="<?php echo esc_attr( '', 'prasadi-result-sys' ); ?>" value="<?php echo esc_attr( $item->faculty_name ); ?>" required="required" />
                </td>
            </tr>

            <tr class="row-response-message-passed">
                <th scope="row">
                    <label for="response_message_passed"><?php _e( 'Response Text Passed', 'prasadi-result-sys' ); ?></label>
                </th>
                <td>
                    <span class="description">
                        <?php _e('Enter the response message for passed', 'prasadi-result-sys' ); ?> <br>

                        Please use patterns : <small><b title="The Pattern  can be used only once." style="text-decoration: underline;cursor: pointer;">The Pattern  can be used only once.</b></small><br> <br>
                        <b title="Appointment Info  will be shown using the pattern">
                            {%APPOINTMENT_INFO%}</b>
                            <code style="color: red;">Appointment  meeting id, password and date time will  be shown</code> <br>
                    </span> <br>
                    <?php prasadi_custom_editor($item->response_message_passed, 'response_message_passed') ?>

                </td>
            </tr>

            <tr class="row-response-message-scholarship">
                <th scope="row">
                    <label for="response_message_scholarship"><?php _e( 'Response Text Scholarship', 'prasadi-result-sys' ); ?></label>
                </th>
                <td>
                    <span class="description">
                        <?php _e('Enter the response message for scholarship', 'prasadi-result-sys' ); ?> <br>
                        Please use patterns : <small><b title="The Pattern  can be used only once." style="text-decoration: underline;cursor: pointer;">The Pattern  can be used only once.</b></small><br> <br>
                        <b title="Appointment Info  will be shown using the pattern">
                            {%APPOINTMENT_INFO%}</b>
                            <code style="color: red;">Appointment  meeting id, password and date time will  be shown</code> <br>
                    </span> <br>

                    <?php prasadi_custom_editor($item->response_message_scholarship, 'response_message_scholarship') ?>

                </td>
            </tr>

            <tr class="row-response-message-failed">
                <th scope="row">
                    <label for="response_message_failed"><?php _e( 'Response Text Failed', 'prasadi-result-sys' ); ?></label>
                </th>
                <td>
                    <span class="description">
                        <?php _e('Enter the response message for failed', 'prasadi-result-sys' ); ?> <br>
                    </span> <br>

                    <?php prasadi_custom_editor($item->response_message_failed, 'response_message_failed') ?>
                </td>
            </tr>

            <tr class="row-response-message-unidentified">
                <th scope="row">
                    <label for="response_message_unidentified"><?php _e( 'Response Text Unidentified', 'prasadi-result-sys' ); ?></label>
                </th>
                <td>
                    <span class="description">
                        <?php _e('Enter the response message for unidentified', 'prasadi-result-sys' ); ?> <br>
                    </span> <br>

                    <?php prasadi_custom_editor($item->response_message_unidentified, 'response_message_unidentified') ?>
                </td>
            </tr>
            </tbody>
        </table>

        <input type="hidden" name="field_id" value="<?php echo $item->id; ?>">
        <input type="hidden" name="FORM_HANDLER" value="prasadi_result_sys_faculty" />

        <?php wp_nonce_field( 'prasadi_result_sys_faculty' ); ?>
        <?php submit_button( __( 'Update Faculty', 'prasadi-result-sys' ), 'primary', 'Submit' ); ?>

    </form>
</div>