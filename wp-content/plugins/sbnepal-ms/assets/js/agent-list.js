$sbAgent = jQuery.noConflict()

$sbAgent(function () {

    $sbAgent(document).on('click', '.sbnepal-ms-activate-agent', function (e) {
        e.preventDefault()

        var $this = $sbAgent(this),
            spinner = "<i class='fa fa-spinner fa-spin'></i>";

        $this.html( spinner + " Activating ..." )
            .prop('disabled', true)

        $sbAgent.ajax({
            type: 'POST',
            url: $this.data('actionUrl'),
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

})