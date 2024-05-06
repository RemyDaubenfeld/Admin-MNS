
function openMessageModal(message) {
    var modalContainerMessage = document.getElementById("modal-container-message");
    var modalMessage = modalContainerMessage.querySelector("#modal-message");
    modalMessage.innerHTML = message;
    modalContainerMessage.classList.toggle('active');

    var closeButton = document.querySelectorAll(".close-modal");
    closeButton.forEach(function(button) {
        button.onclick = function() {
            closeModal();
        };
    });
}