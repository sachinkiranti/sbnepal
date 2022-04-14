<div class="wrap">
    <h2><?php _e( 'Wallet', 'sbnepal-ms' ); ?></h2>

    <div id="dashboard-widgets-wrap">
        <div id="postbox-container-1" class="postbox-container">
            <div class="card">
                <h2 class="title">Total Commissions</h2>
                <p>NRS. <?php echo number_format(10000); ?></p>
            </div>
        </div>

        <div id="postbox-container-2" class="postbox-container">
            <div class="card">
                <h2 class="title">Filter</h2>

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
</div>

<script>
    var $sbNepal = jQuery.noConflict()

    $sbNepal(function () {
        $sbNepal(document).on('change', 'select[name=filter]', function (e) {
            alert($sbNepal(this).val())
        })
    })
</script>