const COPY_BTN = document.querySelector('#copy-ref-btn');
const REF_LINK = document.querySelector('#ref-link')



COPY_BTN.addEventListener("click", () => {
    navigator.clipboard.writeText(REF_LINK.textContent)
    console.log(REF_LINK.textContent);
})

    //console.log(11);
    // navigator.clipboard.writeText(REF_LINK.innerHTML)
    // .then(() => {
    //     console.log("done")
    // })
    // navigator.clipboard.writeText("<empty clipboard>").then(function() {
    //     /* clipboard successfully set */
    //     console.log(1);
    //   }, function() {
    //     /* clipboard write failed */
    //     console.log(0);
    //   });