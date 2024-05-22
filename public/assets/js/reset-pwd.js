import { visibilityPasswordToggle, closeAlert, resetAlerts, createAlert } from './lib.fields.js';

// Visibilité des mots de passe
const newPassword = document.querySelector("#newPassword");
const newVisibilityPassword = document.querySelector("#newVisibilityPassword");
newVisibilityPassword.addEventListener("click", () => visibilityPasswordToggle(newPassword, newVisibilityPassword));

const confirmPassword = document.querySelector("#confirmPassword");
const confirmVisibilityPassword = document.querySelector("#confirmVisibilityPassword");
confirmVisibilityPassword.addEventListener("click", () => visibilityPasswordToggle(confirmPassword, confirmVisibilityPassword));

// Fermeture des messages d'erreurs php
closeAlert('lengthNewPasswordAlert', 'lengthNewPasswordAlertClose');
closeAlert('formatNewPasswordAlert', 'formatNewPasswordAlertClose');
closeAlert('requiredNewPasswordAlert', 'requiredNewPasswordAlertClose');
closeAlert('requiredConfirmPasswordAlert', 'requiredConfirmPasswordAlertClose');
closeAlert('differentConfirmPasswordAlert', 'differentConfirmPasswordAlertClose');

// Création des alertes infos
const newPasswordInfo = document.querySelector("#newPasswordInfo");
newPasswordInfo.addEventListener("click", () => {
    resetAlerts('newPasswordAlertBox'),
    createAlert(
        'newPasswordAlertBox',
        'newPasswordInfo',
        'alert-info',
        'Info',
        'Le nouveau mot de passe doit comporter entre 8 et 40 caractères et contenir au minimum une minuscule, une majuscule, un chiffre et un caractère spécial ( # , ? , ! , @ , $ , % , ^ , & , * , - ).',
    );
});

const confirmPasswordInfo = document.querySelector("#confirmPasswordInfo");
confirmPasswordInfo.addEventListener("click", () => {
    resetAlerts('confirmPasswordAlertBox'),
    createAlert(
        'confirmPasswordAlertBox',
        'confirmPasswordInfo',
        'alert-info',
        'Info',
        'Les deux mots de passe doivent correspondre.',
    );
});