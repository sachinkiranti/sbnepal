(function ($) {
    let speech = new SpeechSynthesisUtterance();
    speech.lang = "en";

    // let voices = [];
    // window.speechSynthesis.onvoiceschanged = function () {
    //     voices = window.speechSynthesis.getVoices();
    //     speech.voice = voices[0];
    //     let voiceSelect = document.querySelector("#voices");
    //     voices.forEach((voice, i) => (voiceSelect.options[i] = new Option(voice.name, i)));
    // };

    document.querySelector("#wprefers-rate").addEventListener("input", function () {
        const rate = document.querySelector("#wprefers-rate").value;
        speech.rate = rate;
        document.querySelector("#wprefers-rate-label").innerHTML = rate;
    });

    document.querySelector("#wprefers-volume").addEventListener("input", function () {
        const volume = document.querySelector("#wprefers-volume").value;
        speech.volume = volume;
        document.querySelector("#wprefers-volume-label").innerHTML = volume;
    });

    document.querySelector("#wprefers-pitch").addEventListener("input", function () {
        const pitch = document.querySelector("#wprefers-pitch").value;
        speech.pitch = pitch;
        document.querySelector("#wprefers-pitch-label").innerHTML = pitch;
    });

    // document.querySelector("#voices").addEventListener("change", function () {
    //     speech.voice = voices[document.querySelector("#voices").value];
    // });

    document.querySelector("#wprefers-start").addEventListener("click", function () {
        speech.text = document.getElementsByClassName(document.querySelector("[name=wprefers-wtts-element]").value).value;
        window.speechSynthesis.speak(speech);
    });

    document.querySelector("#wprefers-pause").addEventListener("click", function () {
        window.speechSynthesis.pause();
    });

    document.querySelector("#wprefers-resume").addEventListener("click", function () {
        window.speechSynthesis.resume();
    });

    document.querySelector("#wprefers-cancel").addEventListener("click", function () {
        window.speechSynthesis.cancel();
    });
})(jQuery)