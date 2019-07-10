String.prototype.replaceAll = function (search, replacement) {
    var target = this;
    return target.split(search).join(replacement);
};

(function (e, u) {
    'use strict';
    //console.log("hello");
    var todayPicker = $(".todayDate").pickadate({
        selectMonths: true,
        selectYears: 100,
        max: true
    });

    if (todayPicker.pickadate('picker')) {
        todayPicker.pickadate('picker').set("select", new Date(Date.now()));
    }
    var birthDatePicker = $(".birthDate").pickadate({
        selectMonths: true,
        selectYears: 100,
        max: true
    });

    if (birthDatePicker.val()) {
        birthDatePicker.pickadate('picker').set("select", new Date(birthDatePicker.val()));
    }
    if ($("form").attr("novalidate") != undefined) {
        $("input,select,textarea").not("[type=submit]").jqBootstrapValidation({
             preventSubmit: true
        });
    }
    $('[data-toggle="tooltip"]').tooltip();
    var popOverSettings = {
        container: 'body',
        html: true,
        selector: '[data-toggle="popover"]'
    };
    $('body').popover(popOverSettings);


    $("select").each(function (elmN) {
        if ($(this).attr("value") !== undefined) {
            $(this).select($(this).attr("value"));
        }
    });


})(window);

window.onclick = function (e) {
    if ($(e.target).hasClass("pop-close")) {
        $(e.target).closest("div.popover").popover("hide");
    }
};

