<style>
    .wprefers-ip-address-wrapper table {
        font-family: arial, sans-serif;
        border-collapse: collapse;
        width: 100%;
    }
</style>
<div class="wprefers-ip-address-wrapper">
    <h1>Geolocation Data</h1>

    <div id="wprefers-ip-address-map" data-lat="<?php echo $ipData['latitude']; ?>" data-long="<?php echo $ipData['longitude']; ?>" style="height: 400px; margin-top: 5px; margin-bottom: 10px;"></div>

    <table>
        <?php foreach ($ipData as $key => $value) : ?>
        <tr>
            <td>
                <?php echo ucwords(str_replace( array('_'), ' ', $key )); ?>
            </td>
            <td>
                <?php echo $value; ?>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</div>