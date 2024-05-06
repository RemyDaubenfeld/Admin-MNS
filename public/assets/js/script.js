// Edit mail
const modalContainerMail = document.querySelector('.modal-container-mail');
const modalTriggerMail = document.querySelectorAll('.modal-trigger-mail');

modalTriggerMail.forEach(trigger => trigger.addEventListener('click', toggleModalMail));

function toggleModalMail() {
  modalContainerMail.classList.toggle('active');
}

// Edit phone
const modalContainerPhone = document.querySelector('.modal-container-phone');
const modalTriggerPhone = document.querySelectorAll('.modal-trigger-phone');

modalTriggerPhone.forEach(trigger => trigger.addEventListener('click', toggleModalPhone));

function toggleModalPhone() {
  modalContainerPhone.classList.toggle('active');
}

// Edit location
const modalContainerLocation = document.querySelector('.modal-container-location');
const modalTriggerLocation = document.querySelectorAll('.modal-trigger-location');

modalTriggerLocation.forEach(trigger => trigger.addEventListener('click', toggleModalLocation));

function toggleModalLocation() {
  modalContainerLocation.classList.toggle('active');
}

// Edit password
const modalContainerPassword = document.querySelector('.modal-container-password');
const modalTriggerPassword = document.querySelectorAll('.modal-trigger-password');

modalTriggerPassword.forEach(trigger => trigger.addEventListener('click', toggleModalPassword));

function toggleModalPassword() {
  modalContainerPassword.classList.toggle('active');
}

// Edit profil picture
const editProfilePicture = document.querySelector('#edit-profil-picture');
const submitForm = document.querySelector('#edit-picture-submit');
const fileInput = document.querySelector('#file-input');

editProfilePicture.addEventListener('click', () => {
  console.trace('Click event triggered');
  fileInput.click();
});

document.querySelector('#file-input').addEventListener('change', function() {
    console.trace('Change event triggered');
    const form = document.querySelector('#edit-picture-submit');
    form.click();
});

// Modal Message

function openMessageModal(message) {
  var modalContainerMessage = document.getElementById("#modal-container-message");
  var modalMessage = document.querySelector("#modal-message");
  modalMessage.innerHTML = message;
  modalContainerMessage.style.display = "block";
}

function closeModal() {
  var modal = document.getElementById("modal-container-message");
  modal.style.display = "none";
}

var closeButton = document.querySelectorAll("close-modal");
closeButton.forEach(function(button) {
  closeButton.onclick = function() {
    closeModal();
  };
});