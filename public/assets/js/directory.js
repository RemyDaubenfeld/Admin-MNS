import { createUpdateModal } from "./libs/modal-update.js";

await createUpdateModal(null, "addUser", "Ajouter un utilisateur", "form", [
  "firstname",
  "lastname",
  "gender",
  "mail",
  "phone",
  "address",
  "status",
]);
