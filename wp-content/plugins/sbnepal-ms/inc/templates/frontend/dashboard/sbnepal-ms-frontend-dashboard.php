<script>
    $sbNepal = jQuery.noConflict()

    $sbNepal(document).on('click', '.sbnepal-ms-copy-referral-id',  function (e) {
        e.preventDefault()

        var $this = $sbNepal(this)

        var $temp = $sbNepal("<input>");
        $sbNepal("body").append($temp);
        $temp.val($this.data('referralId')).select();
        document.execCommand("copy");
        $temp.remove();

        $this.find('.badge').html('COPIED')

        setTimeout(function () {
            $this.find('.badge').html('Referral ID')
        }, 1000)
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
                    <small class="card-title">Total Commissions Earned</small>
                    <p class="card-text">
                        NRS. <?php echo number_format(10000); ?>
                    </p>
                    <a href="javascript:void" data-referral-id="21221121" class="card-link sbnepal-ms-copy-referral-id" title="Referral ID">
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
                    <th scope="col">Last</th>
                    <th scope="col">Handle</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <th scope="row">1</th>
                    <td>Mark</td>
                    <td>Otto</td>
                    <td>@mdo</td>
                </tr>
                <tr>
                    <th scope="row">2</th>
                    <td>Jacob</td>
                    <td>Thornton</td>
                    <td>@fat</td>
                </tr>
                <tr>
                    <th scope="row">3</th>
                    <td>Larry</td>
                    <td>the Bird</td>
                    <td>@twitter</td>
                </tr>
                </tbody>
            </table>

            <br>
            <a class="btn btn-primary" href="<?php echo wp_logout_url( home_url( '/' ) ); ?>" title="Logout">Logout</a>

        <?php endif; ?>
    </div>
</div>