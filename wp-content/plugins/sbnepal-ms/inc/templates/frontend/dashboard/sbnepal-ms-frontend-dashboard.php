<div class="row">
    <div class="col-sm-12">
        <?php if (!is_user_logged_in()) : ?>
            <b>Hello Guest</b>
        <?php else: ?>
            <b>Hello Dashboard</b>
            <a href="<?php echo wp_logout_url( home_url( '/' ) ); ?>" title="Logout">Logout</a>

        <?php endif; ?>
    </div>
</div>