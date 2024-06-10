import { ajaxFetch } from "./libs/utils.js";
import { closeAlert, formCheck } from "./libs/fields.js";

// Fermeture des messages d'erreurs php
closeAlert("requiredCategory");
closeAlert("unknownCategory");
closeAlert("requiredObject");
closeAlert("tooLongObject");
closeAlert("requiredBody");

// Vérification du formulaire
const categories = await ajaxFetch("contact-categories");
formCheck("contactForm", [
  { type: "select", id: "contactCategory", options: categories },
  { type: "text", id: "contactObject", minLen: "1", maxLen: "255" },
  { type: "text", id: "contactBody", minLen: "1", maxLen: null },
]);
