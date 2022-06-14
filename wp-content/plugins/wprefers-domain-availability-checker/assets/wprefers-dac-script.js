(function ($) {

    var WpReferDomainCheckerManager = {
        init: function () {
            this.cacheDom();
            this.bind();
        },

        cacheDom: function () {
            this.$domainCheckerWrapper = $('.wprefers-domain-availability-checker-wrapper');
            this.searchBtn  = this.$domainCheckerWrapper.find('#wprefers-search');
        },

        bind: function () {
            this.searchBtn.on('click', this.xhr);
        },

        xhr: function (e) {
            e.preventDefault()

            var $this = $(this),
                urlQueryElement = $('input[name=wprefers-domain]');

            // Check input validation
            if (!urlQueryElement[0].checkValidity()) {
                urlQueryElement.siblings('.wprefers-error').show()
                $this.prop('disabled', false);
                return false;
            } else {
                urlQueryElement.siblings('.wprefers-error').hide()
            }

            $this.prop('disabled', true);

            $.ajax({
                url: wprefers_dac_script_data.ajaxurl,
                type: 'POST',
                data: {
                    action: wprefers_dac_script_data.action,
                    security: wprefers_dac_script_data.security,
                    domain: urlQueryElement.val(),
                    whoisKey: $('input[name=wprefers-whois-key]').val(),
                    url: $('input[name=wprefers-referral-url]').val()
                },
                success: function (response) {
                    WpReferDomainCheckerManager.$domainCheckerWrapper.find('.wprefers-domain-suggestions').html(
                        response.html
                    )
                    WpReferDomainCheckerManager.$domainCheckerWrapper
                        .find('.wprefers-domain-availability-checker-total-suggestions').html( response.total )
                    $this.prop('disabled', false);
                }
            });
        }
    }
    WpReferDomainCheckerManager.init();
}) (jQuery);