function startLoading() {
    $('body').prepend('<div id="loadoverlay"><div class="loadspinner"></div></div>');
}
function stopLoading() {
    $('#loadoverlay').remove();
}