define(['jquery', 'core/str', 'core/notification'], function($, str, notification) {

    var confirmDeleteRow = function(href) {
        str.get_strings([
            {'key': 'delete'},
            {'key': 'confirmdelete', component: 'tool_dravek'},
            {'key': 'yes'},
            {'key': 'no'},
        ]).done(function(s) {
                notification.confirm(s[0], s[1], s[2], s[3], function() {
                    window.location.href = href;
                });
            }
        ).fail(notification.exception);
    };
     return {
        init: function() {
            $(".confirm_delete").on('click', function(e) {
                confirmDeleteRow($(this).attr("href"));
                e.preventDefault();
            });
        }
    };
});