<script>
    $sbNepal = jQuery.noConflict()

    $sbNepal(function () {

        $sbNepal('[data-toggle="tooltip"]').tooltip();

        $sbNepal(document).on('click', '.sbnepal-ms-copy-referral-id',  function (e) {
            e.preventDefault()

            var $this = $sbNepal(this),
                referralId = $this.data('referralId');

            if (e.ctrlKey) {
                referralId = $this.data('registerUrl') + "?referral_id=" + referralId
            }

            var $temp = $sbNepal("<input>");
            $sbNepal("body").append($temp);
            $temp.val(referralId).select();
            document.execCommand("copy");
            $temp.remove();

            $this.find('.badge').html('COPIED')

            setTimeout(function () {
                $this.find('.badge').html('Referral ID')
            }, 1000)
        })

    })
</script>
<div class="row">
    <div class="col-sm-12">
        <?php if (!is_user_logged_in()) : ?>
            <b>Hello Guest</b>
        <?php else: ?>

            <?php $authUser = wp_get_current_user(); ?>
            <p> Hello Agent <?php echo ucwords($authUser->user_login) . ' ( ' . $authUser->user_email . ' )'; ?>.</p>

            <?php
            $totalCommission = reset(sbnepal_ms_wallet_get_commission_sum(get_current_user_id()));

            $commissionEarned =  ($totalCommission->total_commission > 0 ? $totalCommission->total_commission : 0);
            $commissionUnpaid =  ($totalCommission->total_unpaid_commission > 0 ? $totalCommission->total_unpaid_commission : 0);
            $commissionPaid =  ($totalCommission->total_paid_commission > 0 ? $totalCommission->total_paid_commission : 0);
            ?>
            <div class="row">
                <div class="col-sm-4">
                    <div class="card" style="width: 18rem;">
                        <div class="card-body">
                            <small class="card-title">
                                Total Commissions Earned
                            </small>

                            <p class="card-text">
                                NRS. <?php echo number_format($commissionEarned); ?>
                            </p>
                        </div>
                    </div>
                </div>

                <div class="col-sm-4">
                    <div class="card" style="width: 18rem;">
                        <div class="card-body">
                            <small class="card-title">
                                Total Commissions Paid
                            </small>

                            <p class="card-text">
                                NRS. <?php echo number_format($commissionPaid); ?>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="card" style="width: 18rem;">
                        <div class="card-body">
                            <small class="card-title">
                                Total Commissions Unpaid
                                <a class="pull-right" data-toggle="tooltip"
                                   title="Shortcuts : `CTRL + Click` to copy whole url else `click` to get only the referral ID."
                                   style="text-decoration: underline;float: right;cursor:pointer;">?</a>
                            </small>

                            <p class="card-text">
                                NRS. <?php echo number_format($commissionUnpaid); ?>
                            </p>

                            <?php $userReferId = get_the_author_meta( 'refer_id', get_current_user_id() ); ?>

                            <a href="javascript:void" data-referral-id="<?php echo $userReferId; ?>"
                               data-register-url="<?php echo home_url($register); ?>"
                               class="card-link sbnepal-ms-copy-referral-id"
                               title="Referral ID">
                                <?php echo $userReferId; ?>
                                <span class="badge badge-secondary">Referral ID</span>
                            </a>
                        </div>
                    </div>
                </div>

            </div>


            <?php $wallets = sbnepal_ms_wallet_get_all_wallet( array(), get_current_user_id() ); ?>

            <table class="table" style="margin-top: 10px;">
                <thead class="thead-light">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Referred</th>
                    <th scope="col">Commission Generated</th>
                    <th scope="col">Registered</th>
                    <th scope="col">Status</th>
                </tr>
                </thead>
                <tbody>

                <?php
//                sb_dump($wallets);
                $userData = get_userdata( get_current_user_id() );
                ?>

                <?php if (count($wallets) > 0): ?>

                    <?php $counter = 1; ?>

                    <?php foreach ($wallets as $wallet) : ?>
                        <tr>
                            <th scope="row"><?php echo $counter; ?></th>
                            <td>
                                <?php
                                $referral = get_user_by('id', $wallet->user_id);
                                $referralInfo = $referral->display_name . ' (' . $referral->user_email . ')';
                                echo $referralInfo;
                                ?>
                            </td>
                            <td class="total-commission-generated">NRS. <?php echo $wallet->commission; ?></td>
                            <td>
                                <small>
                                    <?php printf( 'Member since %s<br>', date( "M Y d", strtotime( $referral->user_registered ) ) ); ?>
                                </small>
                            </td>

                            <?php $isAgentActive = esc_html( get_the_author_meta( 'is_approved_by_admin', $referral->ID ) ) === 'yes'; ?>
                            <td>
                                <span class="badge badge-<?php echo $isAgentActive ? 'primary' : 'danger'; ?>"><?php echo $isAgentActive ? 'Active' : 'Inactive'; ?></span>
                            </td>
                        </tr>

                        <?php $counter++; ?>
                    <?php endforeach; ?>

                <?php else: ?>
                    <tr>
                        <td colspan="4">No Records.</td>
                    </tr>
                <?php endif; ?>
                </tbody>
            </table>

            <br>
            <a class="btn btn-primary" href="<?php echo wp_logout_url( home_url( '/' ) ); ?>" title="Logout">Logout</a>

        <?php endif; ?>
    </div>
</div>