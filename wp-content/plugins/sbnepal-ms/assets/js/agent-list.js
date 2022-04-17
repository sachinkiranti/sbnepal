$sbAgent = jQuery.noConflict()

$sbAgent(function () {

    if(typeof $sbAgent.fn.dropify !== 'undefined') {
        $sbAgent('.dropify').dropify()
    }

    $sbAgent(document).on('click', '.sbnepal-ms-activate-agent', function (e) {
        e.preventDefault()

        var $this = $sbAgent(this),
            spinner = "<i class='fa fa-spinner fa-spin'></i>";

        $this.html( spinner + " Activating ..." )
            .prop('disabled', true)

        $sbAgent.ajax({
            type: 'POST',
            url: sbnepal_ajax_object.sbnepal_ms_active_agent_url,
            data: {
                agentId: $this.data('agentId'),
                _wpnonce: sbnepal_ajax_object.ajax_nonce
            },
            beforeSend: function ( xhr ) {
                xhr.setRequestHeader( 'X-WP-Nonce', sbnepal_ajax_object.ajax_nonce );
            },
            success: function (response) {
                if( response.status === "validation" ) {
                    $sbAgent.each(response.errors, function (key, value) {
                        $sbAgent('.'+ key + "-error").html(value).show();
                    });
                }
                else if( response.data.status === "invalid" ) {
                    toastr.error(response.data.message, 'Smart Business In Nepal')
                } else {
                    toastr.success(response.data.message, 'Smart Business In Nepal')
                }

                $this.html( spinner + " Activate" )
                    .prop('disabled', false)
            }
        })

        return false
    })

    $sbAgent(document).on('change', 'select[name=filter]', function () {
        var referralID = $sbAgent(this).find(":selected").data('referId');
        $sbAgent('input[name=referral_id]').val(
            referralID ? referralID : null
        )
    })

    $sbAgent(document).on('change', 'input[name=add_agent_for_somebody_else]', function () {

        if ($sbAgent(this).is(':checked')) {
            $sbAgent('.sbnepal_ms_add_agent_for_somebody_else-wrapper').show()
            $sbAgent('input[name=referral_id]').prop('required', true)
            $sbAgent('input[name=referral_id]').prop('readonly', true)
            $sbAgent('input[name=referral_id]').val('')
            $sbAgent('select[name=referral_id]').val('')
        } else {
            $sbAgent('.sbnepal_ms_add_agent_for_somebody_else-wrapper').hide()
            $sbAgent('input[name=referral_id]').prop('readonly', false)
        }

    })

})