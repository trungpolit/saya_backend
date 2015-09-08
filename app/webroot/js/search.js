$(function () {
        $('.input-daterangem, .datepicker.showDate').datetimepicker({
                'format': 'DD-MM-YYYY',
                'showTodayButton': true
        });
        $('.datepicker').datetimepicker({
                'format': 'DD-MM-YYYY HH:mm:ss',
                'showTodayButton': true
        });
});