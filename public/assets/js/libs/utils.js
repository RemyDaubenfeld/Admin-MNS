export function ucFirst(string) {
  return string.charAt(0).toUpperCase() + string.slice(1);
}

export function onlyNumber(string) {
  return string.replace(/\D/g, "");
}

export async function ajaxFetch(file, value = null) {
  try {
    const answer = await fetch(
      `/?ajax=${file}${value ? `&value=${value}` : ""}`
    );
    const data = await answer.json();
    return data;
  } catch (error) {
    console.error("Une erreur s'est produite : ", error);
    throw error;
  }
}

export function getUrlParameter(parameter) {
  const url = window.location.href;
  parameter = parameter.replace(/[\[\]]/g, "\\$&");
  const regex = new RegExp("[?&]" + parameter + "(=([^&#]*)|&|#|$)"),
    results = regex.exec(url);
  if (!results) return null;
  if (!results[2]) return "";
  return decodeURIComponent(results[2].replace(/\+/g, " "));
}

export function removeEmptyGetParameters(formId, parameters) {
  const form = document.querySelector(`#${formId}`);

  if (!form) {
    console.error("Erreur");
    return;
  }

  form.addEventListener("submit", function (event) {
    event.preventDefault();

    parameters.forEach((parameterId) => {
      const parameter = form.querySelector(`[name="${parameterId}"]`);

      if (!parameter) {
        console.error("Erreur");
        return;
      }

      if (!parameter.value) {
        parameter.removeAttribute("name");
      }
    });

    form.submit();
  });
}
