$(document).ready(function () {
    //Summernote for text are
    $('.summernote').summernote({
        tabsize: 4,
        height: 200
    });


    //Select to multiple select
    $('.select2').select2({});

    // Base Image Preview
    var loadFile = function (event) {
        var reader = new FileReader();
        reader.onload = function () {
            var output = document.getElementById('output');
            output.src = reader.result;
        };
        reader.readAsDataURL(event.target.files[0]);
    };

    // Daterangepicker
    $('.datepicker').daterangepicker({
        singleDatePicker: true,
        showDropdowns: true,
        autoUpdateInput: false
    }, function (chosen_date) {
        this.element.val(chosen_date.format('MM-DD-YYYY'));
    });

    // Notification Auto hide
    setTimeout(function () {
        $('.close').parents("p").remove();
    }, 2000);
});


document.addEventListener("DOMContentLoaded", function (event) {
    // Datatables with Buttons
    var datatablesButtons = $('#datatables-buttons').DataTable({
        lengthChange: !1,
        buttons: ["copy", "print"],
    });
    datatablesButtons.buttons().container().appendTo("#datatables-buttons_wrapper .col-md-6:eq(0)")
});
document.addEventListener("DOMContentLoaded", function (event) {
    // Datatables with Buttons
    var datatablesButtons = $('#datatables').DataTable({
        lengthChange: !1,
        buttons: ["copy", "print"],
    });
    datatablesButtons.buttons().container().appendTo("#datatables-buttons_wrapper .col-md-6:eq(0)")
});
document.addEventListener("DOMContentLoaded", function (event) {
    // Datatables with Buttons
    var datatablesButtons = $('.datatables-buttons').DataTable({
        lengthChange: !1,
        buttons: ["copy", "print"],
    });
    datatablesButtons.buttons().container().appendTo("#datatables-buttons_wrapper .col-md-6:eq(0)")
});

$(document).ready(function () {
    window.onbeforeunload = function () {
        $('.section-prograss').css('display', 'block');
    };
});
