export function ucFirst(string) {
  return string.charAt(0).toUpperCase() + string.slice(1);
}

export function onlyNumber(string) {
  return string.replace(/\D/g, "");
}

export async function ajaxFetch(file, value = null) {
  try {
    const answer = await fetch(
      `ajax.php?ajax=${file}${value ? `&value=${value}` : ""}`
    );
    const data = await answer.json();
    return data;
  } catch (error) {
    console.error("Une erreur s'est produite : ", error);
    throw error;
  }
}
