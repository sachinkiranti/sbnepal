<div class="wrap">
    <h2><?php _e( 'Result', 'prasadi-result-sys' ); ?> <a href="<?php echo admin_url( 'admin.php?page=prasadi-result-sys&action=new' ); ?>" class="add-new-h2"><?php _e( 'Add New', 'prasadi-result-sys' ); ?></a></h2>

    <form method="post">
        <input type="hidden" name="page" value="ttest_list_table">

        <?php
        $list_table = new Prasadi_Result_Sys_Result_Table();
        $list_table->prepare_items();
        $list_table->search_box( 'search', 'search_id' );
        $list_table->display();
        ?>
    </form>
</div>