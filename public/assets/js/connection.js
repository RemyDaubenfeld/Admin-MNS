import { visibilityPasswordToggle, closeAlert } from './lib.fields.js';

// Visibilité du mot de passe
const userPassword = document.querySelector("#userPassword");
const visibilityPassword = document.querySelector("#visibilityPassword");
visibilityPassword.addEventListener("click", () => visibilityPasswordToggle(userPassword, visibilityPassword));

// Fermeture des messages d'erreurs php
closeAlert('requiredMailAlert', 'requiredMailAlertClose');
closeAlert('invalidMailAlert', 'invalidMailAlertClose');
closeAlert('requiredPasswordAlert', 'requiredPasswordAlertClose');
