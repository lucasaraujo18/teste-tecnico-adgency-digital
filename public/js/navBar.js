function navBarSettings() {
    if ($('.nav-bar-user-settings').is(':hidden')) {
        $('.nav-bar-user-settings').css('display', 'block');
    } else {
        $('.nav-bar-user-settings').css('display', 'none');
    }
}