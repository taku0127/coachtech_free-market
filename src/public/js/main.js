/******/ (() => { // webpackBootstrap
/*!******************************!*\
  !*** ./resources/js/main.js ***!
  \******************************/
function _slicedToArray(r, e) { return _arrayWithHoles(r) || _iterableToArrayLimit(r, e) || _unsupportedIterableToArray(r, e) || _nonIterableRest(); }
function _nonIterableRest() { throw new TypeError("Invalid attempt to destructure non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); }
function _unsupportedIterableToArray(r, a) { if (r) { if ("string" == typeof r) return _arrayLikeToArray(r, a); var t = {}.toString.call(r).slice(8, -1); return "Object" === t && r.constructor && (t = r.constructor.name), "Map" === t || "Set" === t ? Array.from(r) : "Arguments" === t || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(t) ? _arrayLikeToArray(r, a) : void 0; } }
function _arrayLikeToArray(r, a) { (null == a || a > r.length) && (a = r.length); for (var e = 0, n = Array(a); e < a; e++) n[e] = r[e]; return n; }
function _iterableToArrayLimit(r, l) { var t = null == r ? null : "undefined" != typeof Symbol && r[Symbol.iterator] || r["@@iterator"]; if (null != t) { var e, n, i, u, a = [], f = !0, o = !1; try { if (i = (t = t.call(r)).next, 0 === l) { if (Object(t) !== t) return; f = !1; } else for (; !(f = (e = i.call(t)).done) && (a.push(e.value), a.length !== l); f = !0); } catch (r) { o = !0, n = r; } finally { try { if (!f && null != t["return"] && (u = t["return"](), Object(u) !== u)) return; } finally { if (o) throw n; } } return a; } }
function _arrayWithHoles(r) { if (Array.isArray(r)) return r; }
window.onload = function () {
  var _document$querySelect;
  var input = document.querySelector(".js-input_img");
  var preview = document.querySelector(".js-preview");
  var preview_background = document.querySelector(".js-preview-background");
  input === null || input === void 0 || input.addEventListener("change", function (event) {
    // <1>
    var _event$target$files = _slicedToArray(event.target.files, 1),
      file = _event$target$files[0];
    if (preview) {
      if (file) {
        preview.setAttribute("src", URL.createObjectURL(file));
      } else {
        preview.setAttribute("src", "../img/dummy.png");
      }
    } else if (preview_background) {
      preview_background.style.background = "url(".concat(URL.createObjectURL(file), ") center center / contain no-repeat");
    }
  });
  changePaymentText();
  (_document$querySelect = document.querySelector(".js-selectPayment")) === null || _document$querySelect === void 0 || _document$querySelect.addEventListener("change", changePaymentText);
  function changePaymentText() {
    console.log("changePaymentText");
    var paymentMethod = document.querySelector(".js-selectPayment").value;
    document.querySelector(".js-selectPayment_text").textContent = paymentMethod ? paymentMethod : "選択してください";
  }
};
/******/ })()
;