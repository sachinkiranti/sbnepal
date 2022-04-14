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

            <div class="card" style="width: 18rem;">
                <div class="card-body">
                    <small class="card-title">
                        Total Commissions Earned
                        <a class="pull-right" data-toggle="tooltip"
                              title="Shortcuts : `CTRL + Click` to copy whole url else `click` to get only the referral ID."
                              style="text-decoration: underline;float: right;cursor:pointer;">?</a>
                    </small>
                    <p class="card-text">
                        NRS. <?php echo number_format(10000); ?>
                    </p>
                    <a href="javascript:void" data-referral-id="21221121"
                       data-register-url="<?php echo home_url($register); ?>"
                       class="card-link sbnepal-ms-copy-referral-id"
                       title="Referral ID">
                        21221121
                        <span class="badge badge-secondary">Referral ID</span>
                    </a>
                </div>
            </div>

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
                $userData = get_userdata( get_current_user_id() );
                ?>

                <tr>
                    <th scope="row">1</th>
                    <td><?php echo mt_rand(1, 5); ?></td>
                    <td class="total-commission-generated">NRS. <?php echo array(150, 50, 25, 10)[mt_rand(0, 3)]; ?></td>
                    <td>
                        <small>
                            <?php printf( '%s member since %s<br>', $userData->data->display_name, date( "M Y", strtotime( $userData->user_registered ) ) ); ?>
                        </small>
                    </td>

                    <?php $user1Index = mt_rand(0, 1); ?>

                    <td>
                        <span class="badge badge-<?php echo $user1Index ? 'primary' : 'danger'; ?>"><?php echo $user1Index ? 'Active' : 'Inactive'; ?></span>
                    </td>
                </tr>
                <tr>
                    <th scope="row">2</th>
                    <td><?php echo mt_rand(1, 5); ?></td>
                    <td class="total-commission-generated">NRS. <?php echo array(150, 50, 25, 10)[mt_rand(0, 3)]; ?></td>
                    <td>
                        <small>
                            <?php printf( '%s member since %s<br>', $userData->data->display_name, date( "M Y", strtotime( $userData->user_registered ) ) ); ?>
                        </small>
                    </td>
                    <?php $user2Index = mt_rand(0, 1); ?>

                    <td>
                        <span class="badge badge-<?php echo $user2Index ? 'primary' : 'danger'; ?>"><?php echo $user2Index ? 'Active' : 'Inactive'; ?></span>
                    </td>
                </tr>
                <tr>
                    <th scope="row">3</th>
                    <td><?php echo mt_rand(1, 5); ?></td>
                    <td class="total-commission-generated">NRS. <?php echo array(150, 50, 25, 10)[mt_rand(0, 3)]; ?></td>
                    <td>
                        <small>
                            <?php printf( '%s member since %s<br>', $userData->data->display_name, date( "M Y", strtotime( $userData->user_registered ) ) ); ?>
                        </small>
                    </td>
                    <?php $user3Index = mt_rand(0, 1); ?>

                    <td>
                        <span class="badge badge-<?php echo $user3Index ? 'primary' : 'danger'; ?>"><?php echo $user3Index ? 'Active' : 'Inactive'; ?></span>
                    </td>
                </tr>
                </tbody>
            </table>

            <br>
            <a class="btn btn-primary" href="<?php echo wp_logout_url( home_url( '/' ) ); ?>" title="Logout">Logout</a>

        <?php endif; ?>
    </div>
</div>