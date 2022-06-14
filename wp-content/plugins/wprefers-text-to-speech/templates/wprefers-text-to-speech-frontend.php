<?php if ( is_user_logged_in() ) { ?>
<div class="wprefers-text-to-speech">
    <input type="hidden" value="<?php echo $element; ?>" name="wprefers-wtts-element">
    <div class="d-flex mt-4 text-light">
        <div>
            <p class="lead">Volume</p>
            <input type="range" min="0" max="1" value="1" step="0.1" id="wprefers-volume" />
            <span id="wprefers-volume-label" class="ms-2">1</span>
        </div>
        <div class="mx-5">
            <p class="lead">Rate</p>
            <input type="range" min="0.1" max="10" value="1" id="wprefers-rate" step="0.1" />
            <span id="wprefers-rate-label" class="ms-2">1</span>
        </div>
        <div>
            <p class="lead">Pitch</p>
            <input type="range" min="0" max="2" value="1" step="0.1" id="wprefers-pitch" />
            <span id="wprefers-pitch-label" class="ms-2">1</span>
        </div>

    </div>

    <div class="d-flex mt-4">
        <button id="wprefers-start">Start</button>
        <button id="wprefers-pause">Pause</button>
        <button id="wprefers-resume">Resume</button>
        <button id="wprefers-cancel">Cancel</button>
    </div>
</div>
<?php } ?>