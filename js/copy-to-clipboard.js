const COPY_BTN = document.querySelector('#copy-ref-btn');
const REF_LINK = document.querySelector('#ref-link')

COPY_BTN.addEventListener("click", () => {
    navigator.clipboard.writeText(REF_LINK.textContent)
})
