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

let nameModal = document.querySelector("#nameFormModal");
let nameBtn = document.querySelector("#nameModalBtn");
let nameSpan = document.querySelector(".nameModalClose");
nameBtn.onclick = function() {
    nameModal.style.display = "block";
};
nameSpan.onclick = function() {
    nameModal.style.display = "none";
};