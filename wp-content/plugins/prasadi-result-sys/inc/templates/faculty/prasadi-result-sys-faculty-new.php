<div class="wrap">
    <h1><?php _e( 'Add new Faculty', 'prasadi-result-sys' ); ?></h1>

    <form action="<?php echo esc_html( admin_url( 'admin.php' ) ); ?>" method="post">
        <input type="hidden" name="action" value="prasadi_result_sys_faculty" />
        <input type="hidden" name="FORM_HANDLER" value="prasadi_result_sys_faculty" />

        <table class="form-table">
            <tbody>
            <tr class="row-faculty-name">
                <th scope="row">
                    <label for="faculty_name"><?php _e( 'Faculty Name', 'prasadi-result-sys' ); ?></label>
                </th>
                <td>
                    <span class="description"><?php _e('Enter the faculty Name', 'prasadi-result-sys' ); ?></span>
                    <br>
                    <input type="text" name="faculty_name" id="faculty_name" class="regular-text" placeholder="<?php echo esc_attr( 'Enter the faculty name', 'prasadi-result-sys' ); ?>" value="" required="required" />
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
                    <?php prasadi_custom_editor('', 'response_message_passed') ?>

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

                    <?php prasadi_custom_editor('', 'response_message_scholarship') ?>

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
                    <?php prasadi_custom_editor('', 'response_message_failed') ?>
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
                    <?php prasadi_custom_editor('', 'response_message_unidentified') ?>
                </td>
            </tr>
            </tbody>
        </table>

        <input type="hidden" name="field_id" value="0">

        <?php wp_nonce_field( 'prasadi_result_sys_faculty' ); ?>
        <?php submit_button( __( 'Add New Faculty', 'prasadi-result-sys' ), 'primary', 'Submit' ); ?>

    </form>
</div>