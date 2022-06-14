(function ($) {

    var WpReferInstaLiteManager = {
        init: function () {
            this.cacheDom();
            this.bind();
        },

        cacheDom: function () {
            this.$instaWrapper = $('.wprefers-instagram-lite-wrapper');
            this.searchBtn  = this.$instaWrapper.find('#wprefers-search');
        },

        bind: function () {
            this.searchBtn.on('click', this.xhr);
        },

        xhr: function (e) {
            e.preventDefault()

            var $this = $(this),
                usernameElement = $('input[name=wprefers-username]'),
                queryElement = $('select[name=wprefers-query]');

            // Check input validation
            if (!usernameElement[0].checkValidity()) {
                usernameElement.siblings('.wprefers-username-error').show()
                $this.prop('disabled', false);
                return false;
            } else {
                usernameElement.siblings('.wprefers-error').hide()
            }

            if (!queryElement[0].checkValidity()) {
                queryElement.siblings('.wprefers-query-error').show()
                $this.prop('disabled', false);
                return false;
            } else {
                queryElement.siblings('.wprefers-error').hide()
            }

            $this.prop('disabled', true);

            $.ajax({
                url: wprefers_insta_script_data.ajaxurl,
                type: 'POST',
                data: {
                    action: wprefers_insta_script_data.action,
                    security: wprefers_insta_script_data.security,
                    query: queryElement.val(),
                    username: usernameElement.val()
                },
                success: function (response) {
                    WpReferInstaLiteManager.$instaWrapper.find('.wprefers-instagram-lite-response').html(
                        response.html
                    )
                    $this.prop('disabled', false);
                }
            });
        }
    }
    WpReferInstaLiteManager.init();
}) (jQuery);