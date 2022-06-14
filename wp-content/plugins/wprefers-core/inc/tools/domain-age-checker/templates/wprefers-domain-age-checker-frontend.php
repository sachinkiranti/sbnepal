<style>
    .wprefers-domain-age-checker-wrapper table {
        font-family: arial, sans-serif;
        border-collapse: collapse;
        width: 100%;
    }
</style>
<div class="wprefers-domain-age-checker-wrapper">
    <div class="wprefers-domain-age-checker-query">
        <textarea rows="5" name="wprefers-domains" placeholder="Enter your domains separated by next line if multiple" required></textarea>
        <small>Max 5 domains only.</small> <br>
        <button id="wprefers-domain-submit">Find Age</button>
        <small class="wprefers-error" style="display: none">Please Enter the URL.<br></small>
        <small>Search by Domain name (e.g. wprefers.com)</small>
    </div>

    <div class="wprefers-domain-age-checker-response">
        <table>
            <tr>
                <th>
                    Domain
                </th>
                <th>
                    Age
                </th>
                <th>
                    Created Date
                </th>
                <th>
                    Last Updated Date
                </th>
                <th>
                    Expiry Date
                </th>
            </tr>
            <tbody class="wprefers-domain-age-wrapper">
            <tr>
                <td colspan="5">
                    Enter the domains.
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</div>