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

let newTokenModal = document.querySelector("#newTokenModal");
let newTokenBtn = document.querySelector("#newTokenBtn");
let newTokenSpan = document.querySelector(".newTokenClose");
newTokenBtn.onclick = function() {
    newTokenModal.style.display = "block";
};
newTokenSpan.onclick = function() {
    newTokenModal.style.display = "none";
};

let tokenRefresh = document.querySelector('#tokenRefresh');
tokenRefresh.onclick = function(e) {
    e.preventDefault();
    // generate new token
}

let deleteModal = document.querySelector('#deleteModal');
let userDeleteBtn = document.querySelector('#userDeleteBtn');
let deleteModalClose = document.querySelector('.deleteModalClose');
userDeleteBtn.onclick = function() {
    deleteModal.style.display = "block";
}
deleteModalClose.onclick = function() {
    deleteModal.style.display = "none";
}
