<?php

if (! function_exists('prasadi_result_sys_import_handler') ) :

    function prasadi_result_sys_import_handler () {

        global $wpdb;
        $table_name = $wpdb->prefix.'prasadi_result_sys_faculties';
        $sql = "SELECT * FROM $table_name";

        $faculties = $wpdb->get_results( $sql );
        ?>
        <div class="wrap">

            <div class="icon32 icon32-posts-post" id="icon-edit"><br></div>
            <h2> <span class="dashicons dashicons-upload"></span> <?php _e('Prasadi Result System Importer', 'prasadi-result-sys')?></h2>

            <?php

                if (isset($_GET['status'])) {
                    if ($_GET['status'] === 'yes') {
                        ?>
                        <div class="updated notice">
                            <p>You have imported successfully !</p>
                        </div>
                        <?php
                    } else {
                        ?>
                        <div class="error notice">
                            <p>There has been an error. Bummer</p>
                        </div>
                        <?php
                    }
                }

            ?>

            <form id="prasadi-result-sys-table" enctype="multipart/form-data" action="<?php echo esc_html( admin_url( 'admin.php' ) ); ?>" method="POST">

                <p>
                    <label><b>Select File <code>File Format .xlsx, .xls</code></b></label>
                    <br /><br />
                    <input type="file" name="imported_file" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" style="min-height: 30px;max-width: 25rem;border: 1px solid #7e8993;width: 100%;padding: 10px;" />
                </p>
                <input type="hidden" name="action" value="prasadi_result_sys_import_init" />

                <fieldset>
                    <label><b>Faculty</b> <code>Imported xslx will be imported to this faculty</code></label> <br>
                    <?php if (count($faculties)> 0) : ?>
                        <br>
                        <select name="faculty_id" id="faculty_id" required style="width: 100%;">
                        <?php foreach ($faculties as $faculty) { ?>
                            <option value="<?php echo $faculty->id; ?>"><?php echo ucwords($faculty->faculty_name); ?></option>
                        <?php } ?>
                        </select>
                    <?php endif; ?>
                </fieldset>

                <?php if (count($faculties)> 0) :
                    submit_button('Import the result');
                    else : ?>
                        <b>Create faculty first <a href="admin.php?page=prasadi-result-sys-faculty&action=new">Add Faculty</a></b>
                    <?php  endif;    ?>
            </form>

        </div>
        <?php
    }

endif;

add_action( 'admin_action_prasadi_result_sys_import_init', 'prasadi_result_sys_import_init_admin_action' );

function prasadi_result_sys_import_init_admin_action () {
    if(isset($_POST['submit']) && isset($_FILES['imported_file'])) {
        require(dirname(__FILE__) . '/../libs/spreadsheet-reader/php-excel-reader/excel_reader2.php');
        require(dirname(__FILE__) . '/../libs/spreadsheet-reader/SpreadsheetReader.php');

        $uploaded = media_handle_upload('imported_file', 0);

        if(is_wp_error($uploaded)){
            echo "Error uploading file: " . $uploaded->get_error_message();
        } else {
            $year = date('Y');
            $month = date('m');

            $fileName = basename ( get_attached_file( $uploaded ) ); // $_FILES['imported_file']['name']

            $targetPath = get_site_url()."/wp-content/uploads/".$year."/".$month."/".$fileName;
            $targetPath2 = $_SERVER['DOCUMENT_ROOT']."/wp-content/uploads/".$year."/".$month."/".$fileName;

            if (file_exists($targetPath2)) {
                if(is_readable($targetPath2)) {
//                    $data = new ExcelReader($targetPath2);
//                    print_r($data->GetInArray());
//                    exit();
                    try {
                        $rows = new SpreadsheetReader($targetPath2);
                    } catch (Exception $exception) {
                        var_dump($exception->getMessage());
                    }
                    foreach ($rows as $row)
                    {

                        insertResult(array(
                            'symbol_number'     => $row[1],
                            'result'            => $row[2],
                            'appointment_date'  => isset($row[3]) ? $row[3] : null,
                            'appointment_time'  => isset($row[4]) ? $row[4] : null,
                            'faculty_id'        => $_POST['faculty_id'],
                            'meeting_link'   => isset($row[5]) ? $row[5] : null,
                            'meeting_id'   => isset($row[6]) ? $row[6] : null,
                            'password'   => isset($row[7]) ? $row[7] : null
                        ));
                    }
                } else {
                    var_dump('NO READABLE', $targetPath2, $targetPath2);
                }
            } else {
                var_dump('dadas', $targetPath2, $targetPath2);
            }

        }
        wp_redirect( $_SERVER['HTTP_REFERER'] . '&status=yes' );
        exit();
    } else  {
        wp_redirect( $_SERVER['HTTP_REFERER'] . '&status=no' );
        die;
    }
}

function insertResult ($data) {
    global $wpdb;

    $table_name = $wpdb->prefix . "prasadi_result_sys_results";

    $wpdb->insert( $table_name, array(
        'symbol_number'    => sanitize_text_field( $data['symbol_number'] ),
        'result'        => sanitize_text_field( $data['result'] ),
        'appointment_date' => sanitize_text_field( $data['appointment_date'] ),
        'appointment_time'  => sanitize_text_field( $data['appointment_time'] ),
        'faculty_id'  => absint( $data['faculty_id'] ),
        'meeting_link' => sanitize_text_field( $data['meeting_link'] ),
        'meeting_id' => sanitize_text_field( $data['meeting_id'] ),
        'password' => sanitize_text_field( $data['password'] ),
    ) );
}

function custom_imported_file_name ($filename) {
    return str_replace(' ', '_', $filename);
}

function prasadi_resolve_time($time) {
//    isset($row[4]) ? $row[4] : null
    if (isset($time)) {
        if ($time === '10:59 am') {
            return '11:00 am';
        }
        return $time;
    }
    return null;
}

//class ExcelReader extends Spreadsheet_Excel_Reader {
//    function GetInArray($sheet=0) {
//        $result = array();
//        for($row=1; $row<=$this->rowcount($sheet); $row++) {
//            for($col=1;$col<=$this->colcount($sheet);$col++) {
//                if(!$this->sheets[$sheet]['cellsInfo'][$row][$col]['dontprint']) {
//                    $val = $this->val($row,$col,$sheet);
//                    $result[$row][$col] = $val;
//                }
//            }
//        }
//        return $result;
//    }
//}