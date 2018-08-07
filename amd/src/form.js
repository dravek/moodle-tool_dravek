define(['jquery', 'core/str', 'core/notification', 'core/ajax', 'core/templates'], function($, str, notification, ajax, templates) {

    var confirmDeleteRow = function(courseid, id) {
        str.get_strings([
            {'key': 'delete'},
            {'key': 'confirmdelete', component: 'tool_dravek'},
            {'key': 'yes'},
            {'key': 'no'},
        ]).done(function(s) {
                notification.confirm(s[0], s[1], s[2], s[3], function() {
                    //window.location.href = href;
                    var promises = ajax.call([
                        {methodname: 'tool_dravek_delete_entry', args: { id: id}},
                        {methodname: 'tool_dravek_reload_template', args: { courseid: courseid}}
                    ]);
                    promises[1].done(function(response) {
                        templates.render('tool_dravek/mypage',response).done(function(html, js) {
                           $('[data-region="list-page"]').replaceWith(html);
                           templates.runTemplateJS(js);
                        }).fail(function() {
                            // Deal with this exception (I recommend core/notify exception function for this).
                        });
                    }).fail(function() {
                        // do something with the exception
                    });
                });
            }
        ).fail(notification.exception);
    };
     return {
        init: function() {
            $(".confirm_delete").on('click', function(e) {
                //confirmDeleteRow($(this).attr("href"));
                confirmDeleteRow($(this).attr('data-courseid'), $(this).attr('data-id'));
                e.preventDefault();
            });
        }
    };
});