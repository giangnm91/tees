$(document).ready(function(){
    $('#btn_add_new').livequery('click',function(){        
        window.open("article/add", '_blank');
    });

    $('#article_table').DataTable({
        "destroy": true,
        "order": [[ 4, 'asc' ]],
        processing: true,
        serverSide: true,
        ajax: 'article',
        columns: [
            { data: 'checkbox', name: 'select', orderable: false},
            { data: 'vn.name', name: 'name' },
            { data: 'vn.category', name: 'category' },
            { data: 'vn.excerpt', name: 'excerpt' },
            { data: 'created_time', name: 'created_time' },
            { data: 'modified_time', name: 'modified_time' },
            { data: 'author', name: 'author' },
            { data: 'action', name: 'action', orderable: false}
        ]
    });

    function convertDateRangePickerToTimeStamp(dateObject) {
        return new Date(dateObject).getTime() / 1000;
    }

    $('#filter-created-range').daterangepicker({
        "ranges": {
            'Today': [moment(), moment()],
            'Yesterday': [moment().subtract('days', 1), moment().subtract('days', 1)],
            'Last 7 Days': [moment().subtract('days', 6), moment()],
            'Last 30 Days': [moment().subtract('days', 29), moment()],
            'This Month': [moment().startOf('month'), moment().endOf('month')],
            'Last Month': [moment().subtract('month', 1).startOf('month'), moment().subtract('month', 1).endOf('month')]
        },
        "locale": {
            "format": "MM/DD/YYYY",
            "separator": " - ",
            "applyLabel": "Apply",
            "cancelLabel": "Cancel",
            "fromLabel": "From",
            "toLabel": "To",
            "customRangeLabel": "Custom",
            "daysOfWeek": [
                "Su",
                "Mo",
                "Tu",
                "We",
                "Th",
                "Fr",
                "Sa"
            ],
            "monthNames": [
                "Tháng Một",
                "Tháng Hai",
                "Tháng Ba",
                "Tháng Tư",
                "Tháng Năm",
                "Tháng Sáu",
                "Tháng Bảy",
                "Tháng Tám",
                "Tháng Chín",
                "Tháng Mười",
                "Tháng Mười Một",
                "Tháng Mười Hai"
            ],
            "firstDay": 1
        },
        opens: (App.isRTL() ? 'right' : 'left'),
    }, function(start, end, label) {
        //alert(convertDateRangePickerToTimeStamp(start.format('MMMM D, YYYY')));        
        $('#filter-created-range span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
        $('#article_table').DataTable({
            "destroy": true,
            processing: true,
            "order": [[ 4, 'asc' ]],
            serverSide: true,
            "ajax": {
                "url": "article",
                "data": function ( d ) {
                    d.startDate = convertDateRangePickerToTimeStamp(start.format('MMMM D, YYYY')),
                    d.endDate = convertDateRangePickerToTimeStamp(end.format('MMMM D, YYYY'))
                }
            },
            columns: [
                { data: 'checkbox', name: 'select', orderable: false},
                { data: 'vn.name', name: 'name' },
                { data: 'vn.category', name: 'category' },
                { data: 'vn.excerpt', name: 'excerpt' },
                { data: 'created_time', name: 'created_time' },
                { data: 'modified_time', name: 'modified_time' },
                { data: 'author', name: 'author' },
                { data: 'action', name: 'action', orderable: false}
            ]
        });
    });

    $('#filter-created-range span').html(moment().subtract('days', 29).format('MMMM D, YYYY') + ' - ' + moment().format('MMMM D, YYYY'));
    $('#filter-created-range').show();
});