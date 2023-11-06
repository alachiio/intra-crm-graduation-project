export function toggleCode(e) {
    const card = e.target.closest(".card");
    const codeWrapper = card.querySelector(".code-wrapper");

    e.target.checked
        ? codeWrapper.classList.remove("hidden")
        : codeWrapper.classList.add("hidden");
}

export function getBrwoserScrollbarWidth() {
    return window.innerWidth - document.documentElement.clientWidth;
}

export function copyText($el) {
    const range = document.createRange();
    range.selectNodeContents($el);
    const selection = window.getSelection();
    selection.removeAllRanges();
    selection.addRange(range);
    document.execCommand('copy');
    selection.removeAllRanges();
}

export function getJsonValue(obj, path) {
    const keys = path.split('.');
    let value = obj;
    for (const key of keys) {
        value = value[key];
        if (value === undefined) {
            return undefined;
        }
    }
    return value;
}
