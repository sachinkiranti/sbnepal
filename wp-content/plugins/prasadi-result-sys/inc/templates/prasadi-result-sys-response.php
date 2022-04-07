<style></style>

<?php if (!is_null($result) && !is_null($facultyRow)) : ?>

    <div class="prasadi-result-sys-response-wrapper">

        <?php if (strtolower($result->result) === 'failed') : ?>
            <br>
            <?php echo $facultyRow->response_message_failed; ?>
        <?php else : ?>

            <?php
                if (strtolower($result->result) === 'passed') {
                    $message = $facultyRow->response_message_passed;
                } else {
                    $message = $facultyRow->response_message_scholarship;
                }
                $message = str_replace(
                        ['{%APPOINTMENT_INFO%}', '{% APPOINTMENT_INFO %}', '{% appointment_info %}', '{%appointment_info%}'],
                    prasadi_resolve_appointment_data($result) .'<br>', $message);
            ?>

            <?php echo $message; ?>

        <?php endif; ?>
    </div>

<?php else : ?>
    <br>
    <?php echo $facultyRow->response_message_unidentified; ?>
<?php endif; ?>

