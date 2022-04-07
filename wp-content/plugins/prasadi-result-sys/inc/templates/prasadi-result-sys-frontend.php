<script>
    var $prasadiSys     = jQuery.noConflict();

    $prasadiSys(window).load(function(){
        var $prasadiSysForm = $prasadiSys("#prasadi-result-sys-form");
        $prasadiSys("#prasadi-result-sys-form").submit( function (e) {

            e.preventDefault();
            var spinner = "<i class='fa fa-spinner fa-spin'></i>";

            $prasadiSys("#prasadi-result-sys-form-submit").html( spinner+" Submit" ).prop('disabled', true);

            $prasadiSys.ajax(
                {
                    type: 'POST',
                    url: '<?php echo $prasadiBaseDir ?>inc/prasadi-result-sys-ajax.php',
                    data: $prasadiSys(this).serialize(),
                    success: function (response) {
                        response = response.data;
                        if( response.status === "validation" ) {
                            $prasadiSys.each(response.errors, function (key, value) {
                                $prasadiSys('.'+ key + "-error").html(value).show();
                            });
                        } else {
                            $prasadiSys('.prasadi-result-sys-response').html(response.view);
                            $prasadiSys("#prasadi-result-sys-form-submit").html( "Submit" ).prop('disabled', false);
                        }
                    }
                }
            );

            return false;

        } );
    });
</script>

<style>
    .prasadi-result-sys-wrapper input {
        background: #ffffff!important;
    }
</style>

<div class="prasadi-result-sys-wrapper">

    <h1><?php echo $title; ?></h1>

    <form method="POST" class="prasadi-result-sys-form" id="prasadi-result-sys-form">
        <?php wp_nonce_field('wps-frontend-prasadi-result-sys') ?>
        <input type="hidden" name="faculty" value="<?php echo $faculty; ?>" />
        <div class="form-group">
            <label for="symbolNumber">Symbol Number</label>
            <input type="text" name="symbolNumber" placeholder="Enter the symbol number"  class="form-control" id="symbolNumber" required>

            <div class="invalid-feedback symbolNumber-error"></div>
        </div>
        <br>
        <button type="submit" id="prasadi-result-sys-form-submit" class="btn btn-primary">Submit</button>
        <button type="reset" class="btn btn-default">Reset</button>
    </form>

    <div class="prasadi-result-sys-response">

    </div>
</div>