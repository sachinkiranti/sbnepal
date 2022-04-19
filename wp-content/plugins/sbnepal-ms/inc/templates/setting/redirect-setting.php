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
                        Redirect Setting <small>If redirect setting is added, you don't have to give the url to the available shortcodes.</small>
                    </h2>
                </div>
                <div class="inside">
                    <form data-action-url="<?php echo $sbNepalBaseDir; ?>inc/xhr/sbnepal-ms-setting-xhr.php"
                          id="sbNepalMsRedirectSettingForm"
                          action="" method="post" style="padding-top: 10px">

                        <?php wp_nonce_field('wps-frontend-sbnepal-ms-register') ?>

                        <div class="input-text-wrap" id="sbnepal-ms_redirect-wrap">
                            <label for="sbnepal-ms_redirect-login" style="display: inline-block;margin-bottom: 4px;">
                                Login URL
                            </label>
                            <input type="text" value="<?php echo get_option("sbnepal-ms_redirect-login", '/login') ?>" placeholder="Enter the login url" name="sbnepal-ms_redirect-login" id="sbnepal-ms_redirect-login" autocomplete="off" style="width: 100%;">
                            <div class="sbnepal-ms_redirect-login-error error-shown"></div>
                        </div>

                        <div class="input-text-wrap" id="sbnepal-ms_redirect-wrap">
                            <label for="sbnepal-ms_redirect-login" style="display: inline-block;margin-bottom: 4px;">
                                Register URL
                            </label>
                            <input type="text" value="<?php echo get_option("sbnepal-ms_redirect-register", '/register') ?>" placeholder="Enter the register url" name="sbnepal-ms_redirect-register" id="sbnepal-ms_redirect-register" autocomplete="off" style="width: 100%;">
                            <div class="sbnepal-ms_redirect-register-error error-shown"></div>
                        </div>

                        <div class="input-text-wrap" id="sbnepal-ms_redirect-wrap">
                            <label for="sbnepal-ms_redirect-login" style="display: inline-block;margin-bottom: 4px;">
                                Dashboard URL
                            </label>
                            <input type="text" value="<?php echo get_option("sbnepal-ms_redirect-dashboard", '/dashboard') ?>" placeholder="Enter the smtp host" name="sbnepal-ms_redirect-dashboard" id="sbnepal-ms_redirect-dashboard" autocomplete="off" style="width: 100%;">
                            <div class="sbnepal-ms_redirect-dashboard-error error-shown"></div>
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

        $sb('.sbnepal-ms-settings-wrapper').find('#sbNepalMsRedirectSettingForm').on (
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