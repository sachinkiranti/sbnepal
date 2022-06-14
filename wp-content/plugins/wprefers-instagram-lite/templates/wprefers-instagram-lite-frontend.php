<style>
    .wprefers-instagram-lite-wrapper table {
        font-family: arial, sans-serif;
        border-collapse: collapse;
        width: 100%;
    }

    .wprefers-instagram-lite-wrapper .wprefers-error {
        color: red;
    }

    .wprefers-instagram-lite-wrapper button.wphg-btn-cp-clipboard {
        float: right;
        cursor: pointer;
    }

    .wprefers-instagram-lite-wrapper button.wphg-btn-generate {
        float: right;
        cursor: pointer;
    }


    @media only screen and (max-width: 768px) {
        /* For mobile phones: */
        .wprefers-instagram-lite-wrapper input {
            width: 100%;
        }
        .wprefers-instagram-lite-wrapper select {
            width: 100%;
        }
        .wprefers-instagram-lite-wrapper button {
            width: 100%;
            margin-top: 3%;
        }
    }

    @media only screen and (min-width: 768px) {
        /* For desktop: */
        .wprefers-instagram-lite-wrapper input {
            width: 49%;
        }
        .wprefers-instagram-lite-wrapper select {
            width: 49%;
        }
        .wprefers-instagram-lite-wrapper button {
            width: 14%;
        }
    }
</style>
<div class="wprefers-instagram-lite-wrapper">
    <div class="wprefers-instagram-lite-query">
        <input type="text" name="wprefers-username" placeholder="Enter the instagram username" required>
        <select name="wprefers-query" id="wprefers-query">
            <option value="dp">Display Picture</option>
            <option value="id">ID</option>
        </select>
        
        <button id="wprefers-search" style="margin-top: 5px;">Search</button>
        <small class="wprefers-error wprefers-username-error" style="display: none">Please Enter the Instagram Username.<br></small>
        <small class="wprefers-error wprefers-query-error" style="display: none">Please Select the Query Type.<br></small>
        <small>Search by Domain name (e.g. wprefers)</small>
    </div>

    <div class="wprefers-instagram-lite-response">

    </div>
</div>