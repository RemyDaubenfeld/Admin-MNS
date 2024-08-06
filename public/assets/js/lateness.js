import { removeEmptyGetParameters } from "./libs/utils.js";
import { ajaxFetch, onlyNumber } from "./libs/utils.js";
import { createUpdateModal } from "./libs/modal-update.js";

removeEmptyGetParameters("filtersForm", ["period", "user-id"]);

const userId = new URLSearchParams(window.location.search).get("user-id");
const user = await ajaxFetch("user-infos", userId);

await createUpdateModal(user, "addLateness", "Déclarer un retard", "form", [
  "date",
  "startTime",
  "endTime",
]);

const lateness = document.querySelectorAll('[id^="lateness"]');

lateness.forEach(async function (currentLateness) {
  await createUpdateModal(
    user,
    currentLateness.id,
    "Supprimer ce retard ?",
    "confirmation",
    [["back"], ["archive", "archive-lateness", onlyNumber(currentLateness.id)]]
  );
});
