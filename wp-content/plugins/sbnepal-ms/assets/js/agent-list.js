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
                    $this.remove()
                    toastr.success(response.data.message, 'Smart Business In Nepal')
                }

                $this.html( spinner + " Activate" )
                    .prop('disabled', false)
            }
        })

        return false
    })

    $sbAgent(document).on('click', '.sbnepal-ms-reject-agent', function (e) {
        e.preventDefault()

        var $this = $sbAgent(this),
            spinner = "<i class='fa fa-spinner fa-spin'></i>";

        $this.html( spinner + " Rejecting ..." )
            .prop('disabled', true)

        $sbAgent.ajax({
            type: 'POST',
            url: sbnepal_ajax_object.sbnepal_ms_reject_agent_url,
            data: {
                agentId: $this.data('agentId'),
                reject_information: $sbAgent('textarea[name=reject_information]').val(),
                _wpnonce: sbnepal_ajax_object.ajax_nonce_reject
            },
            beforeSend: function ( xhr ) {
                xhr.setRequestHeader( 'X-WP-Nonce', sbnepal_ajax_object.ajax_nonce_reject );
            },
            success: function (response) {

                if( response.data.status === "validation" ) {
                    $sbAgent.each(response.data.errors, function (key, value) {
                        $sbAgent('.'+ key + "-error").html(value).show();
                    });
                }
                else if( response.data.status === "invalid" ) {
                    toastr.error(response.data.message, 'Smart Business In Nepal')
                } else {
                    $this.remove()
                    toastr.success(response.data.message, 'Smart Business In Nepal')
                }

                $this.html( spinner + " Reject" )
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
            // $sbAgent('input[name=referral_id]').prop('required', true)
            $sbAgent('input[name=referral_id]').prop('readonly', true)
            $sbAgent('input[name=referral_id]').val('')
            $sbAgent('select[name=filter]').val('')
        } else {
            $sbAgent('.sbnepal_ms_add_agent_for_somebody_else-wrapper').hide()
            $sbAgent('input[name=referral_id]').prop('readonly', false)
            $sbAgent('input[name=referral_id]').val('')
            $sbAgent('select[name=filter]').val('')
        }

    })

    function initImagePopup(elem){
        // check for mouse click, add event listener on document
        document.addEventListener('click', function (e) {
            // check if click target is img of the elem - elem is image container
            if (!e.target.matches(elem +' img')) return;
            else{

                var image = e.target; // get current clicked image

                // create new popup image with all attributes for clicked images and offsets of the clicked image
                var popupImage = document.createElement("img");
                popupImage.setAttribute('src', image.src);
                popupImage.style.width = image.width+"px";
                popupImage.style.height = image.height+"px";
                popupImage.style.left = image.offsetLeft+"px";
                popupImage.style.top = image.offsetTop+"px";
                popupImage.classList.add('sbnepal-ms-img');

                // creating popup image container
                var popupContainer = document.createElement("div");
                popupContainer.classList.add('sbnepal-ms-img-gallery');

                // creating popup image background
                var popUpBackground = document.createElement("div");
                popUpBackground.classList.add('sbnepal-ms-img-gallery-pop-up');

                // append all created elements to the popupContainer then on the document.body
                popupContainer.appendChild(popUpBackground);
                popupContainer.appendChild(popupImage);
                document.body.appendChild(popupContainer);

                // call function popup image to create new dimensions for popup image and make the effect
                popupImageFunction();


                // resize function, so that popup image have responsive ability
                var wait;
                window.onresize = function(){
                    clearTimeout(wait);
                    wait = setTimeout(popupImageFunction, 100);
                };

                // close popup image clicking on it
                popupImage.addEventListener('click', function (e) {
                    closePopUpImage();
                });
                // close popup image on clicking on the background
                popUpBackground.addEventListener('click', function (e) {
                    closePopUpImage();
                });


                function popupImageFunction(){
                    // wait few miliseconds (10) and change style of the popup image and make it popup
                    // waiting is for animation to work, yulu can disable it and check what is happening when it's not there
                    setTimeout(function(){
                        // I created this part very simple, but you can do it much better by calculating height and width of the screen,
                        // image dimensions.. so that popup image can be placed much better
                        popUpBackground.classList.add('active');
                        popupImage.style.left = "15%";
                        popupImage.style.top = "50px";
                        popupImage.style.width = window.innerWidth * 0.7+"px";
                        popupImage.style.height = ((image.height / image.width) * (window.innerWidth * 0.7))+"px";
                    }, 10);
                }

                // function for closing popup image, first it will be return to the place where
                // it started then it will be removed totaly (deleted) after animation is over, in our case 300ms
                function closePopUpImage(){
                    popupImage.style.width = image.width+"px";
                    popupImage.style.height = image.height+"px";
                    popupImage.style.left = image.offsetLeft+"px";
                    popupImage.style.top = image.offsetTop+"px";
                    popUpBackground.classList.remove('active');
                    setTimeout(function(){
                        popupContainer.remove();
                    }, 300);
                }

            }
        });
    }

    if ($sbAgent(".sbnepal-ms-img-gallery-container").length > 0){
        initImagePopup(".sbnepal-ms-img-gallery-container")
    }

})