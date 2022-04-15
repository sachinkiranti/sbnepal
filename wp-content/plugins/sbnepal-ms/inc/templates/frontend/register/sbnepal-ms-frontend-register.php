<script>
    var $sbNepal = jQuery.noConflict()

    $sbNepal(window).load( function() {

        $sbNepal('[data-toggle="tooltip"]').tooltip();

        var $sbNepalForm = $sbNepal("#sbnepal-ms-form-register");

        $sbNepalForm.submit( function (e) {
            e.preventDefault()

            var $this = $sbNepal(this),
                spinner = "<i class='fa fa-spinner fa-spin'></i>";

            $this.find('button[type=submit]')
                .html( spinner + " Submitting ..." )
                .prop('disabled', true)

            $sbNepal.ajax({
                type: 'POST',
                url: '<?php echo $sbNepalBaseDir ?>inc/xhr/sbnepal-ms-register-xhr.php',
                data: $this.serialize(),
                success: function (response) {
                    response = response.data;
                    if( response.status === "validation" ) {
                        $sbNepal.each(response.errors, function (key, value) {
                            $sbNepal('.'+ key + "-error").html(value).show();
                        });

                        $sbNepal("#sbnepal-ms-form-register-submit").html( "Submit" ).prop('disabled', false);
                    }
                    else if( response.status === "invalid" ) {
                        toastr.error(response.message, 'Smart Business In Nepal')
                        $sbNepal("#sbnepal-ms-form-register-submit").html( "Submit" ).prop('disabled', false);
                    }
                    else {
                        toastr.success(response.message, 'Smart Business In Nepal')
                        $sbNepal("#sbnepal-ms-form-register-submit").html( "Submit" ).prop('disabled', false);
                    }
                }
            })

            return false;
        } )

        $sbNepal('.sbnepal-ms-dropify').dropify({
            messages: {
                'default': 'Drag and drop a file here or click',
                'replace': 'Drag and drop or click to replace',
                'remove':  'Remove',
                'error':   'Ooops, something wrong happended.'
            }
        })
    })
</script>

<div class="sbnepal-ms-wrapper">

    <h1><?php echo $title; ?></h1>

    <?php if (!is_user_logged_in()) : ?>
    <form method="POST" class="sbnepal-ms-form-register" id="sbnepal-ms-form-register" enctype="multipart/form-data">
        <?php wp_nonce_field('wps-frontend-sbnepal-ms-register') ?>

        <div class="row">

            <div class="col-sm-6">
                <div class="form-group">
                    <label for="referral_id">Referral ID(required)</label>
                    <a class="pull-right" data-toggle="tooltip" title="Referral ID is mandatory as you should be registered only when you are referred by someone." style="text-decoration: underline;float: right;cursor:pointer;">?</a>
                    <input type="text" name="referral_id" placeholder="Enter the referral id"  class="form-control" id="referral_id" value="<?php echo esc_attr($_GET['referral_id']); ?>" required>

                    <div class="invalid-feedback referral_id-error"></div>
                </div>

                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" placeholder="Enter the name"  class="form-control" id="name" required>

                    <div class="invalid-feedback name-error"></div>
                </div>

                <div class="form-group">
                    <label for="fatherName">Father Name</label>
                    <input type="text" name="father_name" placeholder="Enter the father name"  class="form-control" id="fatherName" required>

                    <div class="invalid-feedback father_name-error"></div>
                </div>

                <div class="form-group">
                    <label for="address">Address</label>
                    <input type="text" name="address" placeholder="Enter the address"  class="form-control" id="address" required>

                    <div class="invalid-feedback address-error"></div>
                </div>

                <div class="form-group">
                    <label for="citizenshipNo">Citizenship No</label>
                    <input type="text" name="citizenship_no" placeholder="Enter the citizenship no"  class="form-control" id="citizenshipNo" required>

                    <div class="invalid-feedback citizenship_no-error"></div>
                </div>

                <div class="form-group">
                    <label for="qualification">Qualification</label>
                    <a class="pull-right" data-toggle="tooltip" title="Qualification ?" style="text-decoration: underline;float: right;cursor:pointer;">?</a>

                    <input type="text" name="qualification" placeholder="Enter the qualification"  class="form-control" id="qualification" required>

                    <div class="invalid-feedback qualification-error"></div>
                </div>

                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="text" name="email" placeholder="Enter the email address"  class="form-control" id="email" required>

                    <div class="invalid-feedback email-error"></div>
                </div>

                <div class="form-group">
                    <label for="phone">Phone Number</label>
                    <input type="number" name="phone_number" placeholder="Enter the phone number"  class="form-control" id="phone" required>

                    <div class="invalid-feedback phone_number-error"></div>
                </div>
            </div>

            <div class="col-sm-6">
                <div class="form-group">
                    <label for="pp_size_photo">PP Size Clear Photo</label>
                    <input type="file" data-max-file-size-preview="2M" data-max-file-size="2M" data-allowed-file-extensions="png jpeg jpg" name="passport_size_photo" class="form-control dropify sbnepal-ms-dropify" id="pp_size_photo" required>

                    <div class="invalid-feedback pp_size_photo-error"></div>
                </div>

                <div class="form-group">
                    <label for="citizenship_photo">Citizenship Photo</label>
                    <input type="file" data-max-file-size-preview="2M" data-max-file-size="2M" data-allowed-file-extensions="png jpeg jpg" name="citizenship_photo" class="form-control dropify sbnepal-ms-dropify" id="citizenship_photo" required>

                    <div class="invalid-feedback citizenship_photo-error"></div>
                </div>

                <div class="form-group">
                    <label for="signature">Signature</label>
                    <input type="file" data-max-file-size-preview="2M" data-max-file-size="2M" data-allowed-file-extensions="png jpeg jpg" name="signature_photo" class="form-control dropify sbnepal-ms-dropify" id="signature" required>

                    <div class="invalid-feedback signature-error"></div>
                </div>
            </div>

        </div>

       <div class="row">
           <div class="col-sm-12">
               <div class="form-group">
                   <label for="password">Password</label>
                   <input type="password" name="password" placeholder="Enter the password"  class="form-control" id="password" required>

                   <div class="invalid-feedback password-error"></div>
               </div>

               <div class="form-group">
                   <label for="confirmPassword">Confirm Password</label>
                   <input type="password" name="password_confirmation" placeholder="Enter the password"  class="form-control" id="confirmPassword" required>

                   <div class="invalid-feedback password_confirmation-error"></div>
               </div>

               <br>
               <button type="submit" id="sbnepal-ms-form-register-submit" class="btn btn-primary">Submit</button>
               <button type="reset" class="btn btn-default">Reset</button>

               <?php if (! is_null($login)) : ?>
                   <a href="<?php echo $login; ?>">Login</a>
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