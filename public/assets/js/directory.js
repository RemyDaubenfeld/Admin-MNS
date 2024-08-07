import { createUpdateModal } from "./libs/modal-update.js";
import { removeEmptyGetParameters } from "./libs/utils.js";

await createUpdateModal(null, "addUser", "Ajouter un utilisateur", "form", [
  "firstname",
  "lastname",
  "gender",
  "mail",
  "phone",
  "address",
  "status",
]);

removeEmptyGetParameters("filtersForm", ["status", "search"]);
