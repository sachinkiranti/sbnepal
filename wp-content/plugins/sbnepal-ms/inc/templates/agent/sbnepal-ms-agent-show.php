
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
    <?php $user = get_user_by('id', $_GET['agent_id']); ?>
    <div id="dashboard-widgets-wrap">
        <div id="postbox-container-1" class="postbox-container">
            <div class="card">
                <h2 class="title">Total Commissions</h2>
                <p>NRS. <?php echo number_format(reset(sbnepal_ms_wallet_get_commission_sum($user->ID))->total_commission); ?></p>
            </div>
        </div>

        <div id="postbox-container-1" class="postbox-container">
            <div class="card">
                <h2 class="title">Total Paid Commissions</h2>
                <p>NRS. <?php echo number_format(reset(sbnepal_ms_wallet_get_commission_sum($user->ID))->total_paid_commission); ?></p>
            </div>
        </div>

        <div id="postbox-container-1" class="postbox-container">
            <div class="card">
                <h2 class="title">Total Unpaid Commissions</h2>
                <p>NRS. <?php echo number_format(reset(sbnepal_ms_wallet_get_commission_sum($user->ID))->total_unpaid_commission); ?></p>
            </div>
        </div>
    </div>

    <div class="dashboard-widgets-wrap">
        <div class="metabox-holder">
            <div id="dashboard_activity" class="postbox ">
                <div class="inside">
                    <div id="col-container">
                        <div id="col-left">
                            <div class="col-wrap">

                                <table class="table-sbnepal-ms-agent" style="margin: 10px">

                                    <tr>
                                        <th style="float: left">
                                            User
                                        </th>
                                        <th >
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
                                            Added By
                                        </th>
                                        <th>
                                            <?php $agentId = esc_html( get_the_author_meta( 'agent_added_by', $user->ID ) ); ?>
                                            <?php if ($agentId) : ?>
                                                <?php $referral = get_user_by('id', $agentId); ?>
                                                <?php echo $referral->display_name . ' (' . $referral->user_email . ')' ?>
                                            <?php else : ?>
                                                Not Available
                                            <?php endif; ?>
                                        </th>
                                    </tr>

                                    <tr>
                                        <th style="float: left">
                                            Status
                                        </th>
                                        <th>
                                            <?php $isAgentActive = esc_html( get_the_author_meta( 'is_approved_by_admin', $user->ID ) ); ?>

                                            <?php if ($isAgentActive === 'yes') : ?>
                                                <b>Active</b>
                                            <?php elseif ($isAgentActive === 'rejected') : ?>
                                                <b>Rejected</b>
                                            <?php else : ?>
                                                <b>In-Active</b>
                                            <?php endif; ?>
                                        </th>
                                    </tr>

                                    <?php if ($isAgentActive === 'rejected') : ?>
                                        <tr>
                                            <th style="float: left;text-decoration: underline">
                                                Reason For Rejection
                                            </th>
                                            <th></th>
                                        </tr>
                                        <tr>
                                            <th>
                                                <?php $reason = esc_html( get_the_author_meta( 'reject_information', $user->ID ) ); ?>
                                                <p style="color: darkred"><?php echo $reason; ?></p>
                                            </th>
                                        </tr>
                                    <?php  endif;  ?>

                                </table>

                                <style>
                                    .sbnepal-ms-img-gallery-container img {
                                        cursor: pointer;
                                    }
                                    .sbnepal-ms-img-gallery {
                                        position: fixed;
                                        left: 0;
                                        bottom: 0;
                                        right: 0;
                                        top: 0;
                                        overflow: auto;
                                    }
                                    .sbnepal-ms-img-gallery .sbnepal-ms-img-gallery-pop-up {
                                        transition: all 0.3s ease-in-out;
                                        position: fixed;
                                        left: 0;
                                        bottom: 0;
                                        right: 0;
                                        top: 0;
                                    }
                                    .sbnepal-ms-img-gallery .sbnepal-ms-img-gallery-pop-up.active {
                                        background-color: rgba(0, 0, 0, 0.4);
                                    }
                                    .sbnepal-ms-img-gallery .sbnepal-ms-img {
                                        position: relative;
                                        display: block;
                                        transition: all 0.3s ease-in-out;
                                        border-radius: 6px;
                                        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, .15), 0 10px 10px -5px rgba(0, 0, 0, .1);
                                    }

                                </style>

                                <div class="sbnepal-ms-img-gallery-container" style="margin: 10px">
                                    <img src="<?php echo esc_html( get_the_author_meta( 'passport_size_photo', $user->ID ) ); ?>" height="100px" width="100px" alt="Passport Size Photo" title="Passport Size Photo">
                                    <img src="<?php echo esc_html( get_the_author_meta( 'citizenship_photo', $user->ID ) ); ?>"  height="100px" width="100px" alt="Citizenship Photo" title="Citizenship Photo">
                                    <img src="<?php echo esc_html( get_the_author_meta( 'signature_photo', $user->ID ) ); ?>" height="100px" width="100px" alt="Signature Photo" title="Signature Photo">
                                </div>

                                <?php if ($isAgentActive !== 'yes') : ?>
                                <button class="button action sbnepal-ms-activate-agent"
                                        title="Activating a agent will send an welcome email to the agent with refer id."
                                        data-action-url="'.$sbNepalBaseDir .'inc/xhr/sbnepal-ms-activate-agent-xhr.php"
                                        data-agent-id="<?php echo $user->ID; ?>"
                                        style="margin-bottom: 10px">Activate</button>
                                <?php endif; ?>

                            </div>
                        </div>

                        <div id="col-right">
                            <div class="col-wrap" style="margin-top: 10px">
                                <p>
                                    <a style="margin-bottom:10px" href="<?php echo admin_url( 'admin.php?page=sbnepal-ms-agent&action=edit&id='.$user->ID ); ?>" class="button action">
                                        <?php _e( 'Edit', 'sbnepal-ms' ); ?>
                                    </a>
                                    <small>Edit agent if necessary</small>
                                </p>
                                <?php if ($isAgentActive !== 'yes') : ?>
                                    <textarea name="reject_information" placeholder="Please type why the agent is rejected?" id="reject_information" style="width: 100%" cols="10" rows="5"></textarea>

                                    <div style="color: red" class="invalid-feedback reject_information-error"></div>

                                    <button class="button button-primary action sbnepal-ms-reject-agent"
                                            title="Reject the use due to some error entry."
                                            data-action-url="'.$sbNepalBaseDir .'inc/xhr/sbnepal-ms-reject-agent-xhr.php"
                                            data-agent-id="<?php echo $user->ID; ?>"
                                            style="margin-bottom: 10px">Reject</button>
                                <?php endif; ?>
                            </div>
                        </div>

                        <br class="clear" style="margin-bottom: 5px;">

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>