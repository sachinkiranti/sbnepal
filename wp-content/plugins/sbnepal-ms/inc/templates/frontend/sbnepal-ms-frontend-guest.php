<div class="sbnepal-ms-wrapper text-center">

    <h1><?php echo $title; ?></h1>

    <?php if (!is_user_logged_in()) : ?>

        <div class="row">
            <div class="col-sm-12">

                <h3><?php echo $tagline; ?></h3>

                <?php if (! is_null($login)) : ?>
                    <a class="btn btn-primary" href="<?php echo $login; ?>">Login</a>
                <?php endif; ?>

                <?php if (! is_null($register)) : ?>
                    <a class="btn btn-danger" href="<?php echo $register; ?>">Register</a>
                <?php endif; ?>
            </div>
        </div>

    <?php else : ?>
        <b>You are already logged in !</b>
        <a href="<?php echo wp_logout_url( home_url( '/' ) ); ?>" title="Logout">Logout</a>
    <?php endif; ?>

    <div class="sbnepal-ms-response">

    </div>
</div>