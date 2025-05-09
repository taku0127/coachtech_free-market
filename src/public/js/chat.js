/******/ (() => { // webpackBootstrap
/*!******************************!*\
  !*** ./resources/js/chat.js ***!
  \******************************/
window.onload = function () {
  // メッセージの保存
  inputSession();
  // 画像名表示
  outputImgName();
};
function inputSession() {
  var _document$querySelect;
  // パス名を取得
  var path = window.location.pathname; // "/chat/123"
  var productId = path.split("/").pop(); // "123"
  var storageKey = "chatDraft-".concat(productId);
  var input = document.querySelector(".js-chatImput");
  // パスごとにセッションを保存
  input.addEventListener("input", function () {
    sessionStorage.setItem(storageKey, input.value);
  });
  // セッションを出力
  var saved = sessionStorage.getItem(storageKey);
  if (saved) {
    input.value = saved;
  }

  // 送信時に削除
  (_document$querySelect = document.querySelector(".js-sendMessage")) === null || _document$querySelect === void 0 || _document$querySelect.addEventListener("submit", function () {
    sessionStorage.removeItem(storageKey);
  });
}
function outputImgName() {
  var input = document.querySelector(".js-file");
  var output = document.querySelector(".js-fileName");
  // 画像名取得
  input.addEventListener("change", function () {
    // 出力
    output.textContent = "画像名:" + input.files[0].name;
  });
}
/******/ })()
;