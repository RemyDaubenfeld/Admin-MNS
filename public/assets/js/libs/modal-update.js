import { ajaxFetch } from "./utils.js";
import {
  passwordVisibilityToggle,
  passwordCheckStrength,
  formCheck,
} from "./fields.js";

export async function createUpdateModal(
  user,
  buttonId,
  title,
  modalType,
  elements = null
) {
  const button = document.querySelector(`#${buttonId}`);

  if (!button) {
    return;
  }

  button.addEventListener("click", async function () {
    document.body.classList.add("no-scrollbar");

    const modalUpdateContainer = document.createElement("div");
    modalUpdateContainer.className = "modal-update-container";

    const modalUpdateContent = document.createElement("div");
    modalUpdateContent.className = "modal-update-content";
    modalUpdateContainer.appendChild(modalUpdateContent);

    const modalUpdateHeader = document.createElement("div");
    modalUpdateHeader.className = "modal-update-header";
    modalUpdateContent.appendChild(modalUpdateHeader);

    const modalUpdateTitle = document.createElement("h3");
    modalUpdateTitle.className = "modal-update-title";
    modalUpdateTitle.innerText = title;
    modalUpdateHeader.appendChild(modalUpdateTitle);

    const modalUpdateClose = document.createElementNS(
      "http://www.w3.org/2000/svg",
      "svg"
    );
    modalUpdateClose.setAttribute("xmlns", "http://www.w3.org/2000/svg");
    modalUpdateClose.setAttribute("viewBox", "0 0 512 512");
    modalUpdateClose.classList.add("modal-update-close");
    modalUpdateClose.addEventListener("click", function (e) {
      modalUpdateContainer.remove();
      document.body.classList.remove("no-scrollbar");
    });
    modalUpdateHeader.appendChild(modalUpdateClose);

    const modalUpdateClosePath = document.createElementNS(
      "http://www.w3.org/2000/svg",
      "path"
    );
    modalUpdateClosePath.setAttribute(
      "d",
      "M342.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L192 210.7 86.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L146.7 256 41.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L192 301.3 297.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L237.3 256 342.6 150.6z"
    );
    modalUpdateClose.appendChild(modalUpdateClosePath);

    const modalUpdateBody = document.createElement("div");
    modalUpdateBody.className = "modal-update-body";
    modalUpdateContent.appendChild(modalUpdateBody);

    modalUpdateContainer.addEventListener("mousedown", function (e) {
      if (e.target === modalUpdateContainer) {
        modalUpdateContainer.remove();
        document.body.classList.remove("no-scrollbar");
      }
    });

    switch (modalType) {
      case "form":
        const modalUpdateForm = document.createElement("form");
        modalUpdateForm.id = `${buttonId}Form`;
        modalUpdateForm.method = "POST";
        modalUpdateBody.appendChild(modalUpdateForm);

        elements.forEach((element) => {
          createUpdateElement(user, modalUpdateForm, element);
        });

        const hiddenSubmit = document.createElement("input");
        hiddenSubmit.setAttribute("type", "hidden");
        hiddenSubmit.setAttribute("name", `${buttonId}_hidden_submit`);
        hiddenSubmit.setAttribute("required", "required");
        modalUpdateForm.appendChild(hiddenSubmit);

        const modalUpdateSubmit = document.createElement("button");
        modalUpdateSubmit.id = `${buttonId}FormSubmit`;
        modalUpdateSubmit.name = `${buttonId}_submit`;
        modalUpdateSubmit.className = "button button-primary";
        modalUpdateForm.appendChild(modalUpdateSubmit);

        const modalUpdateSubmitIcon = document.createElementNS(
          "http://www.w3.org/2000/svg",
          "svg"
        );
        modalUpdateSubmitIcon.setAttribute(
          "xmlns",
          "http://www.w3.org/2000/svg"
        );
        modalUpdateSubmitIcon.setAttribute("viewBox", "0 0 448 512");
        modalUpdateSubmit.appendChild(modalUpdateSubmitIcon);

        const modalUpdateSubmitIconPath = document.createElementNS(
          "http://www.w3.org/2000/svg",
          "path"
        );
        modalUpdateSubmitIconPath.setAttribute(
          "d",
          "M64 32C28.7 32 0 60.7 0 96V416c0 35.3 28.7 64 64 64H384c35.3 0 64-28.7 64-64V96c0-35.3-28.7-64-64-64H64zM337 209L209 337c-9.4 9.4-24.6 9.4-33.9 0l-64-64c-9.4-9.4-9.4-24.6 0-33.9s24.6-9.4 33.9 0l47 47L303 175c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9z"
        );
        modalUpdateSubmitIcon.appendChild(modalUpdateSubmitIconPath);
        modalUpdateSubmit.innerHTML += "Valider";

        document.body.appendChild(modalUpdateContainer);

        const fields = [];
        elements.forEach((element) => {
          switch (element) {
            case "oldPassword":
              fields.push({ type: "password", id: "oldPasswordInput" });
              break;
            case "newPassword":
              fields.push({ type: "password", id: "newPasswordInput" });
              break;
            case "confirmPassword":
              fields.push({
                type: "confirmPassword",
                id: "confirmPasswordInput",
                validate: "newPasswordInput",
              });
              break;
            case "firstname":
              fields.push({
                type: "text",
                sort: "name",
                id: "firstnameInput",
                minLen: 1,
                maxLen: 50,
                required: true,
              });
              break;
            case "lastname":
              fields.push({
                type: "text",
                sort: "name",
                id: "lastnameInput",
                minLen: 1,
                maxLen: 50,
                required: true,
              });
              break;
            case "phone":
              fields.push({
                type: "text",
                sort: "phone",
                id: "phoneInput",
                minLen: 9,
                maxLen: 17,
                required: false,
              });
              break;
            case "mail":
              fields.push({
                type: "mail",
                id: "mailInput",
                currentMail: user ? user.user_mail : "",
              });
              break;
            case "address":
              fields.push({
                type: "address",
                id: "addressInput",
              });
              break;
          }
        });

        await formCheck(`${buttonId}Form`, fields);
        break;
      case "confirmation":
        const confirmationBox = document.createElement("div");
        confirmationBox.className = "modal-update-confirmation";
        modalUpdateBody.appendChild(confirmationBox);

        elements.forEach((element) => {
          switch (element) {
            case "back":
              const backButton = document.createElement("button");
              backButton.className = "button button-gray";

              const backButtonIcon = document.createElementNS(
                "http://www.w3.org/2000/svg",
                "svg"
              );
              backButtonIcon.setAttribute(
                "xmlns",
                "http://www.w3.org/2000/svg"
              );
              backButtonIcon.setAttribute("viewBox", "0 0 448 512");
              backButton.appendChild(backButtonIcon);

              const backButtonIconPath = document.createElementNS(
                "http://www.w3.org/2000/svg",
                "path"
              );
              backButtonIconPath.setAttribute(
                "d",
                "M9.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l160 160c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L109.2 288 416 288c17.7 0 32-14.3 32-32s-14.3-32-32-32l-306.7 0L214.6 118.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-160 160z"
              );
              backButtonIcon.appendChild(backButtonIconPath);
              backButton.innerHTML += "Annuler";

              confirmationBox.appendChild(backButton);

              backButton.addEventListener("click", function (e) {
                modalUpdateContainer.remove();
                document.body.classList.remove("no-scrollbar");
              });
              break;
            case "archive":
              const archiveButton = document.createElement("button");
              archiveButton.className = "button button-red";

              const archiveButtonIcon = document.createElementNS(
                "http://www.w3.org/2000/svg",
                "svg"
              );
              archiveButtonIcon.setAttribute(
                "xmlns",
                "http://www.w3.org/2000/svg"
              );
              archiveButtonIcon.setAttribute("viewBox", "0 0 448 512");
              archiveButton.appendChild(archiveButtonIcon);

              const archiveButtonIconPath = document.createElementNS(
                "http://www.w3.org/2000/svg",
                "path"
              );
              archiveButtonIconPath.setAttribute(
                "d",
                "M135.2 17.7L128 32H32C14.3 32 0 46.3 0 64S14.3 96 32 96H416c17.7 0 32-14.3 32-32s-14.3-32-32-32H320l-7.2-14.3C307.4 6.8 296.3 0 284.2 0H163.8c-12.1 0-23.2 6.8-28.6 17.7zM416 128H32L53.2 467c1.6 25.3 22.6 45 47.9 45H346.9c25.3 0 46.3-19.7 47.9-45L416 128z"
              );
              archiveButtonIcon.appendChild(archiveButtonIconPath);
              archiveButton.innerHTML += "Supprimer";

              confirmationBox.appendChild(archiveButton);

              archiveButton.addEventListener("click", function (e) {
                window.location.href = `/?script=archive-user&value=${user.user_id}`;
              });
              break;
            case "confirm":
              const confirmButton = document.createElement("button");
              confirmButton.className = "button button-primary";

              const confirmButtonIcon = document.createElementNS(
                "http://www.w3.org/2000/svg",
                "svg"
              );
              confirmButtonIcon.setAttribute(
                "xmlns",
                "http://www.w3.org/2000/svg"
              );
              confirmButtonIcon.setAttribute("viewBox", "0 0 448 512");
              confirmButton.appendChild(confirmButtonIcon);

              const confirmButtonIconPath = document.createElementNS(
                "http://www.w3.org/2000/svg",
                "path"
              );
              confirmButtonIconPath.setAttribute(
                "d",
                "M64 32C28.7 32 0 60.7 0 96V416c0 35.3 28.7 64 64 64H384c35.3 0 64-28.7 64-64V96c0-35.3-28.7-64-64-64H64zM337 209L209 337c-9.4 9.4-24.6 9.4-33.9 0l-64-64c-9.4-9.4-9.4-24.6 0-33.9s24.6-9.4 33.9 0l47 47L303 175c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9z"
              );
              confirmButtonIcon.appendChild(confirmButtonIconPath);
              confirmButton.innerHTML += "Confirmer";

              confirmationBox.appendChild(confirmButton);

              confirmButton.addEventListener("click", function (e) {
                window.location.href = `/?script=disconnection&value=${user.user_id}`;
              });
              break;
            default:
              console.error("Erreur");
              return;
          }
        });
        document.body.appendChild(modalUpdateContainer);
        break;
      default:
        console.error("Erreur");
        return;
    }
  });
}

