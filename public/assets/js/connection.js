import { passwordVisibilityToggle, closeAlert } from "./lib.fields.js";

// Visibilité du mot de passe
passwordVisibilityToggle(null, "userPassword");

// Fermeture des messages d'erreurs php
closeAlert("requiredMail");
closeAlert("invalidMail");
closeAlert("requiredPassword");
