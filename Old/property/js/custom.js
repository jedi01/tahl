/* 
 * Author S Brinta<brrinta@gmail.com>
 * Email: brrinta@gmail.com
 * Web: https://brinta.me
 * Do not edit file without permission of author
 * All right reserved by S Brinta<brrinta@gmail.com>
 * Created on : May 13, 2018, 11:21:40 AM
 */
//c32d37fc6f4b779a8c1ae2ee54cd7d7a2b032e464c5bd9771826f54329fda4faca1085f7e7e74c9479269abe88c6858a68c06b65e35dfe2659baa902717b2075O10z9gobYArvkXFINgIf9kNgLT7xSgTTCoORw3VZaAI=

var format = function (num) {
    var str = num.toString().replace("$", ""), parts = false, output = [], i = 1, formatted = null;
    if (str.indexOf(".") > 0) {
        parts = str.split(".");
        str = parts[0];
    }
    str = str.split("").reverse();
    for (var j = 0, len = str.length; j < len; j++) {
        if (str[j] != ",") {
            output.push(str[j]);
            if (i % 3 == 0 && j < (len - 1)) {
                output.push(",");
            }
            i++;
        }
    }
    formatted = output.reverse().join("");
    return(formatted + ((parts) ? "." + parts[1] : ""));
};
 $('.loader').hide();
$('body').on("click", "[modal-toggler='true']", function (e) {
    // console.log(e);
    $('.loader').show();
    var $_modalID = $(this).data("target");
    $($_modalID).load($(this).data('remote') ? $(this).data('remote') : $(this).attr('href'), function (e) {
        setTimeout(function (e) {
            $($_modalID).modal("show");
            $('.loader').hide();
        }, 1500);
    });
});