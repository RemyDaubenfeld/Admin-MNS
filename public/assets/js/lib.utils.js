export function ucFirst(string) {
    return string.charAt(0).toUpperCase() + string.slice(1);
}

export function onlyNumber(string) {
    return string.replace(/\D/g, '');
}