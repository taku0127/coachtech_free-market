window.onload = function () {
    inputSession();
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
    document.querySelector("form")?.addEventListener("submit", () => {
        sessionStorage.removeItem(storageKey);
    });
}
