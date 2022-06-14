(function ($) {

    var WpReferDomainAgeCheckerManager = {
        init: function () {
            this.cacheDom();
            this.bind();
        },

        cacheDom: function () {
            this.$domainCheckerWrapper = $('.wprefers-domain-age-checker-wrapper');
            this.searchBtn  = this.$domainCheckerWrapper.find('#wprefers-domain-submit');
        },

        bind: function () {
            this.searchBtn.on('click', this.xhr);
        },

        xhr: function (e) {
            e.preventDefault()

            var $this = $(this),
                urlQueryElement = $('textarea[name=wprefers-domains]');

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
                url: wprefers_da_script_data.ajaxurl,
                type: 'POST',
                data: {
                    action: wprefers_da_script_data.action,
                    security: wprefers_da_script_data.security,
                    domains: urlQueryElement.val()
                },
                success: function (response) {
                    WpReferDomainAgeCheckerManager.$domainCheckerWrapper.find('.wprefers-domain-age-wrapper').html(
                        response.html
                    )
                    $this.prop('disabled', false);
                }
            });
        }
    }
    WpReferDomainAgeCheckerManager.init();
}) (jQuery);