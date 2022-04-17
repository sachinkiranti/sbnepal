<style>
    .dropify-wrapper {
        max-width: 98%;
        height: 100px;
    }
</style>
<div class="wrap sbnepal-ms-add-a-new-agent-wrapper">
    <h2><?php _e( 'Add A New Agent', 'sbnepal-ms' ); ?> <a href="<?php echo admin_url( 'admin.php?page=sbnepal-ms-agent' ); ?>" class="add-new-h2"><?php _e( 'List', 'sbnepal-ms' ); ?></a></h2>

    <div class="dashboard-widgets-wrap">
        <div class="metabox-holder">
            <div id="dashboard_activity" class="postbox ">
                <div class="inside">
                    <div id="col-container">
                        <form enctype="multipart/form-data"
                              id="sbNepalMsSettingForm" action="" method="post" style="padding: 10px">

                            <?php wp_nonce_field('wps-frontend-sbnepal-ms-add-agent') ?>
                            <input type="hidden" name="FORM_HANDLER" value="sbnepal-ms-add-agent" />

                            <div id="col-left">
                                <div class="col-wrap">
                                    <div class="input-text-wrap" id="sbnepal-ms_referral_id-wrap">
                                        <label for="sbnepal-ms_referral_id" style="display: inline-block;margin: 4px;">
                                            Referral ID <br> <small>If not given, will be recognized as the first agent</small>
                                        </label>
                                        <input type="text" placeholder="Enter the referral ID" name="referral_id" id="sbnepal-ms_referral_id" value="<?php echo isset($_GET['referral_id']) ? $_GET['referral_id'] : ''; ?>" autocomplete="off" style="width: 100%;">
                                    </div>

                                    <div class="input-text-wrap" id="sbnepal-ms_name-wrap">
                                        <label for="sbnepal-ms_name" style="display: inline-block;margin: 4px;">
                                            Name(required)
                                        </label>
                                        <input required type="text" placeholder="Enter the agent name" name="name" id="sbnepal-ms_name" value="<?php echo isset($_GET['name']) ? $_GET['name'] : ''; ?>" autocomplete="off" style="width: 100%;">
                                    </div>

                                    <div class="input-text-wrap" id="sbnepal-ms_father_name-wrap">
                                        <label for="sbnepal-ms_father_name" style="display: inline-block;margin: 4px;">
                                            Father Name(required)
                                        </label>
                                        <input required type="text" placeholder="Enter the agent name" name="father_name" value="<?php echo isset($_GET['father_name']) ? $_GET['father_name'] : ''; ?>" id="sbnepal-ms_father_name" autocomplete="off" style="width: 100%;">
                                    </div>

                                    <div class="input-text-wrap" id="sbnepal-ms_address-wrap">
                                        <label for="sbnepal-ms_address" style="display: inline-block;margin: 4px;">
                                            Address(required)
                                        </label>
                                        <input required type="text" placeholder="Enter the agent name" name="address" id="sbnepal-ms_address" value="<?php echo isset($_GET['address']) ? $_GET['address'] : ''; ?>" autocomplete="off" style="width: 100%;">
                                    </div>

                                    <div class="input-text-wrap" id="sbnepal-ms_citizenship_no-wrap">
                                        <label for="sbnepal-ms_citizenship_no" style="display: inline-block;margin: 4px;">
                                            Citizenship No(required)
                                        </label>
                                        <input required type="text" placeholder="Enter the citizenship number" name="citizenship_no" value="<?php echo isset($_GET['citizenship_no']) ? $_GET['citizenship_no'] : ''; ?>" id="sbnepal-ms_citizenship_no" autocomplete="off" style="width: 100%;">
                                    </div>

                                    <div class="input-text-wrap" id="sbnepal-ms_qualification-wrap">
                                        <label for="sbnepal-ms_qualification" style="display: inline-block;margin: 4px;">
                                            Qualification(required)
                                        </label>
                                        <input required type="text" placeholder="Enter the qualification" name="qualification" value="<?php echo isset($_GET['qualification']) ? $_GET['qualification'] : ''; ?>" id="sbnepal-ms_qualification" autocomplete="off" style="width: 100%;">
                                    </div>

                                    <div class="input-text-wrap" id="sbnepal-ms_email-wrap">
                                        <label for="sbnepal-ms_email" style="display: inline-block;margin: 4px;">
                                            Email Address(required)
                                        </label>
                                        <input required type="email" placeholder="Enter the email" name="email" id="sbnepal-ms_email" value="<?php echo isset($_GET['user_email']) ? $_GET['user_email'] : ''; ?>" autocomplete="off" style="width: 100%;">
                                    </div>

                                    <div class="input-text-wrap" id="sbnepal-ms_phone_number-wrap">
                                        <label for="sbnepal-ms_phone_number" style="display: inline-block;margin: 4px;">
                                            Phone Number(required)
                                        </label>
                                        <input required type="number" placeholder="Enter the phone_number" name="phone_number" id="sbnepal-ms_phone_number" value="<?php echo isset($_GET['phone_number']) ? $_GET['phone_number'] : ''; ?>" autocomplete="off" style="width: 100%;">
                                    </div>

                                    <div class="input-text-wrap" id="sbnepal-ms_password-wrap">
                                        <label for="sbnepal-ms_password" style="display: inline-block;margin: 4px;">
                                            Password(required)
                                        </label>
                                        <input required type="password" placeholder="Enter the password" name="password" id="sbnepal-ms_password" autocomplete="off" style="width: 100%;">
                                    </div>

                                    <div class="input-text-wrap" id="sbnepal-ms_password_confirmation-wrap">
                                        <label for="sbnepal-ms_password_confirmation" style="display: inline-block;margin: 4px;">
                                            Confirm Password(required)
                                        </label>
                                        <input required type="password" placeholder="Enter the password" name="password_confirmation" id="sbnepal-ms_password_confirmation" autocomplete="off" style="width: 100%;">
                                    </div>

                                    <p>
                                        <?php submit_button( __( 'Add Agent', 'sbnepal-ms' ), 'primary', 'Submit' ); ?>
                                    </p>
                                </div>
                            </div>

                            <div id="col-right">
                                <div class="col-wrap">
                                    <div id="sbnepal-ms_passport_size_photo-wrap"
                                        style="float: right;clear: both;">
                                        <input type="checkbox"
                                               name="add_agent_for_somebody_else"
                                               id="sbnepal-ms_add_agent_for_somebody_else"
                                               autocomplete="off">
                                        <label for="sbnepal-ms_add_agent_for_somebody_else"
                                               style="display: inline-block;margin: 4px;">
                                            Add Agent For Someone Else
                                        </label>
                                    </div>

                                    <div class="sbnepal_ms_add_agent_for_somebody_else-wrapper" style="display: none">
                                        <br>
                                        <hr>
                                        <div class="input-text-wrap" id="sbnepal-ms_add_agent_for_somebody_else-wrap">
                                            <label for="sbnepal-ms_add_agent_for_somebody_else">
                                                Add Agent For Someone Else
                                            </label> <br>

                                            <select name="filter" id="walletFilter" style="width: 100%;max-width: 100%;">
                                                <option selected disabled>Select Agent</option>

                                                <?php foreach (sbnepal_ms_get_all_agent() as $agent) : ?>
                                                    <option data-refer-id="<?php echo get_the_author_meta( 'refer_id', $agent->ID ); ?>"
                                                            value="<?php echo $agent->ID; ?>">
                                                        <?php echo $agent->display_name . ' ( ' . $agent->user_email . ' )'; ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <hr>
                                    </div>

                                    <div class="input-text-wrap" id="sbnepal-ms_passport_size_photo-wrap">
                                        <label for="sbnepal-ms_passport_size_photo" style="display: inline-block;margin: 4px;">
                                            Passport Size Photo(required)
                                        </label>
                                        <input required type="file" class="dropify"  name="passport_size_photo" id="sbnepal-ms_passport_size_photo" autocomplete="off" style="width: 100%;">
                                    </div>

                                    <div class="input-text-wrap" id="sbnepal-ms_citizenship_photo-wrap">
                                        <label for="sbnepal-ms_citizenship_photo" style="display: inline-block;margin: 4px;">
                                            Citizenship Photo(required)
                                        </label>
                                        <input required class="dropify" type="file"  name="citizenship_photo" id="sbnepal-ms_citizenship_photo" autocomplete="off" style="width: 100%;">
                                    </div>

                                    <div class="input-text-wrap" id="sbnepal-ms_signature_photo-wrap">
                                        <label for="sbnepal-ms_signature_photo" style="display: inline-block;margin: 4px;">
                                            Signature Photo(required)
                                        </label>
                                        <input required class="dropify" type="file"  name="signature_photo" id="sbnepal-ms_signature_photo" autocomplete="off" style="width: 100%;">
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