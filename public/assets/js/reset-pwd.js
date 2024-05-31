import {
  passwordVisibilityToggle,
  closeAlert,
  showInfos,
  passwordCheckStrength,
  passwordCheck,
  confirmPasswordCheck,
  formCheck,
} from "./lib.fields.js";

// Visibilité des mots de passe
passwordVisibilityToggle("newPassword");
passwordVisibilityToggle("confirmPassword");

// Fermeture des messages d'erreurs php
closeAlert("lengthNewPassword");
closeAlert("formatNewPassword");
closeAlert("requiredNewPassword");
closeAlert("requiredConfirmPassword");
closeAlert("differentConfirmPassword");

// Création des alertes infos
showInfos("password", "newPassword");
showInfos("confirmPassword", "confirmPassword");

// Vérification de la force du mot de passe
passwordCheckStrength("newPassword");

// Vérification du formulaire
formCheck("resetPasswordForm", [
  { type: "password", id: "newPassword" },
  { type: "confirmPassword", id: "confirmPassword", validate: "newPassword" },
]);
