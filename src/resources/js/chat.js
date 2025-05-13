window.onload = function () {
    // メッセージの保存
    inputSession();
    // 画像名表示
    outputImgName();
    // モーダル
    modal();
    // レビュー用スター制御
    reviewStar();
};

function reviewStar() {
    // 要素取得
    let stars = document.querySelector(".js-reviewStars").children;
    stars = [...stars];
    const input = document.querySelector(".js-reviewInput");
    stars.forEach((star) => {
        // クリックしたら
        star.addEventListener("click", () => {
            // データ取得
            const value = parseInt(star.getAttribute("data-review"));
            // それ以前の物も色を変える
            stars.forEach((star, index) => {
                const img = star.querySelector("img");
                if (index < value) {
                    img.src = img.src.replace("_nonactive", "_active");
                } else {
                    img.src = img.src.replace("_active", "_nonactive");
                }
            });
            // valueに反映する。
            input.value = value;
        });
    });
}

function modal() {
    // データ取得
    const modalBtn = document.querySelector(".js-modalStart");
    const modalMain = document.querySelector(".js-modalMain");
    // クリックしたらモーダル出力
    if (modalBtn) {
        modalBtn.addEventListener("click", () => {
            modalMain.classList.add("is-active");
        });
    }
}

function inputSession() {
    // パス名を取得
    const path = window.location.pathname; // "/chat/123"
    const productId = path.split("/").pop(); // "123"
    const storageKey = `chatDraft-${productId}`;

    const input = document.querySelector(".js-chatImput");
    // パスごとにセッションを保存
    if (input) {
        input.addEventListener("input", () => {
            sessionStorage.setItem(storageKey, input.value);
        });
    }
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