async function createUpdateElement(user, modalUpdateForm, element) {
  let iconViewBox = "";
  let iconPath = "";
  let labelText = "";
  let type = "";
  let placeholder = "";
  let value = "";
  let minLen = "";
  let maxLen = "";
  let required = false;
  switch (element) {
    case "mail":
      iconViewBox = "0 0 512 512";
      iconPath =
        "M48 64C21.5 64 0 85.5 0 112c0 15.1 7.1 29.3 19.2 38.4L236.8 313.6c11.4 8.5 27 8.5 38.4 0L492.8 150.4c12.1-9.1 19.2-23.3 19.2-38.4c0-26.5-21.5-48-48-48H48zM0 176V384c0 35.3 28.7 64 64 64H448c35.3 0 64-28.7 64-64V176L294.4 339.2c-22.8 17.1-54 17.1-76.8 0L0 176z";
      labelText = "Adresse Mail";
      type = "email";
      placeholder = "Entrez votre mail";
      value = user ? user.user_mail : "";
      required = true;
      break;
    case "phone":
      iconViewBox = "0 0 512 512";
      iconPath =
        "M164.9 24.6c-7.7-18.6-28-28.5-47.4-23.2l-88 24C12.1 30.2 0 46 0 64C0 311.4 200.6 512 448 512c18 0 33.8-12.1 38.6-29.5l24-88c5.3-19.4-4.6-39.7-23.2-47.4l-96-40c-16.3-6.8-35.2-2.1-46.3 11.6L304.7 368C234.3 334.7 177.3 277.7 144 207.3L193.3 167c13.7-11.2 18.4-30 11.6-46.3l-40-96z";
      labelText = "Téléphone";
      type = "text";
      placeholder = "Entrez votre numéro de téléphone";
      minLen = 9;
      maxLen = 17;
      value = user ? user.user_phone : "";
      required = false;
      break;
    case "address":
      iconViewBox = "0 0 576 512";
      iconPath =
        "M575.8 255.5c0 18-15 32.1-32 32.1h-32l.7 160.2c0 2.7-.2 5.4-.5 8.1V472c0 22.1-17.9 40-40 40H456c-1.1 0-2.2 0-3.3-.1c-1.4 .1-2.8 .1-4.2 .1H416 392c-22.1 0-40-17.9-40-40V448 384c0-17.7-14.3-32-32-32H256c-17.7 0-32 14.3-32 32v64 24c0 22.1-17.9 40-40 40H160 128.1c-1.5 0-3-.1-4.5-.2c-1.2 .1-2.4 .2-3.6 .2H104c-22.1 0-40-17.9-40-40V360c0-.9 0-1.9 .1-2.8V287.6H32c-18 0-32-14-32-32.1c0-9 3-17 10-24L266.4 8c7-7 15-8 22-8s15 2 21 7L564.8 231.5c8 7 12 15 11 24z";
      labelText = "Adresse";
      break;
    case "oldPassword":
      iconViewBox = "0 0 576 512";
      iconPath =
        "M352 144c0-44.2 35.8-80 80-80s80 35.8 80 80v48c0 17.7 14.3 32 32 32s32-14.3 32-32V144C576 64.5 511.5 0 432 0S288 64.5 288 144v48H64c-35.3 0-64 28.7-64 64V448c0 35.3 28.7 64 64 64H384c35.3 0 64-28.7 64-64V256c0-35.3-28.7-64-64-64H352V144z";
      labelText = "Mot de passe actuel";
      type = "password";
      placeholder = "Entrez votre mot de passe actuel";
      minLen = 8;
      maxLen = 40;
      required = true;
      break;
    case "newPassword":
      iconViewBox = "0 0 448 512";
      iconPath =
        "M144 144v48H304V144c0-44.2-35.8-80-80-80s-80 35.8-80 80zM80 192V144C80 64.5 144.5 0 224 0s144 64.5 144 144v48h16c35.3 0 64 28.7 64 64V448c0 35.3-28.7 64-64 64H64c-35.3 0-64-28.7-64-64V256c0-35.3 28.7-64 64-64H80z";
      labelText = "Nouveau mot de passe";
      type = "password";
      placeholder = "Entrez votre nouveau mot de passe";
      minLen = 8;
      maxLen = 40;
      required = true;
      break;
    case "confirmPassword":
      iconViewBox = "0 0 448 512";
      iconPath =
        "M144 144v48H304V144c0-44.2-35.8-80-80-80s-80 35.8-80 80zM80 192V144C80 64.5 144.5 0 224 0s144 64.5 144 144v48h16c35.3 0 64 28.7 64 64V448c0 35.3-28.7 64-64 64H64c-35.3 0-64-28.7-64-64V256c0-35.3 28.7-64 64-64H80z";
      labelText = "Confirmer le mot de passe";
      type = "password";
      placeholder = "Confirmez votre nouveau mot de passe";
      minLen = 8;
      maxLen = 40;
      required = true;
      break;
    case "gender":
      iconViewBox = "0 0 640 512";
      iconPath =
        "M176 288a112 112 0 1 0 0-224 112 112 0 1 0 0 224zM352 176c0 86.3-62.1 158.1-144 173.1V384h32c17.7 0 32 14.3 32 32s-14.3 32-32 32H208v32c0 17.7-14.3 32-32 32s-32-14.3-32-32V448H112c-17.7 0-32-14.3-32-32s14.3-32 32-32h32V349.1C62.1 334.1 0 262.3 0 176C0 78.8 78.8 0 176 0s176 78.8 176 176zM271.9 360.6c19.3-10.1 36.9-23.1 52.1-38.4c20 18.5 46.7 29.8 76.1 29.8c61.9 0 112-50.1 112-112s-50.1-112-112-112c-7.2 0-14.3 .7-21.1 2c-4.9-21.5-13-41.7-24-60.2C369.3 66 384.4 64 400 64c37 0 71.4 11.4 99.8 31l20.6-20.6L487 41c-6.9-6.9-8.9-17.2-5.2-26.2S494.3 0 504 0H616c13.3 0 24 10.7 24 24V136c0 9.7-5.8 18.5-14.8 22.2s-19.3 1.7-26.2-5.2l-33.4-33.4L545 140.2c19.5 28.4 31 62.7 31 99.8c0 97.2-78.8 176-176 176c-50.5 0-96-21.3-128.1-55.4z";
      labelText = "Genre";
      required = true;
      break;
    case "firstname":
      iconViewBox = "0 0 448 512";
      iconPath =
        "M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-45.7 48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512H418.3c16.4 0 29.7-13.3 29.7-29.7C448 383.8 368.2 304 269.7 304H178.3z";
      labelText = "Prénom";
      type = "text";
      placeholder = "Entrez votre prénom";
      value = user ? user.user_firstname : "";
      minLen = 1;
      maxLen = 50;
      required = true;
      break;
    case "lastname":
      iconViewBox = "0 0 448 512";
      iconPath =
        "M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-45.7 48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512H418.3c16.4 0 29.7-13.3 29.7-29.7C448 383.8 368.2 304 269.7 304H178.3z";
      labelText = "Nom";
      type = "text";
      placeholder = "Entrez votre nom";
      value = user ? user.user_lastname : "";
      minLen = 1;
      maxLen = 50;
      required = true;
      break;
    case "status":
      iconViewBox = "0 0 640 512";
      iconPath =
        "M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-45.7 48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512H418.3c10 0 18.8-4.9 24.2-12.5l-99.2-99.2c-14.9-14.9-23.3-35.1-23.3-56.1v-33c-15.9-4.7-32.8-7.2-50.3-7.2H178.3zM384 224c-17.7 0-32 14.3-32 32v82.7c0 17 6.7 33.3 18.7 45.3L478.1 491.3c18.7 18.7 49.1 18.7 67.9 0l73.4-73.4c18.7-18.7 18.7-49.1 0-67.9L512 242.7c-12-12-28.3-18.7-45.3-18.7H384zm24 80a24 24 0 1 1 48 0 24 24 0 1 1 -48 0z";
      labelText = "Statut";
      required = true;
      break;
    default:
      console.error("Erreur");
      return;
  }

  const field = document.createElement("div");
  field.className = "field";
  modalUpdateForm.appendChild(field);

  const fieldLabelBox = document.createElement("div");
  fieldLabelBox.className = "field-label";
  field.appendChild(fieldLabelBox);

  const fieldLabelIcon = document.createElementNS(
    "http://www.w3.org/2000/svg",
    "svg"
  );
  fieldLabelIcon.classList.add("icon-black");
  fieldLabelIcon.setAttribute("xmlns", "http://www.w3.org/2000/svg");
  fieldLabelIcon.setAttribute("viewBox", iconViewBox);
  fieldLabelBox.appendChild(fieldLabelIcon);
  const fieldLabelIconPath = document.createElementNS(
    "http://www.w3.org/2000/svg",
    "path"
  );
  fieldLabelIconPath.setAttribute("d", iconPath);
  fieldLabelIcon.appendChild(fieldLabelIconPath);

  const fieldLabel = document.createElement("label");
  fieldLabel.htmlFor = element;
  fieldLabel.innerHTML += labelText;
  fieldLabelBox.appendChild(fieldLabel);

  if (type === "password") {
    const fieldInputBox = document.createElement("div");
    fieldInputBox.className = "password-input";
    field.appendChild(fieldInputBox);

    const fieldInput = document.createElement("input");
    fieldInput.id = `${element}Input`;
    fieldInput.type = type;
    fieldInput.name = element;
    fieldInput.placeholder = placeholder;
    fieldInput.minLength = minLen;
    fieldInput.maxLength = maxLen;
    fieldInput.required = true;
    fieldInputBox.appendChild(fieldInput);

    const visibilityBox = document.createElement("span");
    visibilityBox.className = "visibility-password";
    fieldInputBox.appendChild(visibilityBox);

    const visibilityIcon = document.createElementNS(
      "http://www.w3.org/2000/svg",
      "svg"
    );
    visibilityIcon.setAttribute("xmlns", "http://www.w3.org/2000/svg");
    visibilityIcon.setAttribute("viewBox", "0 0 576 512");
    visibilityBox.appendChild(visibilityIcon);

    const visibilityIconPath = document.createElementNS(
      "http://www.w3.org/2000/svg",
      "path"
    );
    visibilityIconPath.setAttribute(
      "d",
      "M288 32c-80.8 0-145.5 36.8-192.6 80.6C48.6 156 17.3 208 2.5 243.7c-3.3 7.9-3.3 16.7 0 24.6C17.3 304 48.6 356 95.4 399.4C142.5 443.2 207.2 480 288 480s145.5-36.8 192.6-80.6c46.8-43.5 78.1-95.4 93-131.1c3.3-7.9 3.3-16.7 0-24.6c-14.9-35.7-46.2-87.7-93-131.1C433.5 68.8 368.8 32 288 32zM144 256a144 144 0 1 1 288 0 144 144 0 1 1 -288 0zm144-64c0 35.3-28.7 64-64 64c-7.1 0-13.9-1.2-20.3-3.3c-5.5-1.8-11.9 1.6-11.7 7.4c.3 6.9 1.3 13.8 3.2 20.7c13.7 51.2 66.4 81.6 117.6 67.9s81.6-66.4 67.9-117.6c-11.1-41.5-47.8-69.4-88.6-71.1c-5.8-.2-9.2 6.1-7.4 11.7c2.1 6.4 3.3 13.2 3.3 20.3z"
    );
    visibilityIcon.appendChild(visibilityIconPath);

    passwordVisibilityToggle({ input: fieldInput, visibility: visibilityBox });

    if (element === "newPassword") {
      const passwordStrengthBox = document.createElement("div");
      passwordStrengthBox.className = "password-strength-box";
      field.appendChild(passwordStrengthBox);

      const passwordStrengthLabel = document.createElement("p");
      passwordStrengthLabel.textContent = "Force du mot de passe : ";
      passwordStrengthBox.appendChild(passwordStrengthLabel);

      const passwordStrengthLevel = document.createElement("span");
      passwordStrengthLevel.className = "password-empty";
      passwordStrengthLevel.textContent = "Vide";
      passwordStrengthLabel.appendChild(passwordStrengthLevel);

      const passwordStrengthProgressbar = document.createElement("div");
      passwordStrengthProgressbar.className = "password-progressbar";
      passwordStrengthBox.appendChild(passwordStrengthProgressbar);

      const passwordStrength = document.createElement("div");
      passwordStrength.className = "password-strength password-empty";
      passwordStrengthProgressbar.appendChild(passwordStrength);

      passwordCheckStrength({
        input: fieldInput,
        label: passwordStrengthLevel,
        strength: passwordStrength,
      });
    }
  } else if (element === "address") {
    const addressInputBox = document.createElement("div");
    addressInputBox.id = "addressInput";
    addressInputBox.className = "address-input-box";
    field.appendChild(addressInputBox);

    const fieldInputNumber = document.createElement("input");
    fieldInputNumber.id = "addressInputNumber";
    fieldInputNumber.className = "address-number";
    fieldInputNumber.type = "text";
    fieldInputNumber.name = "addressNumber";
    fieldInputNumber.placeholder = "86";
    fieldInputNumber.value = user ? user.user_address_number : "";
    fieldInputNumber.minLength = "1";
    fieldInputNumber.maxLength = "10";
    fieldInputNumber.required = true;
    addressInputBox.appendChild(fieldInputNumber);

    const fieldInputStreet = document.createElement("input");
    fieldInputStreet.id = "addressInputStreet";
    fieldInputStreet.className = "address-street";
    fieldInputStreet.type = "text";
    fieldInputStreet.name = "addressStreet";
    fieldInputStreet.placeholder = "rue aux Arènes";
    fieldInputStreet.value = user ? user.user_street : "";
    fieldInputStreet.minLength = "1";
    fieldInputStreet.maxLength = "50";
    fieldInputStreet.required = true;
    addressInputBox.appendChild(fieldInputStreet);

    const fieldInputZipCode = document.createElement("input");
    fieldInputZipCode.id = "addressInputZipCode";
    fieldInputZipCode.className = "address-zip-code";
    fieldInputZipCode.type = "text";
    fieldInputZipCode.name = "addressZipCode";
    fieldInputZipCode.placeholder = "57000";
    fieldInputZipCode.value = user ? user.user_zip_code : "";
    fieldInputZipCode.minLength = "5";
    fieldInputZipCode.maxLength = "5";
    fieldInputZipCode.required = true;
    addressInputBox.appendChild(fieldInputZipCode);

    const fieldInputCity = document.createElement("input");
    fieldInputCity.id = "addressInputCity";
    fieldInputCity.className = "address-city";
    fieldInputCity.type = "text";
    fieldInputCity.name = "addressCity";
    fieldInputCity.placeholder = "Metz";
    fieldInputCity.value = user ? user.user_city : "";
    fieldInputCity.minLength = "1";
    fieldInputCity.maxLength = "60";
    fieldInputCity.required = true;
    addressInputBox.appendChild(fieldInputCity);
  } else if (element === "gender") {
    const fieldInputcheckbox = document.createElement("div");
    fieldInputcheckbox.id = "genderInput";
    fieldInputcheckbox.className = "gender-input-box";
    field.appendChild(fieldInputcheckbox);

    const fieldInputManBox = document.createElement("div");
    fieldInputManBox.id = "genderMan";
    fieldInputManBox.className = "gender-input";
    fieldInputcheckbox.appendChild(fieldInputManBox);

    const fieldInputcheckboxMan = document.createElement("input");
    fieldInputcheckboxMan.type = "radio";
    if (user && user.user_gender === 1) fieldInputcheckboxMan.checked = true;
    fieldInputcheckboxMan.name = "gender";
    fieldInputcheckboxMan.value = "1";
    fieldInputcheckboxMan.id = "genderInputMan";
    const fieldLabelcheckboxMan = document.createElement("label");
    fieldLabelcheckboxMan.htmlFor = "genderInputMan";
    fieldLabelcheckboxMan.textContent = "Homme";
    fieldInputManBox.appendChild(fieldInputcheckboxMan);
    fieldInputManBox.appendChild(fieldLabelcheckboxMan);

    const fieldInputWomanBox = document.createElement("div");
    fieldInputWomanBox.id = "genderWoman";
    fieldInputWomanBox.className = "gender-input";
    fieldInputcheckbox.appendChild(fieldInputWomanBox);

    const fieldInputcheckboxWoman = document.createElement("input");
    fieldInputcheckboxWoman.type = "radio";
    if (user && user.user_gender === 2) fieldInputcheckboxWoman.checked = true;
    fieldInputcheckboxWoman.name = "gender";
    fieldInputcheckboxWoman.value = "2";
    fieldInputcheckboxWoman.id = "genderInputWoman";
    const fieldLabelcheckboxWoman = document.createElement("label");
    fieldLabelcheckboxWoman.htmlFor = "genderInputWoman";
    fieldLabelcheckboxWoman.textContent = "Femme";
    fieldInputWomanBox.appendChild(fieldInputcheckboxWoman);
    fieldInputWomanBox.appendChild(fieldLabelcheckboxWoman);

    const fieldInputNotSpecifiedBox = document.createElement("div");
    fieldInputNotSpecifiedBox.id = "genderNotSpecified";
    fieldInputNotSpecifiedBox.className = "gender-input";
    fieldInputcheckbox.appendChild(fieldInputNotSpecifiedBox);

    const fieldInputcheckboxNotSpecified = document.createElement("input");
    fieldInputcheckboxNotSpecified.type = "radio";
    if (user && user.user_gender != 1 && user.user_gender != 2)
      fieldInputcheckboxNotSpecified.checked = true;
    fieldInputcheckboxNotSpecified.name = "gender";
    fieldInputcheckboxNotSpecified.value = "3";
    fieldInputcheckboxNotSpecified.id = "genderInputNotSpecified";
    const fieldLabelcheckboxNotSpecified = document.createElement("label");
    fieldLabelcheckboxNotSpecified.htmlFor = "genderInputNotSpecified";
    fieldLabelcheckboxNotSpecified.textContent = "Non renseigné";
    fieldInputNotSpecifiedBox.appendChild(fieldInputcheckboxNotSpecified);
    fieldInputNotSpecifiedBox.appendChild(fieldLabelcheckboxNotSpecified);
  } else if (element === "status") {
    const status = await ajaxFetch("status");
    const fieldInputSelect = document.createElement("select");
    fieldInputSelect.name = element;
    field.appendChild(fieldInputSelect);

    status.forEach((currentStatus) => {
      const fieldInputOption = document.createElement("option");
      fieldInputOption.value = currentStatus.status_id;
      fieldInputOption.textContent =
        user && user.user_gender == 2 && currentStatus.status_female_name
          ? currentStatus.status_female_name
          : currentStatus.status_male_name;
      if (user && currentStatus.status_id === user.status_id) {
        fieldInputOption.selected = true;
      }
      fieldInputSelect.appendChild(fieldInputOption);
    });
  } else {
    const fieldInput = document.createElement("input");
    fieldInput.id = `${element}Input`;
    fieldInput.type = type;
    fieldInput.name = element;
    fieldInput.placeholder = placeholder;
    fieldInput.value = value;
    if (minLen) fieldInput.minLength = minLen;
    if (maxLen) fieldInput.maxLength = maxLen;
    fieldInput.required = true;
    field.appendChild(fieldInput);
  }

  const fieldAlertBox = document.createElement("div");
  fieldAlertBox.id = `${element}InputAlertBox`;
  field.appendChild(fieldAlertBox);
}
