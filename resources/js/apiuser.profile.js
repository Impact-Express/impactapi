$(document).ready(function() {
    $("#grid").kendoGrid({
        pageable: {
            pageSize: 10,
            numeric: true,
            responsive: false
        },
        sortable: true,
        filterable: true,
        columnMenu: true,
        resizable: true,
    });
});