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

let userNameModal = document.querySelector("#userNameFormModal");
let userNameBtn = document.querySelector("#userNameModalBtn");
let userNameSpan = document.querySelector(".userNameModalClose");
userNameBtn.onclick = function() {
    userNameModal.style.display = "block";
};
userNameSpan.onclick = function() {
    userNameModal.style.display = "none";
};

let accountnumberModal = document.querySelector("#accountnumberFormModal");
let accountnumberBtn = document.querySelector("#accountnumberModalBtn");
let accountnumberSpan = document.querySelector(".accountnumberModalClose");
accountnumberBtn.onclick = function() {
    accountnumberModal.style.display = "block";
};
accountnumberSpan.onclick = function() {
    accountnumberModal.style.display = "none";
};

let tokenModal = document.querySelector("#tokenModal");
let tokenBtn = document.querySelector("#tokenBtn");
let tokenSpan = document.querySelector(".tokenClose");
tokenBtn.onclick = function() {
    tokenModal.style.display = "block";
};
tokenSpan.onclick = function() {
    tokenModal.style.display = "none";
};