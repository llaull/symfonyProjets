function uiNotific(themeN, stickyN, headingN, msg) {
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

    setTimeout(function () {
        $button.removeAttr('disabled');
    }, 1000);
}


// ========================================================================
//	modal - delete dans les tabledata
// ========================================================================

$("a.modal-delete").click(function (e) {
    e.preventDefault();
    var $link = $(this);

    bootbox.confirm({
        title: 'danger - danger - danger',
        message: 'Are you sure you want to delete this. If not, click Cancel. There is no undo!',
        buttons: {
            'cancel': {
                label: 'Cancel',
                className: 'btn-default pull-left'
            },
            'confirm': {
                label: 'Delete',
                className: 'btn-danger pull-right'
            }
        },
        callback: function (result) {
            if (result) {
                document.location.assign($link.attr('data-href'));
            }
        }
    });
});