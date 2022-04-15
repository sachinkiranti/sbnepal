<div class="wrap">
    <h2><?php _e( 'Agent', 'sbnepal-ms' ); ?> <a href="<?php echo admin_url( 'admin.php?page=sbnepal-ms&action=new' ); ?>" class="add-new-h2"><?php _e( 'Add New', 'sbnepal-ms' ); ?></a></h2>

    <form method="post">
        <input type="hidden" name="page" value="ttest_list_table">

        <?php
            $list_table = new SBNepal_MS_Agent_Table();
            $list_table->prepare_items();
            $list_table->search_box( 'search', 'search_id' );
            $list_table->display();
        ?>
    </form>
</div>

<script>
    $sbAgent = jQuery.noConflict()

    $sbAgent(function () {

        $sbAgent(document).on('click', '.sbnepal-ms-activate-agent', function (e) {
            e.preventDefault()

            var $this = $sbAgent(this),
                spinner = "<i class='fa fa-spinner fa-spin'></i>";

            $this.val( spinner + " Activating ..." )
                .prop('disabled', true)

            $sbAgent.ajax({
                type: 'POST',
                url: $sbAgent(this).data('actionUrl'),
                data: {
                    agentId: $this.data('agentId'),
                    '_wpnonce': $this.data('wpnonce')
                },
                success: function (response) {
                    if( response.status === "validation" ) {
                        $sbAgent.each(response.errors, function (key, value) {
                            $sbAgent('.'+ key + "-error").html(value).show();
                        });
                    } else {
                        toastr.success(response.data.message, 'Smart Business In Nepal')
                    }

                    $this.val( spinner + " Activate" )
                        .prop('disabled', true)
                }
            })

            return false
        })

    })
</script>