<div class="wrap">
    <h2><?php _e( 'Wallet', 'sbnepal-ms' ); ?></h2>

    <div id="dashboard-widgets-wrap">
        <div id="postbox-container-1" class="postbox-container">

            <?php
            $totalCommission = reset(sbnepal_ms_wallet_get_commission_sum(get_current_user_id()))->total_commission;

            $commissionEarned =  ($totalCommission > 0 ? $totalCommission : 0);
            ?>
            <div class="card">
                <h2 class="title">Total Commissions</h2>
                <p>NRS. <?php echo number_format($commissionEarned); ?></p>
            </div>
        </div>

        <div id="postbox-container-2" class="postbox-container">
            <div class="card">
                <h2 class="title">Filter Related To</h2>

                <select name="filter" id="walletFilter">
                    <option selected disabled>Select Agent</option>

                    <?php foreach (sbnepal_ms_get_all_agent() as $agent) : ?>
                    <option value="<?php echo $agent->ID; ?>"><?php echo $agent->display_name . ' ( ' . $agent->user_email . ' )'; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
    </div>


    <form method="post">
        <input type="hidden" name="page" value="ttest_list_table">

        <?php
        $list_table = new SBNepal_MS_Agent_Table();
        $list_table->prepare_items();
        $list_table->display();
        ?>
    </form>

    <div id="my-dialog" class="hidden" style="max-width:800px">
        <p>You are about to enter manual payment entry <span style="color:red;" class="sbnepal-ms-money-holder"></span> to <span style="color:blue;" class="sbnepal-ms-referral-holder"></span>.</p>
        <button class="button action sbnepal-ms-pay-agent-modal">Pay</button>
    </div>
</div>

<script>
    var $sbNepal = jQuery.noConflict()

    $sbNepal(function () {
        $sbNepal(document).on('change', 'select[name=filter]', function (e) {
            // alert($sbNepal(this).val())
        })
        
        $sbNepal(document).on('click', '.sbnepal-ms-pay-agent-modal', function (e) {
            e.preventDefault()
        })

        $sbNepal(document).on('click', '.sbnepal-ms-pay-agent', function (e) {
            e.preventDefault()

            $sbNepal('#my-dialog').find('.sbnepal-ms-money-holder').html(
                $sbNepal(this).parents('tr').find('.column-commission').html()
            )

            $sbNepal('#my-dialog').find('.sbnepal-ms-referral-holder').html(
                $sbNepal(this).parents('tr').find('.column-referral_id').html()
            )
            $sbNepal('#my-dialog').dialog('open');
        })

        $sbNepal('#my-dialog').dialog({
            title: 'Manual Payment Process',
            dialogClass: 'wp-dialog',
            autoOpen: false,
            draggable: false,
            width: 'auto',
            modal: true,
            resizable: false,
            closeOnEscape: true,
            position: {
                my: "center",
                at: "center",
                of: window
            },
            open: function () {
                // close dialog by clicking the overlay behind it
                $sbNepal('.ui-widget-overlay').bind('click', function(){
                    $sbNepal('#my-dialog').dialog('close');
                })
            },
            create: function () {
                // style fix for WordPress admin
                $sbNepal('.ui-dialog-titlebar-close').addClass('ui-button');
            },
        });
    })
</script>