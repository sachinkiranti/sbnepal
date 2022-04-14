<div class="wrap sbnepal-ms-settings-wrapper">

    <h2><?php _e( 'Setting', 'sbnepal-ms' ); ?></h2>

    <div class="dashboard-widgets-wrap">
        <div class="metabox-holder">
            <div id="dashboard_activity" class="postbox ">
                <div class="postbox-header">
                    <h2 class="hndle">
                        Manage the Global Setting
                    </h2>
                </div>
                <div class="inside">
                    <form data-action-url="<?php echo $sbNepalBaseDir; ?>inc/xhr/sbnepal-ms-setting-xhr.php" id="sbNepalMsSettingForm" action="" method="post" style="padding-top: 10px">

                        <?php wp_nonce_field('wps-frontend-sbnepal-ms-register') ?>
                        <div class="input-text-wrap" id="sbnepal-ms_first_level_commission-wrap">
                            <label for="sbnepal-ms_first_level_commission" style="display: inline-block;margin-bottom: 4px;">
                                First Level Commission
                            </label>
                            <input type="number" value="<?php echo get_option("sbnepal-ms_first_level_commission", 150) ?>" placeholder="Enter the First Level Commission" name="sbnepal-ms_first_level_commission" id="sbnepal-ms_first_level_commission" autocomplete="off" style="width: 100%;">
                        </div>

                        <div class="input-text-wrap" id="sbnepal-ms_second_level_commission-wrap">
                            <label for="sbnepal-ms_second_level_commission" style="display: inline-block;margin-bottom: 4px;">
                                Second Level Commission
                            </label>
                            <input type="number" value="<?php echo get_option("sbnepal-ms_second_level_commission", 50) ?>" placeholder="Enter the Second Level Commission" name="sbnepal-ms_second_level_commission" id="sbnepal-ms_second_level_commission" autocomplete="off" style="width: 100%;">
                        </div>

                        <div class="input-text-wrap" id="sbnepal-ms_third_level_commission-wrap">
                            <label for="sbnepal-ms_third_level_commission" style="display: inline-block;margin-bottom: 4px;">
                                Third Level Commission
                            </label>
                            <input type="number" value="<?php echo get_option("sbnepal-ms_third_level_commission", 20) ?>" placeholder="Enter the Third Level Commission" name="sbnepal-ms_third_level_commission" id="sbnepal-ms_third_level_commission" autocomplete="off" style="width: 100%;">
                        </div>

                        <div class="input-text-wrap" id="sbnepal-ms_fourth_level_commission-wrap">
                            <label for="sbnepal-ms_fourth_level_commission" style="display: inline-block;margin-bottom: 4px;">
                                Fourth Level Commission
                            </label>
                            <input type="number" value="<?php echo get_option("sbnepal-ms_fourth_level_commission", 10) ?>" placeholder="Enter the Fourth Level Commission" name="sbnepal-ms_fourth_level_commission" id="sbnepal-ms_fourth_level_commission" autocomplete="off" style="width: 100%;">
                        </div>

                        <div class="textarea-wrap" id="description-wrap">
                            <label for="content" style="display: inline-block;margin-bottom: 4px;">
                                Email Template [Event : When agent is activated.] <br>
                                Available Patterns :
                                <code style="color: #0a4b78;">{%AGENT_NAME%}</code>
                                <code style="color: #0a4b78;">{%AGENT_REFER_ID%}</code>
                                <code style="color: #0a4b78;">{%AGENT_PASSWORD%}</code>
                            </label>
                            <textarea style="width: 100%;" name="sbnepal-ms_agent_activation_email_template" id="sbnepal_ms_agent_activation_email_template"
                                      placeholder="Write email template for agent activation." class="mceEditor"
                                      rows="3" cols="15" autocomplete="off"><?php echo get_option("sbnepal-ms_agent_activation_email_template") ?></textarea>
                        </div>

                        <p>
                            <input type="submit" name="save" id="save-post" class="button button-primary" value="Update">
                            <br class="clear">
                        </p>

                    </form>
                    <div id="activity-widget">
                        <div id="published-posts" class="activity-block">
                            <span>Last Updated, <b class="sbnepal-ms_last_updated"><?php echo get_option('sbnepal_ms_setting_last_updated', date("Y-m-d H:i:s")) ?></b></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <form method="post">
        <input type="hidden" name="page" value="ttest_list_table">
    </form>
</div>

<script>
    $sb = jQuery.noConflict()

    $sb(function () {

        $sb('.sbnepal-ms-settings-wrapper').find('#sbNepalMsSettingForm').on (
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
                        if( response.status === "validation" ) {
                            $sb.each(response.errors, function (key, value) {
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