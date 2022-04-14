<script>
    var $sbNepal = jQuery.noConflict()

    $sbNepal(window).load( function() {
        var $sbNepalForm = $sbNepal("#sbnepal-ms-form-login");

        $sbNepalForm.submit( function (e) {
            e.preventDefault()

            var $this = $sbNepal(this),
                spinner = "<i class='fa fa-spinner fa-spin'></i>";

            $this.find('button[type=submit]').html( spinner + " Submitting ..." )
                .prop('disabled', true)

            $sbNepal.ajax({
                type: 'POST',
                url: '<?php echo $sbNepalBaseDir ?>inc/xhr/sbnepal-ms-login-xhr.php',
                data: $this.serialize(),
                success: function (response) {
                    response = response.data;

                    if( response.status === "validation" ) {
                        $sbNepal.each(response.errors, function (key, value) {
                            $sbNepal('.'+ key + "-error").html(value).show();
                        });
                        $sbNepal("#sbnepal-ms-form-login-submit").html( "Submit" ).prop('disabled', false);

                    } else if (response.status === "failed") {
                        toastr.error(response.message, 'Smart Business in Nepal.')
                        $sbNepal("#sbnepal-ms-form-login-submit").html( "Submit" ).prop('disabled', false);

                    } else {
                        toastr.success(response.message, 'Smart Business in Nepal.')
                        window.location.href = response.url
                    }
                }
            })

            return false;
        } )
    })
</script>

<div class="sbnepal-ms-wrapper">

    <h1><?php echo $title; ?></h1>

    <?php if (!is_user_logged_in()) : ?>
    <form method="POST" class="sbnepal-ms-form-login" id="sbnepal-ms-form-login">
        <?php wp_nonce_field('wps-frontend-sbnepal-ms-login') ?>
        <input type="hidden" name="dashboard" value="<?php echo $dashboard; ?>">

        <div class="row">
            <div class="col-sm-12">
                <div class="form-group">
                    <label for="refer-id">Refer ID</label>
                    <input type="text" name="refer_id" placeholder="Enter your refer id"  class="form-control" id="refer-id" required>

                    <div class="invalid-feedback refer-id-error"></div>
                </div>

                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="text" name="email" placeholder="Enter the email address"  class="form-control" id="email" required>

                    <div class="invalid-feedback email-error"></div>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" placeholder="Enter the password"  class="form-control" id="password" required>

                    <div class="invalid-feedback password-error"></div>
                </div>
                <br>
                <button type="submit" id="sbnepal-ms-form-login-submit" class="btn btn-primary">Submit</button>
                <button type="reset" class="btn btn-default">Reset</button>

                <?php if (! is_null($register)) : ?>
                    <a href="<?php echo $register; ?>">Register</a>
                <?php endif; ?>
            </div>
        </div>
    </form>
    <?php else : ?>
    <b>You are already logged in !</b>
        <a href="<?php echo wp_logout_url( home_url( '/' ) ); ?>" title="Logout">Logout</a>
    <?php endif; ?>
    <div class="sbnepal-ms-response">

    </div>
</div>