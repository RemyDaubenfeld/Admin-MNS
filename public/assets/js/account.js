import { ajaxFetch } from "./libs/utils.js";
import { createUpdateModal } from "./libs/modal-update.js";

const userId = new URLSearchParams(window.location.search).get("user-id");
const user = await ajaxFetch("user-infos", userId);

await createUpdateModal(user, "mailEdit", "Modifier l'email", "form", ["mail"]);

await createUpdateModal(
  user,
  "phoneEdit",
  "Modifier le numéro de téléphone",
  "form",
  ["phone"]
);

await createUpdateModal(user, "addressEdit", "Modifier l'adresse", "form", [
  "address",
]);

await createUpdateModal(
  user,
  "passwordEdit",
  "Modifier le mot de passe",
  "form",
  ["oldPassword", "newPassword", "confirmPassword"]
);

await createUpdateModal(user, "genderEdit", "Modifier le genre", "form", [
  "gender",
]);

await createUpdateModal(user, "nameEdit", "Modifier le nom", "form", [
  "firstname",
  "lastname",
]);

await createUpdateModal(user, "statusEdit", "Modifier le statut", "form", [
  "status",
]);

await createUpdateModal(
  user,
  "archiveUserButton",
  "Supprimer cet utilisateur ?",
  "confirmation",
  ["back", "archive"]
);

await createUpdateModal(
  user,
  "disconnectionButton",
  "Se déconnecter ?",
  "confirmation",
  ["back", "confirm"]
);

const editProfilePicture = document.querySelector("#editProfilPicture");
const submitForm = document.querySelector("#editPictureSubmit");
const fileInput = document.querySelector("#fileInput");

editProfilePicture.addEventListener("click", () => {
  fileInput.click();
});

fileInput.addEventListener("change", function () {
  submitForm.click();
});
