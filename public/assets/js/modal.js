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

// ADD USER
document.addEventListener('DOMContentLoaded', () => {
  const modalContainerAddUser = document.querySelector('.modal-container-add-user');
  const modalTriggersAddUser = document.querySelectorAll('.modal-trigger-add-user');
  
  modalTriggersAddUser.forEach(trigger => trigger.addEventListener('click', toggleModalAddUser));

  function toggleModalAddUser() {
    modalContainerAddUser.classList.toggle('active');
  }
});

// EDIT MAIL
const modalContainerMail = document.querySelector('.modal-container-mail');
const modalTriggerMail = document.querySelectorAll('.modal-trigger-mail');

modalTriggerMail.forEach(trigger => trigger.addEventListener('click', toggleModalMail));

function toggleModalMail() {
  modalContainerMail.classList.toggle('active');
}

// EDIT PHONE
const modalContainerPhone = document.querySelector('.modal-container-phone');
const modalTriggerPhone = document.querySelectorAll('.modal-trigger-phone');

modalTriggerPhone.forEach(trigger => trigger.addEventListener('click', toggleModalPhone));

function toggleModalPhone() {
  modalContainerPhone.classList.toggle('active');
}

// EDIT LOCATION
const modalContainerLocation = document.querySelector('.modal-container-location');
const modalTriggerLocation = document.querySelectorAll('.modal-trigger-location');

modalTriggerLocation.forEach(trigger => trigger.addEventListener('click', toggleModalLocation));

function toggleModalLocation() {
  modalContainerLocation.classList.toggle('active');
}

// EDIT PASSWORD
const modalContainerPassword = document.querySelector('.modal-container-password');
const modalTriggerPassword = document.querySelectorAll('.modal-trigger-password');

modalTriggerPassword.forEach(trigger => trigger.addEventListener('click', toggleModalPassword));

function toggleModalPassword() {
  modalContainerPassword.classList.toggle('active');
}