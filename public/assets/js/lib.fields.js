import { addModalMessage } from "./lib.modal-message.js";

const passwordInfoMessage =
  "Le mot de passe doit comporter entre 8 et 40 caractères et contenir au minimum une minuscule, une majuscule, un chiffre et un caractère spécial ( # , ? , ! , @ , $ , % , ^ , & , * , - ).";
const passwordLengthMessage =
  "Le mot de passe doit comporter entre 8 et 40 caractères.";
const passwordFormatMessage =
  "Le mot de passe doit contenir au minimum : une minuscule, une majuscule, un chiffre et un caractère spécial ( # , ? , ! , @ , $ , % , ^ , & , * , - ).";
const passwordRequiredMessage = "Le champ mot de passe est obligatoire.";

const confirmPasswordInfoMessage =
  "Les deux mots de passe doivent correspondrent.";
const confirmPasswordDifferentMessage =
  "Les deux mots de passe doivent correspondrent.";
const confirmPasswordRequireMessage =
  "Le champ de confirmation du mot de passe est obligatoire.";

function regexPasswordAcceptable(password) {
  return /^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/.test(
    password
  );
}

function regexPasswordStrong(password) {
  return /^(?=.*?[A-Z]{2})(?=.*?[a-z]{2})(?=.*?[0-9]{2})(?=.*?[#?!@$%^&*-]{2}).{12,}$/.test(
    password
  );
}

function regexPasswordStronger(password) {
  return /^(?=.*?[A-Z]{3})(?=.*?[a-z]{3})(?=.*?[0-9]{3})(?=.*?[#?!@$%^&*-]{3}).{16,}$/.test(
    password
  );
}

export function passwordVisibilityToggle(passwordId) {
  const password = document.querySelector(`#${passwordId}`);
  const passwordVisibility = document.querySelector(`#${passwordId}Visibility`);

  if (!password || !passwordVisibility) {
    console.log("Erreur");
    return;
  }

  passwordVisibility.addEventListener("click", function (e) {
    if (password.type === "password") {
      password.type = "text";
      const svg = `<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512"><path d="M38.8 5.1C28.4-3.1 13.3-1.2 5.1 9.2S-1.2 34.7 9.2 42.9l592 464c10.4 8.2 25.5 6.3 33.7-4.1s6.3-25.5-4.1-33.7L525.6 386.7c39.6-40.6 66.4-86.1 79.9-118.4c3.3-7.9 3.3-16.7 0-24.6c-14.9-35.7-46.2-87.7-93-131.1C465.5 68.8 400.8 32 320 32c-68.2 0-125 26.3-169.3 60.8L38.8 5.1zM223.1 149.5C248.6 126.2 282.7 112 320 112c79.5 0 144 64.5 144 144c0 24.9-6.3 48.3-17.4 68.7L408 294.5c8.4-19.3 10.6-41.4 4.8-63.3c-11.1-41.5-47.8-69.4-88.6-71.1c-5.8-.2-9.2 6.1-7.4 11.7c2.1 6.4 3.3 13.2 3.3 20.3c0 10.2-2.4 19.8-6.6 28.3l-90.3-70.8zM373 389.9c-16.4 6.5-34.3 10.1-53 10.1c-79.5 0-144-64.5-144-144c0-6.9 .5-13.6 1.4-20.2L83.1 161.5C60.3 191.2 44 220.8 34.5 243.7c-3.3 7.9-3.3 16.7 0 24.6c14.9 35.7 46.2 87.7 93 131.1C174.5 443.2 239.2 480 320 480c47.8 0 89.9-12.9 126.2-32.5L373 389.9z"/></svg>`;
      passwordVisibility.innerHTML = svg; // Icone visibilité
    } else {
      password.type = "password";
      const svg = `<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><path d="M288 32c-80.8 0-145.5 36.8-192.6 80.6C48.6 156 17.3 208 2.5 243.7c-3.3 7.9-3.3 16.7 0 24.6C17.3 304 48.6 356 95.4 399.4C142.5 443.2 207.2 480 288 480s145.5-36.8 192.6-80.6c46.8-43.5 78.1-95.4 93-131.1c3.3-7.9 3.3-16.7 0-24.6c-14.9-35.7-46.2-87.7-93-131.1C433.5 68.8 368.8 32 288 32zM144 256a144 144 0 1 1 288 0 144 144 0 1 1 -288 0zm144-64c0 35.3-28.7 64-64 64c-7.1 0-13.9-1.2-20.3-3.3c-5.5-1.8-11.9 1.6-11.7 7.4c.3 6.9 1.3 13.8 3.2 20.7c13.7 51.2 66.4 81.6 117.6 67.9s81.6-66.4 67.9-117.6c-11.1-41.5-47.8-69.4-88.6-71.1c-5.8-.2-9.2 6.1-7.4 11.7c2.1 6.4 3.3 13.2 3.3 20.3z"/></svg>`;
      passwordVisibility.innerHTML = svg; // Icone visibilité
    }
  });
}

export function closeAlert(alertId) {
  const alert = document.querySelector(`#${alertId}Alert`);
  const closeButton = document.querySelector(`#${alertId}AlertClose`);

  if (!alert || !closeButton) {
    return;
  }

  closeButton.addEventListener("click", function (e) {
    alert.remove();
  });
}

export function resetAlerts(alertBoxId) {
  const alertBox = document.querySelector(`#${alertBoxId}`);

  if (!alertBox) {
    return;
  }

  alertBox.innerHTML = "";
}

export function showInfos(type, infoId) {
  const info = document.querySelector(`#${infoId}Info`);
  const alertBox = document.querySelector(`#${infoId}AlertBox`);

  if (!info || !alertBox) {
    console.log("Erreur");
    return;
  }

  let message = null;

  switch (type) {
    case "password":
      message = passwordInfoMessage;
      break;
    case "confirmPassword":
      message = confirmPasswordInfoMessage;
      break;
    default:
      console.log("Erreur");
      return;
  }

  info.addEventListener("click", function (e) {
    resetAlerts(`${infoId}AlertBox`);
    createAlert("info", `${infoId}AlertBox`, `${infoId}Info`, message);
  });
}

export function createAlert(type, alertBoxId, alertId, message) {
  let label = null;
  switch (type) {
    case "error":
      label = "Erreur : ";
      break;
    case "warning":
      label = "Attention : ";
      break;
    case "info":
      label = "Information : ";
      break;
    case "success":
      label = "Succès : ";
      break;
    default:
      console.log("Erreur");
      return;
  }
  const alertBox = document.querySelector(`#${alertBoxId}`);

  if (!alertBox) {
    console.log("Erreur");
    return;
  }

  const alert = document.createElement("div");
  alert.id = alertId;
  alert.className = `alert alert-${type}`;

  const messageText = document.createElement("p");
  const messageLabel = document.createElement("span");
  messageLabel.innerHTML = label;
  messageText.appendChild(messageLabel);
  messageText.innerHTML += message;
  alert.appendChild(messageText);

  const closeSpan = document.createElement("span");
  closeSpan.id = `${alertId}Close`;
  const closeSvg = document.createElementNS(
    "http://www.w3.org/2000/svg",
    "svg"
  );
  closeSvg.setAttribute("viewBox", "0 0 384 512");
  closeSvg.setAttribute("xmlns", "http://www.w3.org/2000/svg");
  const closePath = document.createElementNS(
    "http://www.w3.org/2000/svg",
    "path"
  ); // Icone fermer
  closePath.setAttribute(
    "d",
    "M342.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L192 210.7 86.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L146.7 256 41.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L192 301.3 297.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L237.3 256 342.6 150.6z"
  );
  closeSvg.appendChild(closePath);
  closeSpan.appendChild(closeSvg);
  alert.appendChild(closeSpan);

  closeSpan.addEventListener("click", function (e) {
    alert.remove();
  });

  alertBox.appendChild(alert);
}

export function passwordCheckStrength(passwordId) {
  const password = document.querySelector(`#${passwordId}`);
  const passwordStrengthLabel = document.querySelector(
    `#${passwordId}StrengthLabel`
  );
  const passwordStrength = document.querySelector(`#${passwordId}Strength`);

  if (!password || !passwordStrengthLabel || !passwordStrength) {
    console.log("Erreur");
    return;
  }

  password.addEventListener("input", function (e) {
    if (password.value.length > 0) {
      if (regexPasswordStronger(password.value)) {
        passwordStrength.className = "password-strength password-stronger";
        passwordStrengthLabel.innerHTML = "Très fort";
        passwordStrengthLabel.className = "password-stronger";
      } else if (regexPasswordStrong(password.value)) {
        passwordStrength.className = "password-strength password-strong";
        passwordStrengthLabel.innerHTML = "Fort";
        passwordStrengthLabel.className = "password-strong";
      } else if (regexPasswordAcceptable(password.value)) {
        passwordStrength.className = "password-strength password-acceptable";
        passwordStrengthLabel.innerHTML = "Acceptable";
        passwordStrengthLabel.className = "password-acceptable";
      } else {
        passwordStrength.className = "password-strength password-insufficient";
        passwordStrengthLabel.innerHTML = "Insuffisant";
        passwordStrengthLabel.className = "password-insufficient";
      }
    } else {
      passwordStrength.className = "password-strength password-empty";
      passwordStrengthLabel.innerHTML = "Vide";
      passwordStrengthLabel.className = "password-empty";
    }
  });
}

export function passwordCheck(passwordId, submit) {
  const password = document.querySelector(`#${passwordId}`);
  const passwordStrengthLabel = document.querySelector(
    `#${passwordId}StrengthLabel`
  );
  const passwordStrength = document.querySelector(`#${passwordId}Strength`);

  if (!password || !passwordStrengthLabel || !passwordStrength) {
    console.log("Erreur");
    return;
  }

  switch (submit) {
    case false:
      password.addEventListener("blur", function (e) {
        resetAlerts(`${passwordId}AlertBox`);

        if (password.value.length != 0) {
          if (password.value.length < 8 || password.value.length > 40) {
            createAlert(
              "warning",
              `${passwordId}AlertBox`,
              `${passwordId}LengthAlert`,
              passwordLengthMessage
            );
          }

          if (!regexPasswordAcceptable(password.value)) {
            createAlert(
              "warning",
              `${passwordId}AlertBox`,
              `${passwordId}FormatAlert`,
              passwordFormatMessage
            );
          }
        }
      });
      break;
    case true:
      resetAlerts(`${passwordId}AlertBox`);

      let errors = 0;

      if (password.value.length != 0) {
        if (password.value.length < 8 || password.value.length > 40) {
          errors++;
          createAlert(
            "warning",
            `${passwordId}AlertBox`,
            `${passwordId}LengthAlert`,
            passwordLengthMessage
          );
        }

        if (!regexPasswordAcceptable(password.value)) {
          errors++;
          createAlert(
            "warning",
            `${passwordId}AlertBox`,
            `${passwordId}FormatAlert`,
            passwordFormatMessage
          );
        }
      } else {
        errors++;
        createAlert(
          "warning",
          `${passwordId}AlertBox`,
          `${passwordId}RequiredAlert`,
          passwordRequiredMessage
        );
      }

      if (errors === 0) {
        return true;
      } else {
        return false;
      }
    default:
      console.log("Erreur");
      return;
  }
}

export function confirmPasswordCheck(
  confirmPasswordId,
  validatePasswordId,
  submit
) {
  const confirmPassword = document.querySelector(`#${confirmPasswordId}`);
  const validatePassword = document.querySelector(`#${validatePasswordId}`);

  if (!confirmPassword || !validatePassword) {
    console.log("Erreur");
    return;
  }

  switch (submit) {
    case false:
      confirmPassword.addEventListener("blur", function (e) {
        resetAlerts(`${confirmPasswordId}AlertBox`);

        if (confirmPassword.value.length != 0) {
          if (confirmPassword.value != validatePassword.value) {
            createAlert(
              "warning",
              `${confirmPasswordId}AlertBox`,
              `${confirmPasswordId}DifferentAlert`,
              confirmPasswordDifferentMessage
            );
          }
        }
      });
      break;
    case true:
      resetAlerts(`${confirmPasswordId}AlertBox`);

      let errors = 0;

      if (confirmPassword.value.length != 0) {
        if (confirmPassword.value != validatePassword.value) {
          errors++;
          createAlert(
            "warning",
            `${confirmPasswordId}AlertBox`,
            `${confirmPasswordId}DifferentAlert`,
            confirmPasswordDifferentMessage
          );
        }
      } else {
        errors++;
        createAlert(
          "warning",
          `${confirmPasswordId}AlertBox`,
          `${confirmPasswordId}RequiredAlert`,
          confirmPasswordRequireMessage
        );
      }

      if (errors === 0) {
        return true;
      } else {
        return false;
      }
    default:
      console.log("Erreur");
      return;
  }
}

export function selectCheck(selectId, selectOptions, submit) {
  const select = document.querySelector(`#${selectId}`);
  let selectedOption = select.value;

  if (!select) {
    console.log("Erreur");
    return;
  }

  switch (submit) {
    case false:
      select.addEventListener("change", function (e) {
        resetAlerts(`${selectId}AlertBox`);

        selectedOption = e.target.value;

        if (selectedOption === "") {
          createAlert(
            "warning",
            `${selectId}AlertBox`,
            `${selectId}LengthAlert`,
            "Veuillez choisir une catégorie."
          );
        }

        if (selectedOption != "" && !selectOptions.includes(selectedOption)) {
          createAlert(
            "warning",
            `${selectId}AlertBox`,
            `${selectId}LengthAlert`,
            "Catégorie inconnue."
          );
        }
      });
      break;
    case true:
      resetAlerts(`${selectId}AlertBox`);

      let errors = 0;

      if (selectedOption === "") {
        errors++;
        createAlert(
          "warning",
          `${selectId}AlertBox`,
          `${selectId}LengthAlert`,
          "Veuillez choisir une catégorie."
        );
      }

      if (selectedOption != "" && !selectOptions.includes(selectedOption)) {
        errors++;
        createAlert(
          "warning",
          `${selectId}AlertBox`,
          `${selectId}LengthAlert`,
          "Catégorie inconnue."
        );
      }

      if (errors === 0) {
        return true;
      } else {
        return false;
      }
    default:
      console.log("Erreur");
      return;
  }
}

export function textCheck(textId, minLen, maxLen, submit) {
  const text = document.querySelector(`#${textId}`);

  if (!text) {
    console.log("Erreur");
    return;
  }

  switch (submit) {
    case false:
      text.addEventListener("change", function (e) {
        resetAlerts(`${textId}AlertBox`);

        if (text.value.length != 0) {
          if (text.value.length < minLen) {
            createAlert(
              "warning",
              `${textId}AlertBox`,
              `${textId}LengthAlert`,
              `Ce champ doit comporter au minimum ${minLen} caractère${
                minLen > 1 ? "s" : ""
              }.`
            );
          }
          if (maxLen) {
            if (text.value.length > maxLen) {
              createAlert(
                "warning",
                `${textId}AlertBox`,
                `${textId}LengthAlert`,
                `Ce champ doit comporter au maximum ${maxLen} caractère${
                  maxLen > 1 ? "s" : ""
                }.`
              );
            }
          }
        }
      });
      break;
    case true:
      resetAlerts(`${textId}AlertBox`);

      let errors = 0;

      if (text.value.length != 0) {
        if (text.value.length < minLen) {
          errors++;
          createAlert(
            "warning",
            `${textId}AlertBox`,
            `${textId}LengthAlert`,
            `Ce champ doit comporter au minimum ${minLen} caractère${
              minLen > 1 ? "s" : ""
            }.`
          );
        }
        if (maxLen) {
          if (text.value.length > maxLen) {
            errors++;
            createAlert(
              "warning",
              `${textId}AlertBox`,
              `${textId}LengthAlert`,
              `Ce champ doit comporter au maximum ${maxLen} caractère${
                maxLen > 1 ? "s" : ""
              }.`
            );
          }
        }
      } else {
        errors++;
        createAlert(
          "warning",
          `${textId}AlertBox`,
          `${textId}RequiredAlert`,
          "Ce champ est obligatoire."
        );
      }

      if (errors === 0) {
        return true;
      } else {
        return false;
      }
    default:
      console.log("Erreur");
      return;
  }
}

export function fieldCheck(field, submit) {
  if (!field.type || !field.id) {
    console.log("Erreur");
    return;
  }

  const currentField = document.querySelector(`#${field.id}`);

  if (!currentField) {
    console.log("Erreur");
    return;
  }

  switch (field.type) {
    case "password":
      return passwordCheck(field.id, submit);
    case "confirmPassword":
      return confirmPasswordCheck(field.id, field.validate, submit);
    case "select":
      return selectCheck(field.id, field.options, submit);
    case "text":
      return textCheck(field.id, field.minLen, field.maxLen, submit);
    default:
      console.log("Erreur");
      return;
  }
}

export function formCheck(formId, fields) {
  const form = document.querySelector(`#${formId}`);
  const formSubmit = document.querySelector(`#${formId}Submit`);

  if (!form || !formSubmit) {
    console.log("Erreur");
    return;
  }

  fields.forEach((field) => {
    fieldCheck(field, false);
  });

  formSubmit.addEventListener("click", async function (e) {
    e.preventDefault();

    let validForm = true;
    let controlledFields = [];

    fields.forEach((field) => {
      controlledFields.push(fieldCheck(field, true));
    });

    let errors = 0;

    controlledFields.forEach(function (controlledField) {
      if (!controlledField) {
        validForm = false;
        errors++;
      }
    });

    console.log(controlledFields);

    const errorsCount =
      errors > 1 ? `${errors} champs invalides` : `${errors} champ invalide`;

    if (!validForm) {
      addModalMessage(
        "warning",
        `Il y a ${errorsCount} dans votre formulaire.`
      );
      return;
    }

    form.submit();
  });
}
