/******/ (() => { // webpackBootstrap
/*!******************************!*\
  !*** ./resources/js/chat.js ***!
  \******************************/
window.onload = function () {
  inputSession();
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
  (_document$querySelect = document.querySelector("form")) === null || _document$querySelect === void 0 || _document$querySelect.addEventListener("submit", function () {
    sessionStorage.removeItem(storageKey);
  });
}
/******/ })()
;