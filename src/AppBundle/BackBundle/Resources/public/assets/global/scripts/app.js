function uiNotific(themeN,stickyN, headingN, msg) {
    var settings = {
            theme: themeN,
            sticky: stickyN,
            horizontalEdge: 'top',
            verticalEdge: 'right'
        },
        $button = $(this);

    settings.heading = $.trim(headingN);

    if (!settings.sticky) {
        settings.life = 3000;
    }

    $.notific8('zindex', 11500);
    $.notific8($.trim(msg), settings);

    $button.attr('disabled', 'disabled');

    setTimeout(function() {
        $button.removeAttr('disabled');
    }, 1000);
}