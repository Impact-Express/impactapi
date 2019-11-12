let newApiUserModal = document.querySelector("#newApiUserModal");
let newApiUserBtn = document.querySelector("#newApiUserBtn");
let newApiUserSpan = document.querySelector(".newApiUserClose");
newApiUserBtn.onclick = function() {
    newApiUserModal.style.display = "block";
};
newApiUserSpan.onclick = function() {
    newApiUserModal.style.display = "none";
};