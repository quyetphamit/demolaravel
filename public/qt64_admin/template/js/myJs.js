$(document).ready(function () {
    $('.result_msg,.error_msg').delay(3000).slideUp();
});
function deleteConfirm(msg) {
    if (window.confirm(msg)) {
        return true;
    }
    return false;
}