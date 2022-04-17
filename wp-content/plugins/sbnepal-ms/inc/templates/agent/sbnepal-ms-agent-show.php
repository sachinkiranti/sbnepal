
<div class="wrap sbnepal-ms-add-a-new-agent-wrapper">
    <h2>
        <?php _e( 'Agent Detail', 'sbnepal-ms' ); ?>
        <a href="<?php echo admin_url( 'admin.php?page=sbnepal-ms-agent' ); ?>" class="add-new-h2">
            <?php _e( 'List', 'sbnepal-ms' ); ?>
        </a>
        <a href="<?php echo admin_url( 'admin.php?page=sbnepal-ms-agent&action=new' ); ?>" class="add-new-h2">
            <?php _e( 'Add', 'sbnepal-ms' ); ?>
        </a>
    </h2>

    <div class="dashboard-widgets-wrap">
        <div class="metabox-holder">
            <div id="dashboard_activity" class="postbox ">
                <div class="inside">
                    <div id="col-container">
                        <div id="col-left">
                            <div class="col-wrap">

                                <?php $user = get_user_by('id', $_GET['agent_id']); ?>

                                <table class="table-sbnepal-ms-agent" style="margin: 10px">

                                    <tr>
                                        <th style="float: left">
                                            User
                                        </th>
                                        <th style="float: right;clear: both;">
                                            @<?php echo $user->user_login; ?>
                                        </th>
                                    </tr>

                                    <tr>
                                        <th style="float: left">
                                            Email Address
                                        </th>
                                        <th>
                                            <?php echo $user->user_email; ?>
                                        </th>
                                    </tr>

                                    <tr>
                                        <th style="float: left">
                                            Phone Number
                                        </th>
                                        <th>
                                            <?php echo esc_html( get_the_author_meta( 'phone_number', $user->ID ) ); ?>
                                        </th>
                                    </tr>

                                    <tr>
                                        <th style="float: left">
                                            Registered At
                                        </th>
                                        <th>
                                            <?php echo $user->user_registered; ?>
                                        </th>
                                    </tr>

                                    <tr>
                                        <th style="float: left">
                                            Referral ID
                                        </th>
                                        <th>
                                            <?php echo esc_html( get_the_author_meta( 'referral_id', $user->ID ) ); ?>
                                        </th>
                                    </tr>

                                    <tr>
                                        <th style="float: left">
                                            Refer ID
                                        </th>
                                        <th>
                                            <?php echo esc_html( get_the_author_meta( 'refer_id', $user->ID ) ); ?>
                                        </th>
                                    </tr>

                                    <tr>
                                        <th style="float: left">
                                            Address
                                        </th>
                                        <th>
                                            <?php echo esc_html( get_the_author_meta( 'address', $user->ID ) ); ?>
                                        </th>
                                    </tr>

                                    <tr>
                                        <th style="float: left">
                                            Qualification
                                        </th>
                                        <th>
                                            <?php echo esc_html( get_the_author_meta( 'qualification', $user->ID ) ); ?>
                                        </th>
                                    </tr>

                                    <tr>
                                        <th style="float: left">
                                            Status
                                        </th>
                                        <th>
                                            <?php $isAgentActive = esc_html( get_the_author_meta( 'is_approved_by_admin', $user->ID ) ); ?>
                                            <?php if ($isAgentActive) : ?>
                                                <b>Active</b>
                                            <?php else : ?>
                                                <b>In-Active</b>
                                            <?php endif; ?>
                                        </th>
                                    </tr>

                                </table>

                                <?php if (!$isAgentActive) : ?>
                                <button class="button action sbnepal-ms-activate-agent"
                                        title="Activating a agent will send an welcome email to the agent with refer id."
                                        data-action-url="'.$sbNepalBaseDir .'inc/xhr/sbnepal-ms-activate-agent-xhr.php"
                                        data-agent-id="<?php echo $user->ID; ?>"
                                        style="margin-bottom: 10px">Activate</button>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div id="col-right">
                            <div class="col-wrap">
                                <div class="sbnepal-ms-img-gallery" style="margin: 10px">
                                    <img class="sbnepal-ms-img" src="<?php echo esc_html( get_the_author_meta( 'passport_size_photo', $user->ID ) ); ?>" height="100px" width="100px" alt="Passport Size Photo" title="Passport Size Photo">
                                    <img src="<?php echo esc_html( get_the_author_meta( 'citizenship_photo', $user->ID ) ); ?>"  height="100px" width="100px" alt="Citizenship Photo" title="Citizenship Photo">
                                    <img src="<?php echo esc_html( get_the_author_meta( 'signature_photo', $user->ID ) ); ?>" height="100px" width="100px" alt="Signature Photo" title="Signature Photo">
                                </div>
                            </div>
                        </div>

                        <br class="clear" style="margin-bottom: 5px;">

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>