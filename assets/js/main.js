$(document).ready(function () {
    var ENUM_STATUS = {
        STATUS_CONTINUES    : 1,
        STATUS_FINISHED     : 2
    };

    $("#ajax-select-project_id").on("change", function () {
        var
            btn = $(this),
            item = {
                'value'         : btn.val()
            },
            handler = {
                init: function () {
                    $.pjax.reload({container:'#todoList', data: {'project_id' : item.value}});
                }
            };

        handler.init();
    })
});