var map = jQuery('#wprefers-ip-address-map')
var latitude = 27.8022; // YOUR LATITUDE VALUE
var longitude = 82.8713; // YOUR LONGITUDE VALUE

var map = L.map('wprefers-ip-address-map').setView([latitude, longitude], 15);

L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
}).addTo(map);

L.marker([latitude, longitude]).addTo(map)
    .bindPopup('[ latitude : ' + latitude + ', longitude : ' + longitude + ' ]')
    .openPopup();