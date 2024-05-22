function messageModal(type, message) {
    let modalContainerMessage = document.getElementById("modal-message");
    let modalTitle = modalContainerMessage.querySelector("#modal-title")
    let modalMessage = modalContainerMessage.querySelector("#message");

    // On défini le titre et le message
    modalTitle.innerHTML = type.charAt(0).toUpperCase() + type.slice(1);;
    modalMessage.innerHTML = message;

    // On supprime les classes de type précécent
    modalContainerMessage.className = '#modal-message';

    // On ajoute la classe selon le type de modal
    modalContainerMessage.classList.add(type);
    modalContainerMessage.classList.toggle('active');


    let closeButton = document.querySelectorAll(".close-modal");
    closeButton.forEach(function(button) {
        button.onclick = function() {
          modalContainerMessage.classList.toggle('active');
        };
    });

    setTimeout(function() {
      modalContainerMessage.classList.toggle('active');
    }, 10000);
}