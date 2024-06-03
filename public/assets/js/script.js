// Edit profil picture
document.addEventListener("DOMContentLoaded", () => {
  const editProfilePicture = document.querySelector("#EditProfilPicture");
  const submitForm = document.querySelector("#EditPictureSubmit");
  const fileInput = document.querySelector("#FileInput");

  editProfilePicture.addEventListener("click", () => {
    fileInput.click();
  });

  fileInput.addEventListener("change", function () {
    submitForm.click();
  });
});

// ADD USER
document.addEventListener("DOMContentLoaded", () => {
  const modalContainerAddUser = document.querySelector(
    ".modal-container-add-user"
  );
  const modalTriggersAddUser = document.querySelectorAll(
    ".modal-trigger-add-user"
  );

  modalTriggersAddUser.forEach((trigger) =>
    trigger.addEventListener("click", toggleModalAddUser)
  );

  function toggleModalAddUser() {
    modalContainerAddUser.classList.toggle("active");
  }
});

// EDIT MAIL
const modalContainerMail = document.querySelector(".modal-container-mail");
const modalTriggerMail = document.querySelectorAll(".modal-trigger-mail");

modalTriggerMail.forEach((trigger) =>
  trigger.addEventListener("click", toggleModalMail)
);

function toggleModalMail() {
  modalContainerMail.classList.toggle("active");
}

// EDIT PHONE
const modalContainerPhone = document.querySelector(".modal-container-phone");
const modalTriggerPhone = document.querySelectorAll(".modal-trigger-phone");

modalTriggerPhone.forEach((trigger) =>
  trigger.addEventListener("click", toggleModalPhone)
);

function toggleModalPhone() {
  modalContainerPhone.classList.toggle("active");
}

// EDIT LOCATION
const modalContainerLocation = document.querySelector(
  ".modal-container-location"
);
const modalTriggerLocation = document.querySelectorAll(
  ".modal-trigger-location"
);

modalTriggerLocation.forEach((trigger) =>
  trigger.addEventListener("click", toggleModalLocation)
);

function toggleModalLocation() {
  modalContainerLocation.classList.toggle("active");
}

// EDIT PASSWORD
const modalContainerPassword = document.querySelector(
  ".modal-container-password"
);
const modalTriggerPassword = document.querySelectorAll(
  ".modal-trigger-password"
);

modalTriggerPassword.forEach((trigger) =>
  trigger.addEventListener("click", toggleModalPassword)
);

function toggleModalPassword() {
  modalContainerPassword.classList.toggle("active");
}

// EDIT GENDER
const modalContainerGender = document.querySelector(".modal-container-gender");
const modalTriggerGender = document.querySelectorAll(".modal-trigger-gender");

modalTriggerGender.forEach((trigger) =>
  trigger.addEventListener("click", toggleModalGender)
);

function toggleModalGender() {
  modalContainerGender.classList.toggle("active");
}

// EDIT NAME
const modalContainerName = document.querySelector(".modal-container-name");
const modalTriggerName = document.querySelectorAll(".modal-trigger-name");

modalTriggerName.forEach((trigger) =>
  trigger.addEventListener("click", toggleModalName)
);

function toggleModalName() {
  modalContainerName.classList.toggle("active");
}

//EDIT STATUS
const modalContainerStatus = document.querySelector(".modal-container-status");
const modalTriggerStatus = document.querySelectorAll(".modal-trigger-status");

modalTriggerStatus.forEach((trigger) =>
  trigger.addEventListener("click", toggleModalStatus)
);

function toggleModalStatus() {
  modalContainerStatus.classList.toggle("active");
}

// ARCHIVAGE

const modalContainerArchive = document.querySelector(".modal-container-archive");
const modalTriggerArchive = document.querySelectorAll(".modal-trigger-archive");

modalTriggerArchive.forEach((trigger) =>
  trigger.addEventListener("click", toggleModalArchive)
);

function toggleModalArchive() {
  modalContainerArchive.classList.toggle("active");
}
