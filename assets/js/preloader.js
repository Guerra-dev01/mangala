
$(document).ready(function() {
//Preloader
preloaderFadeOutTime = 2000;
function hidePreloader() {
var preloader = $('.spinner-wrapper');
preloader.fadeOut(preloaderFadeOutTime);
}
hidePreloader();
});
