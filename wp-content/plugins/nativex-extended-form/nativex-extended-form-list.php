<?php

if ( ! class_exists('WP_List_Table') ) :

    require_once ABSPATH.'wp-admin/includes/class-wp-list-table.php';

endif;

if ( ! class_exists('Nativex_Extended_Form_Table') ) :

    class Nativex_Extended_Form_Table extends WP_List_Table {

        public function __construct()
        {
            global $status, $page;

            parent::__construct(array(
                'singular' => 'nativex_extended_form',
                'plural'   => 'nativex_extended_forms',
            ));
        }

        public function column_default($item, $column_name)
        {
            return $item[$column_name];
        }

        public function column_name($item)
        {
            $actions = array(
                'edit' => sprintf('%s', $item['id'], __('Edit', 'company')),
                'delete' => sprintf('%s', $_REQUEST['page'], $item['id'], __('Delete', 'company')),
            );

            return sprintf('%s %s',
                $item['company_name'],
                $this->row_actions($actions)
            );
        }

        /**
         * [REQUIRED] this is how checkbox column renders
         *
         * @param $item - row (key, value array)
         * @return HTML
         */
        function column_cb($item)
        {
            return sprintf(
                '<input type="checkbox" name="id[]" value="%s" />',
                $item['id']
            );
        }

        public function get_columns()
        {
            $columns = array(
                'cb'            => '<input type="checkbox" />',
                'full_name'     => __('Full Name', 'nativex-extended-form'),
                'phone'         => __('Contact Number', 'nativex-extended-form'),
                'email'         => __('Email', 'nativex-extended-form'),
                'company_name'  => __('Company Name', 'nativex-extended-form'),
            );

            return $columns;
        }

        public function get_sortable_columns()
        {
            $sortable_columns  = array(
                'full_name'    => array('full_name', true),
                'phone'        => array('phone', false),
                'email'        => array('email', false),
                'company_name' => array('company_name', true),
            );

            return $sortable_columns;
        }

        public function get_bulk_actions()
        {
            $actions = array(
                'delete' => 'Delete',
            );

            return $actions;
        }

        public function process_bulk_action()
        {
            global $wpdb;
            $table_name = $wpdb->prefix.'nativex_extended_form';

            if ('delete' === $this->current_action()) {
                $ids = isset($_REQUEST['id']) ? $_REQUEST['id'] : array();
                if (is_array($ids)) {
                    $ids = implode(',', $ids);
                }

                if (!empty($ids)) {
                    $wpdb->query("DELETE FROM $table_name WHERE id IN($ids)");
                }
            }
        }

        public function prepare_items()
        {
            global $wpdb;
            $table_name = $wpdb->prefix.'nativex_extended_form';

            $per_page = 10;

            $columns = $this->get_columns();
            $hidden = array();
            $sortable = $this->get_sortable_columns();

            $this->_column_headers = array($columns, $hidden, $sortable);

            $this->process_bulk_action();

            $total_items = $wpdb->get_var("SELECT COUNT(id) FROM $table_name");

            $paged = isset($_REQUEST['paged']) ? max(0, intval($_REQUEST['paged']) - 1) : 0;
            $orderby = (isset($_REQUEST['orderby']) && in_array($_REQUEST['orderby'], array_keys($this->get_sortable_columns()))) ? $_REQUEST['orderby'] : 'full_name';
            $order = (isset($_REQUEST['order']) && in_array($_REQUEST['order'], array('asc', 'desc'))) ? $_REQUEST['order'] : 'asc';

            $this->items = $wpdb->get_results(
                $wpdb->prepare(
                    "SELECT * FROM $table_name ORDER BY $orderby $order LIMIT %d OFFSET %d", $per_page, $paged
                ),
                ARRAY_A);


            $this->set_pagination_args(array(
                'total_items' => $total_items,
                'per_page' => $per_page,
                'total_pages' => ceil($total_items / $per_page),
            ));
        }

    }

endif;

/**
 * List page handler
 *
 * This function renders our custom table
 * Notice how we display message about successfull deletion
 * Actualy this is very easy, and you can add as many features
 * as you want.
 *
 * Look into /wp-admin/includes/class-wp-*-list-table.php for examples
 */
function nativex_extended_form_page_handler()
{
    global $wpdb;
    $table = new Nativex_Extended_Form_Table();
    $table->prepare_items();
    $message = '';
    if ('delete' === $table->current_action()) {
        $message = '<div class="updated below-h2" id="message"><p>' . sprintf(__('Items deleted: %d', 'nativex-extended-form'), count($_REQUEST['id'])) . '</p></div>';
    }
    ?>
    <div class="wrap">

        <div class="icon32 icon32-posts-post" id="icon-edit"><br></div>
        <h2><?php _e('NativeX Extended Form', 'nativex-extended-form')?></h2>
        <?php echo $message; ?>

        <form id="nativex-extended-form-table" method="GET">
            <input type="hidden" name="page" value="<?php echo $_REQUEST['page'] ?>"/>
            <?php $table->display() ?>
        </form>

    </div>
    <?php
}