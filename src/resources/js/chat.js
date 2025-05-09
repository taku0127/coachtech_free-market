window.onload = function () {
    // メッセージの保存
    inputSession();
    // 画像名表示
    outputImgName();
};

function inputSession() {
    // パス名を取得
    const path = window.location.pathname; // "/chat/123"
    const productId = path.split("/").pop(); // "123"
    const storageKey = `chatDraft-${productId}`;

    const input = document.querySelector(".js-chatImput");
    // パスごとにセッションを保存
    input.addEventListener("input", () => {
        sessionStorage.setItem(storageKey, input.value);
    });
    // セッションを出力
    const saved = sessionStorage.getItem(storageKey);
    if (saved) {
        input.value = saved;
    }

    // 送信時に削除
    document
        .querySelector(".js-sendMessage")
        ?.addEventListener("submit", () => {
            sessionStorage.removeItem(storageKey);
        });
}

function outputImgName() {
    const input = document.querySelector(".js-file");
    const output = document.querySelector(".js-fileName");
    // 画像名取得
    input.addEventListener("change", () => {
        // 出力
        output.textContent = "画像名:" + input.files[0].name;
    });
}
