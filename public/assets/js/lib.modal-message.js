import { ucFirst, onlyNumber } from "./lib.utils.js";

const containerModalMessage = document.querySelector("#containerModalMessage");

export function addModalMessage(type, message) {
  // Ajout de la modale dans la session
  fetch("ajax.php?ajax=add-modal-message", {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
    },
    body: JSON.stringify({ type: type, message: message }),
  })
    .then((response) => response.json())
    .then((data) => {
      const keys = Object.keys(data.result).map((key) => parseInt(key, 10));
      const lastIndex = Math.max(...keys);
      addModalMessageDOM(lastIndex, type, message);
    })
    .catch((error) => {
      console.error(error);
    });
}

function addModalMessageDOM(index, type, message) {
  // Ajout de la modale du DOM
  const displayTime = 7;
  const currentTime = Math.floor(Date.now() / 1000);

  let label = "";
  let path = "";

  switch (type) {
    case "success":
      label = "Succès";
      path =
        "M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM369 209L241 337c-9.4 9.4-24.6 9.4-33.9 0l-64-64c-9.4-9.4-9.4-24.6 0-33.9s24.6-9.4 33.9 0l47 47L335 175c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9z"; // Icone Succès
      break;
    case "info":
      label = "Information";
      path =
        "M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM216 336h24V272H216c-13.3 0-24-10.7-24-24s10.7-24 24-24h48c13.3 0 24 10.7 24 24v88h8c13.3 0 24 10.7 24 24s-10.7 24-24 24H216c-13.3 0-24-10.7-24-24s10.7-24 24-24zm40-208a32 32 0 1 1 0 64 32 32 0 1 1 0-64z"; // Icone Info
      break;
    case "warning":
      label = "Attention";
      path =
        "M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zm0-384c13.3 0 24 10.7 24 24V264c0 13.3-10.7 24-24 24s-24-10.7-24-24V152c0-13.3 10.7-24 24-24zM224 352a32 32 0 1 1 64 0 32 32 0 1 1 -64 0z"; // Icone Attention
      break;
    case "error":
      label = "Erreur";
      path =
        "M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM175 175c9.4-9.4 24.6-9.4 33.9 0l47 47 47-47c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9l-47 47 47 47c9.4 9.4 9.4 24.6 0 33.9s-24.6 9.4-33.9 0l-47-47-47 47c-9.4 9.4-24.6 9.4-33.9 0s-9.4-24.6 0-33.9l47-47-47-47c-9.4-9.4-9.4-24.6 0-33.9z"; // Icone Erreur
      break;
    default:
      console.error("Erreur");
      return;
  }

  const modalMessageBox = document.createElement("div");
  modalMessageBox.id = `newModalMessage${index}`;
  modalMessageBox.className = `modal-message-box modal-message-${type}`;
  modalMessageBox.setAttribute("data-start", currentTime);

  const modalMessageHeader = document.createElement("div");
  modalMessageHeader.className = "modal-message-header";
  modalMessageBox.appendChild(modalMessageHeader);

  const modalMessageIcon = document.createElementNS(
    "http://www.w3.org/2000/svg",
    "svg"
  );
  modalMessageIcon.setAttribute("xmlns", "http://www.w3.org/2000/svg");
  modalMessageIcon.setAttribute("viewBox", "0 0 512 512");
  modalMessageIcon.classList.add("modal-message-icon");
  modalMessageHeader.appendChild(modalMessageIcon);

  const modalMessageIconPath = document.createElementNS(
    "http://www.w3.org/2000/svg",
    "path"
  );
  modalMessageIconPath.setAttribute("d", path);
  modalMessageIcon.appendChild(modalMessageIconPath);

  const modalMessageLabel = document.createElement("h4");
  modalMessageLabel.textContent = label;
  modalMessageHeader.appendChild(modalMessageLabel);

  const modalMessageClose = document.createElementNS(
    "http://www.w3.org/2000/svg",
    "svg"
  );
  modalMessageClose.setAttribute("xmlns", "http://www.w3.org/2000/svg");
  modalMessageClose.setAttribute("viewBox", "0 0 512 512");
  modalMessageClose.id = `newCloseModalMessage${index}`;
  modalMessageClose.classList.add("modal-message-close");
  modalMessageClose.addEventListener("click", function (e) {
    removeModalMessage(modalMessageBox, 0);
  });
  modalMessageHeader.appendChild(modalMessageClose);

  const modalMessageClosePath = document.createElementNS(
    "http://www.w3.org/2000/svg",
    "path"
  );
  modalMessageClosePath.setAttribute(
    "d",
    "M342.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L192 210.7 86.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L146.7 256 41.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L192 301.3 297.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L237.3 256 342.6 150.6z"
  );
  modalMessageClose.appendChild(modalMessageClosePath);

  const modalMessage = document.createElement("p");
  modalMessage.className = "modal-message";
  modalMessage.textContent = message;
  modalMessageBox.appendChild(modalMessage);

  containerModalMessage.appendChild(modalMessageBox);

  removeModalMessage(modalMessageBox, displayTime * 1000);
}

export function closeModalMessages() {
  const displayTime = 7;
  const currentTime = Math.floor(Date.now() / 1000);
  const modalMessages = document.querySelectorAll('[id^="modalMessage"]');

  if (!modalMessages) {
    return;
  }

  modalMessages.forEach((modalMessage) => {
    const startTime = modalMessage.getAttribute("data-start");

    if (startTime < currentTime - displayTime) {
      removeModalMessage(modalMessage, 0);
      return;
    }

    const closeModalMessage = document.querySelector(
      `#close${ucFirst(modalMessage.id)}`
    );
    closeModalMessage.addEventListener("click", function (e) {
      removeModalMessage(modalMessage, 0);
    });

    const timeout = (displayTime - (currentTime - startTime)) * 1000;
    removeModalMessage(modalMessage, timeout);
  });
}

function removeModalMessage(modalMessage, timeout) {
  setTimeout(() => {
    // Supression de la modale dans la session
    fetch("ajax.php?ajax=delete-modal-message", {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify({
        modal_message_index: onlyNumber(modalMessage.id),
      }),
    })
      .then((response) => response.json())
      .then((data) => {
        removeModalMessageDOM(modalMessage);
      })
      .catch((error) => {
        console.error(error);
      });
  }, timeout);
}

function removeModalMessageDOM(modalMessage) {
  // Supression de la modale du DOM
  modalMessage.classList.add("fade-out");
  setTimeout(() => {
    modalMessage.remove();
  }, 500);
}
