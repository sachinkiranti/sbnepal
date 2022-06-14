<style>
    .wprefers-domain-availability-checker-wrapper table {
        font-family: arial, sans-serif;
        border-collapse: collapse;
        width: 100%;
    }

    .wprefers-domain-availability-checker-wrapper .wprefers-error {
        color: red;
    }

    .wprefers-domain-availability-checker-wrapper button.wphg-btn-cp-clipboard {
        float: right;
        cursor: pointer;
    }

    .wprefers-domain-availability-checker-wrapper button.wphg-btn-generate {
        float: right;
        cursor: pointer;
    }

    .wprefers-domain-availability-checker-wrapper td, th {
        border: 1px solid #dddddd;
        text-align: left;
        padding: 8px;
    }
    .wprefers-domain-availability-checker-wrapper .wprefers-domain-availability-checker-query {
        margin-top: 5px;
        margin-bottom: 5px;
    }

    .wprefers-domain-availability-checker-wrapper .wprefers-domain-availability-checker-total-suggestions{
        float: right;
    }

    .wprefers-domain-availability-checker-wrapper .wprefers-referral-link {
        margin-left: 5px;
    }

    .wprefers-domain-availability-checker-wrapper .wprefers-domain-status-registered {
        float: right;
        font-weight: bold;
        color: red;
    }
    .wprefers-domain-availability-checker-wrapper .wprefers-domain-status-available {
        float: right;
        font-weight: bold;
        color: green;
    }
    .wprefers-domain-availability-checker-wrapper input {
        width: 85%;
    }
    .wprefers-domain-availability-checker-wrapper button {
        width: 14%;
    }

    .wprefers-domain-availability-checker-wrapper .wprefers-domain-availability-checker-total-keywords {
        font-weight: bold;
        cursor: pointer;
        float: right;
    }
    .wprefers-domain-availability-checker-wrapper .wprefers-domain-availability-checker-response {
        margin-top: 2px;
    }

    @media only screen and (max-width: 768px) {
        /* For mobile phones: */
        .wprefers-domain-availability-checker-wrapper input {
            width: 100%;
        }
        .wprefers-domain-availability-checker-wrapper button {
            width: 100%;
            margin-top: 2%;
        }
    }

    @media only screen and (min-width: 768px) {
        /* For desktop: */
        .wprefers-domain-availability-checker-wrapper input {
            width: 85%;
        }
        .wprefers-domain-availability-checker-wrapper button {
            width: 14%;
        }
    }
</style>
<div class="wprefers-domain-availability-checker-wrapper">
    <div class="wprefers-domain-availability-checker-query">
        <input type="text" name="wprefers-domain" placeholder="Enter your domain" required>
        <input type="hidden" value="<?php echo $whoiskey; ?>" name="wprefers-whois-key">
        <input type="hidden" value="<?php echo $referralurl; ?>" name="wprefers-referral-url">
        
        <button id="wprefers-search">Search</button>
        <small class="wprefers-error" style="display: none">Please Enter the URL.<br></small>
        <small>Search by Domain name (e.g. google.com)</small>
    </div>

    <div class="wprefers-domain-availability-checker-response">
        <table>
            <tr>
                <th style="width: 70%;">
                    Suggestion

                    <span class="wprefers-domain-availability-checker-total-suggestions" title="Total Suggestions Found">0</span>
                </th>
            </tr>
            <tbody class="wprefers-domain-suggestions">
                <tr>
                    <td>
                        No Suggestions!
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>