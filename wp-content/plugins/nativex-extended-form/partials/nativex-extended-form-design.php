<script>
    var $nativeX     = jQuery.noConflict();

    $nativeX(window).load(function(){
        var $nativeXForm = $nativeX("#nativex-extended-form");
        $nativeX("#nativex-extended-form").submit( function (e) {

            e.preventDefault();
            var spinner = "<i class='fa fa-spinner fa-spin'></i>";

            $nativeX("#nativex-extended-form-handler").html( spinner+" Submit" ).prop('disabled', true);

            $nativeX.ajax(
                {
                    type: 'POST',
                    url: '<?php echo $nativex_base_dir ?>nativex-extended-form-ajax.php',
                    data: $nativeX(this).serialize(),
                    success: function (response) {
                        response = response.data;
                        if( response.status === "validation" ) {
                            $nativeX.each(response.errors, function (key, value) {
                                $nativeX('.'+ key + "-error").html(value).show();
                            });
                        } else {
                            $nativeX('#nativex-extended-form .invalid-feedback').hide();
                            $nativeX('#nativex-extended-form #response-wrapper').remove();
                            $nativeX(('<div id="response-wrapper" class="success-message alert alert-success" role="alert">' +
                                response.message + ' <button type="button" class="btn btn-sm btn-default nativex-extended-form-show"><i class="fa fa-arrow-left"></i> Back</button></div>')).insertBefore('#nativex-extended-form #form-wrapper');
                        }
                        $nativeX("#nativex-extended-form-handler").html( "Submit" ).prop('disabled', false);
                        $nativeX("#nativex-extended-form #form-wrapper").hide();
                    }
                }
            );

            return false;

        } );
        $nativeX(document).on('click', '.nativex-extended-form-show', function (e) {
            e.preventDefault();
            $nativeXForm.trigger("reset");
            $('#response-wrapper').remove();
            $nativeX("#nativex-extended-form #form-wrapper").show();
        });
    });
</script>

<style>
    .nativex-extended-form input {
        background: #FFFFFF!important;
    }
</style>

<div class="row">
    <div class="col-md-5">
        <h2 class="text-white"><?php echo $title; ?></h2>
        <h5><sub class="text-white"><?php echo $tel_title; ?></sub></h5>
        <h4 class="text-white"><?php echo $tel; ?></h4>
    </div>
    <div class="col-md-7">
        <form class="contact-form-block" method="POST" id="nativex-extended-form">
            <div id="form-wrapper">
                <?php wp_nonce_field('wps-frontend-nativex-extended-form') ?>
                <div class="form-group nativex-extended-form">
                    <label for="exampleInputCompany">Company</label>
                    <input name="company_name" type="text" class="form-control" id="exampleInputCompany" placeholder="" required>
                    <div class="invalid-feedback company_name-error"></div>
                </div>
                <div class="form-group nativex-extended-form">
                    <label for="exampleInputName">Name <span class="astrik">*</span></label>
                    <input name="full_name" type="text" class="form-control" id="exampleInputName" placeholder="" required>
                    <div class="invalid-feedback full_name-error"></div>
                </div>
                <div class="form-group nativex-extended-form">
                    <label for="exampleInputEmail1">Email address <span class="astrik">*</span></label>
                    <input name="email" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="" required>
                    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                    <div class="invalid-feedback email-error"></div>
                </div>
                <div class="form-group nativex-extended-form">
                    <label for="exampleInputTel1">Tel</label>
                    <input name="telephone" type="text" class="form-control" id="exampleInputTel" placeholder="" required>
                    <div class="invalid-feedback telephone-error"></div>
                </div>
                <button type="submit" id="nativex-extended-form-handler" class="btn btn-primary">Submit</button>
                <button type="reset" class="btn btn-default">Reset</button>
            </div>
        </form>
    </div>
</div>