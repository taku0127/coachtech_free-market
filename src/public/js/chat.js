/******/ (() => { // webpackBootstrap
/*!******************************!*\
  !*** ./resources/js/chat.js ***!
  \******************************/
function _toConsumableArray(r) { return _arrayWithoutHoles(r) || _iterableToArray(r) || _unsupportedIterableToArray(r) || _nonIterableSpread(); }
function _nonIterableSpread() { throw new TypeError("Invalid attempt to spread non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); }
function _unsupportedIterableToArray(r, a) { if (r) { if ("string" == typeof r) return _arrayLikeToArray(r, a); var t = {}.toString.call(r).slice(8, -1); return "Object" === t && r.constructor && (t = r.constructor.name), "Map" === t || "Set" === t ? Array.from(r) : "Arguments" === t || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(t) ? _arrayLikeToArray(r, a) : void 0; } }
function _iterableToArray(r) { if ("undefined" != typeof Symbol && null != r[Symbol.iterator] || null != r["@@iterator"]) return Array.from(r); }
function _arrayWithoutHoles(r) { if (Array.isArray(r)) return _arrayLikeToArray(r); }
function _arrayLikeToArray(r, a) { (null == a || a > r.length) && (a = r.length); for (var e = 0, n = Array(a); e < a; e++) n[e] = r[e]; return n; }
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
  var stars = document.querySelector(".js-reviewStars").children;
  stars = _toConsumableArray(stars);
  var input = document.querySelector(".js-reviewInput");
  stars.forEach(function (star) {
    // クリックしたら
    star.addEventListener("click", function () {
      // データ取得
      var value = parseInt(star.getAttribute("data-review"));
      // それ以前の物も色を変える
      stars.forEach(function (star, index) {
        var img = star.querySelector("img");
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
  var modalBtn = document.querySelector(".js-modalStart");
  var modalMain = document.querySelector(".js-modalMain");
  // クリックしたらモーダル出力
  if (modalBtn) {
    modalBtn.addEventListener("click", function () {
      modalMain.classList.add("is-active");
    });
  }
}
function inputSession() {
  var _document$querySelect;
  // パス名を取得
  var path = window.location.pathname; // "/chat/123"
  var productId = path.split("/").pop(); // "123"
  var storageKey = "chatDraft-".concat(productId);
  var input = document.querySelector(".js-chatImput");
  // パスごとにセッションを保存
  if (input) {
    input.addEventListener("input", function () {
      sessionStorage.setItem(storageKey, input.value);
    });
  }
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