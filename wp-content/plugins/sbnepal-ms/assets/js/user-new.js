var $sbAdmin = jQuery.noConflict()

$sbAdmin(function () {

    var agentInfoWrapper = $sbAdmin('.sbnepal-ms_agent_information');

    // If errors is shown regarding agent information panel, show the agent info wrapper
    sbNepalToggleAgentInfoWrapper($sbAdmin('.sbnepal-ms-errors').length > 0)

    $sbAdmin(document).on('change', 'select[name=role]', function () {
        sbNepalToggleAgentInfoWrapper($sbAdmin(this).val() === 'agent')
    })

    function sbNepalToggleAgentInfoWrapper( $toggler ) {
        if ($toggler) {
            agentInfoWrapper.show()
        } else {
            agentInfoWrapper.hide()
        }
    }

})