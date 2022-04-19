<style>
    .input-text-wrap {
        margin-top: 5px;
        margin-bottom: 5px;
    }
    .error-shown {
        color: red;
    }
</style>
<div class="wrap sbnepal-ms-settings-wrapper">

    <div class="dashboard-widgets-wrap">

        <div class="metabox-holder">
            <div id="dashboard_activity" class="postbox ">
                <div class="postbox-header">
                    <h2 class="hndle">
                        Manage the SMTP Setting
                    </h2>
                </div>
                <div class="inside">
                    <form data-action-url="<?php echo $sbNepalBaseDir; ?>inc/xhr/sbnepal-ms-setting-xhr.php"
                          id="sbNepalMsSMTPSettingForm"
                          action="" method="post" style="padding-top: 10px">

                        <?php wp_nonce_field('wps-frontend-sbnepal-ms-register') ?>

                        <div class="input-text-wrap" id="sbnepal-ms_smtp-wrap">
                            <label for="sbnepal-ms_smtp-host" style="display: inline-block;margin-bottom: 4px;">
                                SMTP Host
                            </label>
                            <input type="text" value="<?php echo get_option("sbnepal-ms_smtp-host", 'server.sbnepal.com') ?>" placeholder="Enter the smtp host" name="sbnepal-ms_smtp-host" id="sbnepal-ms_smtp-host" autocomplete="off" style="width: 100%;">
                            <div class="sbnepal-ms_smtp-host-error error-shown"></div>
                        </div>

                        <div class="input-text-wrap" id="sbnepal-ms-auth-wrap">
                            <label for="sbnepal-ms_first_level_commission" style="display: inline-block;margin-bottom: 4px;">
                                SMTP Authentication
                            </label> <br>

                            <?php $yesChecked = ((int) get_option("sbnepal-ms_smtp-auth", 1) ) === 1 ? 'checked' : '' ?>
                            <?php $noChecked = ((int) get_option("sbnepal-ms_smtp-auth", 1)) === 0 ? 'checked' : '' ?>

                            <input <?php echo $yesChecked; ?> type="radio" value="1" placeholder="Enter the smtp auth" name="sbnepal-ms_smtp-auth" id="sbnepal-ms_smtp-auth-yes" autocomplete="off">
                            <label for="sbnepal-ms_smtp-auth-yes">Yes</label>
                            <input <?php echo $noChecked; ?> type="radio" value="0" placeholder="Enter the smtp auth" name="sbnepal-ms_smtp-auth" id="sbnepal-ms_smtp-auth-no" autocomplete="off">
                            <label for="sbnepal-ms_smtp-auth-no">No</label>
                            <div class="sbnepal-ms_smtp-auth-error error-shown"></div>
                        </div>

                        <div class="input-text-wrap" id="sbnepal-ms_smtp-wrap">
                            <label for="sbnepal-ms_smtp-port" style="display: inline-block;margin-bottom: 4px;">
                                SMTP Port
                            </label>
                            <input type="number" value="<?php echo get_option("sbnepal-ms_smtp-port", '465') ?>" placeholder="Enter the smtp port" name="sbnepal-ms_smtp-port" id="sbnepal-ms_smtp-port" autocomplete="off" style="width: 100%;">
                            <div class="sbnepal-ms_smtp-port-error error-shown"></div>
                        </div>

                        <div class="input-text-wrap" id="sbnepal-ms-auth-wrap">
                            <label for="sbnepal-ms_first_level_commission" style="display: inline-block;margin-bottom: 4px;">
                                SMTP Secure
                            </label> <br>

                            <?php $sslChecked = (get_option("sbnepal-ms_smtp-secure", 'ssl') ) === 'ssl' ? 'checked' : '' ?>
                            <?php $tlsChecked = (get_option("sbnepal-ms_smtp-secure", 'ssl')) === 'tls' ? 'checked' : '' ?>

                            <input <?php echo $sslChecked; ?> type="radio" value="1" placeholder="Enter the smtp secure" name="sbnepal-ms_smtp-secure" id="sbnepal-ms_smtp-secure-yes" autocomplete="off">
                            <label for="sbnepal-ms_smtp-secure-ssl">SSL</label>
                            <input <?php echo $tlsChecked; ?> type="radio" value="0" placeholder="Enter the smtp secure" name="sbnepal-ms_smtp-secure" id="sbnepal-ms_smtp-secure-tls" autocomplete="off">
                            <label for="sbnepal-ms_smtp-secure-tls">TLS</label>
                            <div class="sbnepal-ms_smtp-auth-error error-shown"></div>
                        </div>

                        <div class="input-text-wrap" id="sbnepal-ms_smtp-wrap">
                            <label for="sbnepal-ms_smtp-username" style="display: inline-block;margin-bottom: 4px;">
                                SMTP Username
                            </label>
                            <input type="text" value="<?php echo get_option("sbnepal-ms_smtp-username", 'sbnepal@gmail.com') ?>" placeholder="Enter the smtp username" name="sbnepal-ms_smtp-username" id="sbnepal-ms_smtp-username" autocomplete="off" style="width: 100%;">
                            <div class="sbnepal-ms_smtp-username-error error-shown"></div>
                        </div>

                        <div class="input-text-wrap" id="sbnepal-ms_smtp-wrap">
                            <label for="sbnepal-ms_smtp-password" style="display: inline-block;margin-bottom: 4px;">
                                SMTP Password
                            </label>
                            <input type="text" value="<?php echo get_option("sbnepal-ms_smtp-password") ?>" placeholder="Enter the smtp password" name="sbnepal-ms_smtp-password" id="sbnepal-ms_smtp-username" autocomplete="off" style="width: 100%;">
                            <div class="sbnepal-ms_smtp-password-error error-shown"></div>
                        </div>

                        <div class="input-text-wrap" id="sbnepal-ms_smtp-wrap">
                            <label for="sbnepal-ms_smtp-from" style="display: inline-block;margin-bottom: 4px;">
                                SMTP From
                            </label>
                            <input type="text" value="<?php echo get_option("sbnepal-ms_smtp-from", 'noreply@sbnepal.com') ?>" placeholder="Enter the smtp from" name="sbnepal-ms_smtp-from" id="sbnepal-ms_smtp-from" autocomplete="off" style="width: 100%;">
                            <div class="sbnepal-ms_smtp-from-error error-shown"></div>
                        </div>

                        <div class="input-text-wrap" id="sbnepal-ms_smtp-wrap">
                            <label for="sbnepal-ms_smtp-from-name" style="display: inline-block;margin-bottom: 4px;">
                                SMTP From Name
                            </label>
                            <input type="text" value="<?php echo get_option("sbnepal-ms_smtp-from-name", 'Smart Business in Nepal') ?>" placeholder="Enter the smtp from-name" name="sbnepal-ms_smtp-from-name" id="sbnepal-ms_smtp-from-name" autocomplete="off" style="width: 100%;">
                            <div class="sbnepal-ms_smtp-from-name-error error-shown"></div>
                        </div>

                        <p>
                            <input type="submit" name="save" id="save-post" class="button button-primary" value="Update">
                            <br class="clear">
                        </p>
                    </form>
                </div>
            </div>
        </div>

    </div>
</div>

<script>
    $sb = jQuery.noConflict()

    $sb(function () {

        $sb('.sbnepal-ms-settings-wrapper').find('#sbNepalMsSMTPSettingForm').on (
            'submit', function (e) {

                e.preventDefault()

                var $this = $sb(this),
                    spinner = "<i class='fa fa-spinner fa-spin'></i>";

                $this.find('input[type=submit]').val( spinner + " Updating ..." )
                    .prop('disabled', true)

                $sb.ajax({
                    type: 'POST',
                    url: $sb(this).data('actionUrl'),
                    data: $sb(this).serializeArray(),
                    success: function (response) {
                        if( response.data.status === "validation" ) {

                            $sb('.error-shown').html('').hide()

                            $sb.each(response.data.errors, function (key, value) {
                                $sb('.'+ key + "-error").html(value).show();
                            });
                        } else {
                            $sb('.sbnepal-ms_last_updated').html(
                                response.data.last_updated
                            )
                            toastr.success(response.data.message, 'Smart Business In Nepal')
                        }

                        $this.find('input[type=submit]').val( "Update" ).prop('disabled', false);
                    }
                })

                return false
            }
        )

    })
</script>