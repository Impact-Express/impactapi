/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "/";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 2);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/apiuser.profile.js":
/*!*****************************************!*\
  !*** ./resources/js/apiuser.profile.js ***!
  \*****************************************/
/*! no static exports found */
/***/ (function(module, exports) {

$(document).ready(function () {
  $("#grid").kendoGrid({
    pageable: {
      pageSize: 10,
      numeric: true,
      responsive: false
    },
    sortable: true,
    filterable: true,
    columnMenu: true,
    resizable: true
  });
});
var nameModal = document.querySelector("#nameFormModal");
var nameBtn = document.querySelector("#nameModalBtn");
var nameSpan = document.querySelector(".nameModalClose");

nameBtn.onclick = function () {
  nameModal.style.display = "block";
};

nameSpan.onclick = function () {
  nameModal.style.display = "none";
};

var userNameModal = document.querySelector("#userNameFormModal");
var userNameBtn = document.querySelector("#userNameModalBtn");
var userNameSpan = document.querySelector(".userNameModalClose");

userNameBtn.onclick = function () {
  userNameModal.style.display = "block";
};

userNameSpan.onclick = function () {
  userNameModal.style.display = "none";
};

var accountnumberModal = document.querySelector("#accountnumberFormModal");
var accountnumberBtn = document.querySelector("#accountnumberModalBtn");
var accountnumberSpan = document.querySelector(".accountnumberModalClose");

accountnumberBtn.onclick = function () {
  accountnumberModal.style.display = "block";
};

accountnumberSpan.onclick = function () {
  accountnumberModal.style.display = "none";
};

var tokenModal = document.querySelector("#tokenModal");
var tokenBtn = document.querySelector("#tokenBtn");
var tokenSpan = document.querySelector(".tokenClose");

tokenBtn.onclick = function () {
  tokenModal.style.display = "block";
};

tokenSpan.onclick = function () {
  tokenModal.style.display = "none";
};

var newTokenModal = document.querySelector("#newTokenModal");
var newTokenBtn = document.querySelector("#newTokenBtn");
var newTokenSpan = document.querySelector(".newTokenClose");

newTokenBtn.onclick = function () {
  newTokenModal.style.display = "block";
};

newTokenSpan.onclick = function () {
  newTokenModal.style.display = "none";
};

var tokenRefresh = document.querySelector('#tokenRefresh');

tokenRefresh.onclick = function (e) {
  e.preventDefault(); // generate new token
};

var deleteModal = document.querySelector('#deleteModal');
var userDeleteBtn = document.querySelector('#userDeleteBtn');
var deleteModalClose = document.querySelector('.deleteModalClose');

userDeleteBtn.onclick = function () {
  deleteModal.style.display = "block";
};

deleteModalClose.onclick = function () {
  deleteModal.style.display = "none";
};

/***/ }),

/***/ 2:
/*!***********************************************!*\
  !*** multi ./resources/js/apiuser.profile.js ***!
  \***********************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! /var/www/impactapi/resources/js/apiuser.profile.js */"./resources/js/apiuser.profile.js");


/***/ })

/******/ });