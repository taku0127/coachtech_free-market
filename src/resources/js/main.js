window.onload = function () {
    const input = document.querySelector(".js-input_img");
    const preview = document.querySelector(".js-preview");
    const preview_background = document.querySelector(".js-preview-background");

    input?.addEventListener("change", (event) => {
        // <1>
        const [file] = event.target.files;
        if (preview) {
            if (file) {
                preview.setAttribute("src", URL.createObjectURL(file));
            } else {
                preview.setAttribute("src", "../img/dummy.png");
            }
        } else if (preview_background) {
            preview_background.style.background = `url(${URL.createObjectURL(
                file
            )}) center center / contain no-repeat`;
        }
    });
    const payment_method_select = document.querySelector(".js-selectPayment");
    payment_method_select?.addEventListener("change", changePaymentText);
    function changePaymentText() {
        var payment_method_select_text =
            payment_method_select.options[payment_method_select.selectedIndex]
                .text;
        document.querySelector(".js-selectPayment_text").textContent =
            payment_method_select_text
                ? payment_method_select_text
                : "選択してください";
    }
};
