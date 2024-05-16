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

//function openMessageModal(message) {
//  var modalContainerMessage = document.getElementById("#modal-container-message");
//  var modalMessage = document.querySelector("#modal-message");
//  modalMessage.innerHTML = message;
//  modalContainerMessage.style.display = "block";
//}
//
//function closeModal() {
//  var modal = document.getElementById("modal-container-message");
//  modal.style.display = "none";
//}
//
//var closeButton = document.querySelectorAll("close-modal");
//closeButton.forEach(function(button) {
//  closeButton.onclick = function() {
//    closeModal();
//  };
//});