<div class="wrap sbnepal-ms-add-a-new-agent-wrapper">
    <h2><?php _e( 'Add A New Agent', 'sbnepal-ms' ); ?> <a href="<?php echo admin_url( 'admin.php?page=sbnepal-ms-agent' ); ?>" class="add-new-h2"><?php _e( 'List', 'sbnepal-ms' ); ?></a></h2>

    <div class="dashboard-widgets-wrap">
        <div class="metabox-holder">
            <div id="dashboard_activity" class="postbox ">
                <div class="inside">
                    <div id="col-container">
                        <form data-action-url="<?php echo $sbNepalBaseDir; ?>inc/xhr/sbnepal-ms-add-agent-xhr.php"
                              id="sbNepalMsSettingForm" action="" method="post" style="padding: 10px">

                            <?php wp_nonce_field('wps-frontend-sbnepal-ms-add-agent') ?>

                            <div id="col-left">
                                <div class="col-wrap">
                                    <div class="input-text-wrap" id="sbnepal-ms_referral_id-wrap">
                                        <label for="sbnepal-ms_referral_id" style="display: inline-block;margin: 4px;">
                                            Referral ID(required)
                                        </label>
                                        <input type="text" placeholder="Enter the referral ID" name="referral_id" id="sbnepal-ms_referral_id" autocomplete="off" style="width: 100%;">
                                    </div>

                                    <div class="input-text-wrap" id="sbnepal-ms_name-wrap">
                                        <label for="sbnepal-ms_name" style="display: inline-block;margin: 4px;">
                                            Name(required)
                                        </label>
                                        <input type="text" placeholder="Enter the agent name" name="name" id="sbnepal-ms_name" autocomplete="off" style="width: 100%;">
                                    </div>

                                    <div class="input-text-wrap" id="sbnepal-ms_father_name-wrap">
                                        <label for="sbnepal-ms_father_name" style="display: inline-block;margin: 4px;">
                                            Father Name(required)
                                        </label>
                                        <input type="text" placeholder="Enter the agent name" name="father_name" id="sbnepal-ms_father_name" autocomplete="off" style="width: 100%;">
                                    </div>

                                    <div class="input-text-wrap" id="sbnepal-ms_address-wrap">
                                        <label for="sbnepal-ms_address" style="display: inline-block;margin: 4px;">
                                            Address(required)
                                        </label>
                                        <input type="text" placeholder="Enter the agent name" name="address" id="sbnepal-ms_address" autocomplete="off" style="width: 100%;">
                                    </div>

                                    <div class="input-text-wrap" id="sbnepal-ms_citizenship_no-wrap">
                                        <label for="sbnepal-ms_citizenship_no" style="display: inline-block;margin: 4px;">
                                            Citizenship No(required)
                                        </label>
                                        <input type="text" placeholder="Enter the citizenship number" name="citizenship_no" id="sbnepal-ms_citizenship_no" autocomplete="off" style="width: 100%;">
                                    </div>

                                    <div class="input-text-wrap" id="sbnepal-ms_qualification-wrap">
                                        <label for="sbnepal-ms_qualification" style="display: inline-block;margin: 4px;">
                                            Qualification(required)
                                        </label>
                                        <input type="text" placeholder="Enter the qualification" name="qualification" id="sbnepal-ms_qualification" autocomplete="off" style="width: 100%;">
                                    </div>

                                    <div class="input-text-wrap" id="sbnepal-ms_email-wrap">
                                        <label for="sbnepal-ms_email" style="display: inline-block;margin: 4px;">
                                            Email Address(required)
                                        </label>
                                        <input type="email" placeholder="Enter the email" name="email" id="sbnepal-ms_email" autocomplete="off" style="width: 100%;">
                                    </div>

                                    <div class="input-text-wrap" id="sbnepal-ms_phone_number-wrap">
                                        <label for="sbnepal-ms_phone_number" style="display: inline-block;margin: 4px;">
                                            Phone Number(required)
                                        </label>
                                        <input type="number" placeholder="Enter the phone_number" name="phone_number" id="sbnepal-ms_phone_number" autocomplete="off" style="width: 100%;">
                                    </div>

                                    <div class="input-text-wrap" id="sbnepal-ms_password-wrap">
                                        <label for="sbnepal-ms_password" style="display: inline-block;margin: 4px;">
                                            Password(required)
                                        </label>
                                        <input type="password" placeholder="Enter the password" name="password" id="sbnepal-ms_password" autocomplete="off" style="width: 100%;">
                                    </div>

                                    <div class="input-text-wrap" id="sbnepal-ms_password_confirmation-wrap">
                                        <label for="sbnepal-ms_password_confirmation" style="display: inline-block;margin: 4px;">
                                            Confirm Password(required)
                                        </label>
                                        <input type="password" placeholder="Enter the password" name="password" id="sbnepal-ms_password_confirmation" autocomplete="off" style="width: 100%;">
                                    </div>

                                    <p>
                                        <input type="submit" name="save" id="save-post" class="button button-primary" value="Save">
                                    </p>
                                </div>
                            </div>

                            <div id="col-right">
                                <div class="col-wrap">
                                    <div class="input-text-wrap" id="sbnepal-ms_passport_size_photo-wrap">
                                        <label for="sbnepal-ms_passport_size_photo" style="display: inline-block;margin: 4px;">
                                            Passport Size Photo(required)
                                        </label>
                                        <input type="file"  name="passport_size_photo" id="sbnepal-ms_passport_size_photo" autocomplete="off" style="width: 100%;">
                                    </div>

                                    <div class="input-text-wrap" id="sbnepal-ms_citizenship_photo-wrap">
                                        <label for="sbnepal-ms_citizenship_photo" style="display: inline-block;margin: 4px;">
                                            Citizenship Photo(required)
                                        </label>
                                        <input type="file"  name="citizenship_photo" id="sbnepal-ms_citizenship_photo" autocomplete="off" style="width: 100%;">
                                    </div>

                                    <div class="input-text-wrap" id="sbnepal-ms_signature_photo-wrap">
                                        <label for="sbnepal-ms_signature_photo" style="display: inline-block;margin: 4px;">
                                            Signature Photo(required)
                                        </label>
                                        <input type="file"  name="signature_photo" id="sbnepal-ms_signature_photo" autocomplete="off" style="width: 100%;">
                                    </div>
                                </div>
                            </div>
                            <br class="clear" style="margin-bottom: 5px;">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>