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
/******/ 	__webpack_require__.p = "";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = "./theme/src/js/blocks/testimonial-card.js");
/******/ })
/************************************************************************/
/******/ ({

/***/ "./theme/src/js/blocks/icons.js":
/*!**************************************!*\
  !*** ./theme/src/js/blocks/icons.js ***!
  \**************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
var theme_icons = {};

//branded FR icons
theme_icons.friendlyrobot = /*#__PURE__*/React.createElement("svg", {
  version: "1.1",
  id: "Layer_1",
  x: "0px",
  y: "0px",
  viewBox: "0 0 61.2 61.1"
}, /*#__PURE__*/React.createElement("g", {
  id: "head"
}, /*#__PURE__*/React.createElement("g", null, /*#__PURE__*/React.createElement("path", {
  d: "M99.9,283.4c2.8,0.2,7.3,0.5,11.7,0.8c0,0.4,0,0.9,0,1.3c-43.6,2.6-87.2,1.5-130.8,0.3c0-0.5,0-1,0-1.5c3.3-0.2,6.7-0.4,10-0.5c0-0.2,0-0.4,0-0.6c-2.2-0.1-4.5-0.2-6.7-0.3c0-0.1,0-0.2,0-0.3c3.2-0.3,6.3-0.7,9.4-1c3.3-9.5,3.4-9.5,13.6-9.6c4,0,8.3,1,10.5-3.9c-2-1.3-3.8-2.6-6.1-4.1c-1.1,0.9-2.6,2.1-4.1,3.2c-0.3-0.2-0.5-0.5-0.8-0.7C8,264.7,9.4,263,11,261c-1.6-3.1-3.3-6.3-5.2-9.8c2.1-1.2,3.9-2.3,6-3.5c-4.6-8-9.1-15.9-13.7-23.9c-1.2,0.8-2.1,1.4-2.4,1.6c-2.3-3-4.4-5.5-6.2-8.3c-0.9-1.5-2-3.5-1.7-5c1.3-5.8,3.2-11.5,5-17.4c3.5,0.2,6.8,0.4,10.9,0.6c3-5.9,6.5-12.4,9.7-19.2c0.5-1-0.1-2.8-0.6-3.9c-2.8-6-1.5-12.3,3.4-15.6c4.7-3.2,10.2-1.8,15.3,2.6c2,1.7,5.8,1.5,10.1,2.4c-1-4-1.6-6.3-2.3-9.3c0.2-0.2,1-1,1.9-1.8c-0.1-0.4-0.2-0.7-0.2-1.1c-2.8,0.3-5.6,0.5-8.3,0.8c-3.1-7.9-3.5-8.1-11.9-6.6c-2.6,0.5-5.2,0.8-8.3,1.2c-1.1-20.5-2.2-40.4-3.4-61.7c-1.8,1.8-3.1,2.6-3.8,3.8C1.1,93.5-6,94.5-11.5,89.1c-0.9-0.8-2.3-2.1-3-1.8c-6.4,2.2-13.6,3.7-18.9,7.6c-3.5,2.6-7,4.3-10.7,6.2c-2.5,1.3-4.4,0.9-6.1-1.3c-0.5-0.6-1.3-1.1-1.8-1.7c-5.2-7.6-11.7-7.3-18.9-3.4c-1.9,1-4,1.6-4.9,1.9c-5.2,7.1-3.6,16.4-11,21.4c0.8-4.3,4.1-8.1,0.9-12.6c-9.3,2.6-11.2,9.4-10.8,17.8c-0.6-1.3-1.2-2.5-1.7-3.8c-0.4,0.5-0.9,1.1-1.5,1.9c-2.5-7-1-13.5,3.7-17.8c1.3-1.2,1.9-3.1,2.8-4.7c-0.5-0.6-1.1-1.1-1.6-1.7c3.4-1.2,8.8-1.4,9.9-3.7c2.2-4.4,6.1-4.5,9.4-5.8c5.3-1.9,10.9-2.9,16.4-4.5c4-1.2,7.9-2.5,11.8-4c2.5-1,4.7-1.4,6.5,1.2c5.1,7.5,11.3,8,19,3.8c3.4-1.9,6.5-3.4,8.1-7.1c4-9.1,13.1-9.9,19.1-1.8c0.4,0.6,1.1,1,1.6,1.4c0.5-0.2,0.9-0.3,0.9-0.5c1.4-8,1.4-8,9.7-9.1c5.9-0.8,11.8-1.7,17.7-2.5c-0.9-5.2-1.8-10.1-2.7-15.6c-8,1.6-16.2,3.3-25.3,5.1C4.9,43.5,2.7,32.9,0.4,21.7C11,19,20.9,16.5,30.8,13.9c-3.4-7.3-13.5-10-20.5-5.8C9.2,8.8,7.5,8.5,6.1,8.7C6,7.5,5.9,6.3,5.8,5.1c1.4,0,2.9,0,4.3,0c1.2,0,2.5,0.4,3.7,0.2c7.5-1.1,13.8,0.3,18.6,6.8c0.7,0.9,2.9,1.4,4.1,1.1c4.1-1,7.3,0.4,10.6,2.6c2.3,1.5,5.2,2.1,7.8,3c0.5,0.2,1,0,1.5,0.2c2.7,1.1,4.7,12.5,2.3,14.6c-3,2.6-6.1,5.1-9.3,7.5c-2.8,2.1-5.8,3.9-9,6c1.3,4.5,2.9,10,4.5,15.7c9.5-1.5,19.5-3.1,29.9-4.7c0.2,2.6,0.4,4.9,0.6,7.6c1.1-1.7,1.8-3.3,2.9-4.6c2.9-3.5,8.3-4.6,12.3-2.6c4.5,2.2,7.4,7.7,5.6,12.6c-1.4,3.7-0.4,5.9,2.1,8.2c1.2,1.1,2.3,2.4,3.3,3.7c3.3,4.5,6.6,8.6,13.4,4.5c1.5,6.9,2.8,13,4.1,19.4c-5.1,1.4-4,5.4-3.5,8.6c1.1,7.4,2.6,14.7,4,22.1c0.5-0.2,0.9-0.4,1.4-0.7c1.2,1.9,3,3.8,3.5,5.9c1.3,5.4,2.1,11,3.1,16.7c-2.5,0.7-4.5,1.3-7,2.1c4.6,4,6.3,8.2,3.1,13.5c-0.3,0.5-0.1,1.3-0.1,1.9c0.1,5.5,0.3,11,0.5,16.5c-0.8,0.1-1.6,0.2-2.4,0.3c-0.9-4.3-2.1-8.6-2.6-13c-0.4-3.1-1.2-4.7-4.8-4c0.2,4.5,0.5,9,0.7,13.4c-0.5,0.1-1,0.1-1.5,0.2c-0.7-2.9-1.5-5.7-1.9-8.6c-0.4-2.4,0.2-5.2-0.8-7.3c-2.5-5.3-0.6-8.9,2.9-11.9c-0.8-2.1-1.8-3.9-2.2-5.8c-0.8-4.1-1.3-8.2-2-12.3c-0.6-3.1-0.6-5.7,3.8-6c-1.4-8.1-2.6-16-4.3-23.8c-0.3-1.2-2.8-2.8-4.2-2.7c-3,0.3-3.9-1-4.5-3.4c-0.8-3.4-1.9-6.8-2.4-10.2c-0.3-2,0.5-4.1,0.8-6.1c0.6-0.1,1.2-0.2,1.8-0.2c-4.2-4.7-8.3-9.3-13.4-15c0,3,0,4.7,0,6.7c-3.6-2.9-6.8-5.4-9.7-7.7c0,18.9-0.1,37.7,0.1,56.5c0,3.8-0.8,5.5-4.8,5.6c-3,0.1-5.9,0.8-8.9,1.2c-4.8,0.7-8.8,2.1-7.6,8.3c-2.5,0.6-4.6,1.2-7.7,2c2,1.1,3.2,1.9,5.4,3.1c-2.1,0.9-3.5,1.5-5.2,2.3c0.3,1.4,0.6,2.9,0.9,4.4c11.8-1,18.5,5.6,15.6,15.5c-0.7,2.5-2.6,5.7-4.7,6.6c-4.2,1.8-4.7,5.4-6.6,8.7c-5.8,10.3-5.5,18.8,5.8,24.9c0.4,0.2,0.6,0.8,1,1.4c-1.3,2.4-2.7,4.8-4.8,8.5c7.5,7.5,15.2,15.2,23.1,23.2c1.4-1.1,2.8-2.2,4.7-3.8c5.3,4.2,10.7,8.5,16.4,13.1c-2.5,2.7-4.5,5.1-6.8,7.2c-2.8,2.6-1.4,4.8,0.1,7.3C95.5,275.4,97.2,278.7,99.9,283.4z M41,167.2c-2.7,1.4-5.5,1.8-5.8,3c-2.2,7.5-7.1,8.9-14,6.9c-4.5,8.2-8.8,16.2-13.2,24.3c1.7,1.3,3.1,2.4,4.6,3.6c-2.2,5.3-4.4,10.3-6.3,15.5c-0.5,1.3-0.6,3.3,0,4.5c3.5,6.8,7.4,13.4,11.1,20.1c2-0.6,3.6-1.1,5.4-1.7c2.8,5.2,5.5,10.2,8.6,15.9c-1.8,1.5-3.9,2.9-5.5,4.8c-1.8,2.2-3.1,4.6,0,7.4c1.8,1.6,2.1,4.7,3.4,6.9c0.7,1.2,2,2.7,3.1,2.7c10.1,0.2,20.3,0.1,30.3,0.1c2.8-7.9,3.7-8.5,11.7-8.5c2.5,0,5,0.2,7.5-0.1c1.4-0.1,2.7-1,4.1-1.6c-8-0.7-9.6-7.9-13.2-11.6c0.5-3,1.2-6.7-0.4-8.4c-5.2-5.8-11.1-11.1-16.9-16.3c-1-0.9-2.9-0.7-4.4-1c-0.4,0.7-0.7,1.3-1.1,2c4.3,4.5,8.7,9,13,13.5c-4.9-6.3-12.9-9.6-15.6-17.8c-1.6-0.7-3.8-1-5.3-2.3c-3.1-2.7-6.1-5.7-8.7-9c-1-1.2-1.3-3.7-0.8-5.2c1.7-4.6,4.8-8.3,7.8-12.2c4-5.4,5.4-12.7,8-19.5C42.2,180.3,40.5,175,41,167.2z M20.8,21.5c-1.7,2.6-3.5,4.2-3.4,5.6c0.2,1.4,2.2,2.6,3.5,3.9c1.4-1.4,3.5-2.6,3.8-4.3C25,25.6,22.8,24,20.8,21.5z"
}))));
//generic utility icons
theme_icons.hamburger = /*#__PURE__*/React.createElement("svg", {
  width: "100%",
  height: "auto",
  viewBox: "0 0 62 37",
  fill: "none",
  xmlns: "http://www.w3.org/2000/svg"
}, /*#__PURE__*/React.createElement("line", {
  x1: "3",
  y1: "3",
  x2: "59",
  y2: "3.00001",
  stroke: "white",
  "stroke-width": "6",
  "stroke-linecap": "round"
}), /*#__PURE__*/React.createElement("line", {
  x1: "3",
  y1: "18",
  x2: "59",
  y2: "18",
  stroke: "white",
  "stroke-width": "6",
  "stroke-linecap": "round"
}), /*#__PURE__*/React.createElement("line", {
  x1: "3",
  y1: "34",
  x2: "59",
  y2: "34",
  stroke: "white",
  "stroke-width": "6",
  "stroke-linecap": "round"
}));
theme_icons.email = /*#__PURE__*/React.createElement("svg", {
  xmlns: "http://www.w3.org/2000/svg",
  viewBox: "0 0 512 512"
}, /*#__PURE__*/React.createElement("path", {
  d: "M256 352c-16.53 0-33.06-5.422-47.16-16.41L0 173.2V400C0 426.5 21.49 448 48 448h416c26.51 0 48-21.49 48-48V173.2l-208.8 162.5C289.1 346.6 272.5 352 256 352zM16.29 145.3l212.2 165.1c16.19 12.6 38.87 12.6 55.06 0l212.2-165.1C505.1 137.3 512 125 512 112C512 85.49 490.5 64 464 64h-416C21.49 64 0 85.49 0 112C0 125 6.01 137.3 16.29 145.3z"
}));
theme_icons.phone = /*#__PURE__*/React.createElement("svg", {
  xmlns: "http://www.w3.org/2000/svg",
  viewBox: "0 0 512 512",
  fill: "currentColor"
}, /*#__PURE__*/React.createElement("path", {
  d: "M511.2 387l-23.25 100.8c-3.266 14.25-15.79 24.22-30.46 24.22C205.2 512 0 306.8 0 54.5c0-14.66 9.969-27.2 24.22-30.45l100.8-23.25C139.7-2.602 154.7 5.018 160.8 18.92l46.52 108.5c5.438 12.78 1.77 27.67-8.98 36.45L144.5 207.1c33.98 69.22 90.26 125.5 159.5 159.5l44.08-53.8c8.688-10.78 23.69-14.51 36.47-8.975l108.5 46.51C506.1 357.2 514.6 372.4 511.2 387z"
}));
//social media icons
theme_icons.facebook = /*#__PURE__*/React.createElement("svg", {
  xmlns: "http://www.w3.org/2000/svg",
  viewBox: "0 0 512 512",
  fill: "currentColor"
}, /*#__PURE__*/React.createElement("path", {
  d: "M504 256C504 119 393 8 256 8S8 119 8 256c0 123.78 90.69 226.38 209.25 245V327.69h-63V256h63v-54.64c0-62.15 37-96.48 93.67-96.48 27.14 0 55.52 4.84 55.52 4.84v61h-31.28c-30.8 0-40.41 19.12-40.41 38.73V256h68.78l-11 71.69h-57.78V501C413.31 482.38 504 379.78 504 256z"
}));
theme_icons.twitter = /*#__PURE__*/React.createElement("svg", {
  xmlns: "http://www.w3.org/2000/svg",
  viewBox: "0 0 512 512",
  fill: "currentColor"
}, /*#__PURE__*/React.createElement("path", {
  d: "M459.37 151.716c.325 4.548.325 9.097.325 13.645 0 138.72-105.583 298.558-298.558 298.558-59.452 0-114.68-17.219-161.137-47.106 8.447.974 16.568 1.299 25.34 1.299 49.055 0 94.213-16.568 130.274-44.832-46.132-.975-84.792-31.188-98.112-72.772 6.498.974 12.995 1.624 19.818 1.624 9.421 0 18.843-1.3 27.614-3.573-48.081-9.747-84.143-51.98-84.143-102.985v-1.299c13.969 7.797 30.214 12.67 47.431 13.319-28.264-18.843-46.781-51.005-46.781-87.391 0-19.492 5.197-37.36 14.294-52.954 51.655 63.675 129.3 105.258 216.365 109.807-1.624-7.797-2.599-15.918-2.599-24.04 0-57.828 46.782-104.934 104.934-104.934 30.213 0 57.502 12.67 76.67 33.137 23.715-4.548 46.456-13.32 66.599-25.34-7.798 24.366-24.366 44.833-46.132 57.827 21.117-2.273 41.584-8.122 60.426-16.243-14.292 20.791-32.161 39.308-52.628 54.253z"
}));
theme_icons.linkedin = /*#__PURE__*/React.createElement("svg", {
  xmlns: "http://www.w3.org/2000/svg",
  viewBox: "0 0 448 512",
  fill: "currentColor"
}, /*#__PURE__*/React.createElement("path", {
  d: "M416 32H31.9C14.3 32 0 46.5 0 64.3v383.4C0 465.5 14.3 480 31.9 480H416c17.6 0 32-14.5 32-32.3V64.3c0-17.8-14.4-32.3-32-32.3zM135.4 416H69V202.2h66.5V416zm-33.2-243c-21.3 0-38.5-17.3-38.5-38.5S80.9 96 102.2 96c21.2 0 38.5 17.3 38.5 38.5 0 21.3-17.2 38.5-38.5 38.5zm282.1 243h-66.4V312c0-24.8-.5-56.7-34.5-56.7-34.6 0-39.9 27-39.9 54.9V416h-66.4V202.2h63.7v29.2h.9c8.9-16.8 30.6-34.5 62.9-34.5 67.2 0 79.7 44.3 79.7 101.9V416z"
}));
theme_icons.instagram = /*#__PURE__*/React.createElement("svg", {
  xmlns: "http://www.w3.org/2000/svg",
  viewBox: "0 0 448 512",
  fill: "currentColor"
}, /*#__PURE__*/React.createElement("path", {
  d: "M224.1 141c-63.6 0-114.9 51.3-114.9 114.9s51.3 114.9 114.9 114.9S339 319.5 339 255.9 287.7 141 224.1 141zm0 189.6c-41.1 0-74.7-33.5-74.7-74.7s33.5-74.7 74.7-74.7 74.7 33.5 74.7 74.7-33.6 74.7-74.7 74.7zm146.4-194.3c0 14.9-12 26.8-26.8 26.8-14.9 0-26.8-12-26.8-26.8s12-26.8 26.8-26.8 26.8 12 26.8 26.8zm76.1 27.2c-1.7-35.9-9.9-67.7-36.2-93.9-26.2-26.2-58-34.4-93.9-36.2-37-2.1-147.9-2.1-184.9 0-35.8 1.7-67.6 9.9-93.9 36.1s-34.4 58-36.2 93.9c-2.1 37-2.1 147.9 0 184.9 1.7 35.9 9.9 67.7 36.2 93.9s58 34.4 93.9 36.2c37 2.1 147.9 2.1 184.9 0 35.9-1.7 67.7-9.9 93.9-36.2 26.2-26.2 34.4-58 36.2-93.9 2.1-37 2.1-147.8 0-184.8zM398.8 388c-7.8 19.6-22.9 34.7-42.6 42.6-29.5 11.7-99.5 9-132.1 9s-102.7 2.6-132.1-9c-19.6-7.8-34.7-22.9-42.6-42.6-11.7-29.5-9-99.5-9-132.1s-2.6-102.7 9-132.1c7.8-19.6 22.9-34.7 42.6-42.6 29.5-11.7 99.5-9 132.1-9s102.7-2.6 132.1 9c19.6 7.8 34.7 22.9 42.6 42.6 11.7 29.5 9 99.5 9 132.1s2.7 102.7-9 132.1z"
}));
/* harmony default export */ __webpack_exports__["default"] = (theme_icons);

/***/ }),

/***/ "./theme/src/js/blocks/testimonial-card.js":
/*!*************************************************!*\
  !*** ./theme/src/js/blocks/testimonial-card.js ***!
  \*************************************************/
/*! no exports provided */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _icons_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./icons.js */ "./theme/src/js/blocks/icons.js");

var __ = wp.i18n.__;
var registerBlockType = wp.blocks.registerBlockType;
var _wp$blockEditor = wp.blockEditor,
  MediaUpload = _wp$blockEditor.MediaUpload,
  MediaUploadCheck = _wp$blockEditor.MediaUploadCheck,
  InspectorControls = _wp$blockEditor.InspectorControls,
  RichText = _wp$blockEditor.RichText;
var _wp$components = wp.components,
  PanelBody = _wp$components.PanelBody,
  Button = _wp$components.Button,
  TextControl = _wp$components.TextControl;
registerBlockType('rbt/testimonial-card', {
  title: 'Testimonial Card',
  icon: _icons_js__WEBPACK_IMPORTED_MODULE_0__["default"].friendlyrobot,
  category: 'friendlyrobot',
  //attributes
  attributes: {
    image: {
      type: 'object',
      "default": {}
    },
    name: {
      type: 'string',
      "default": ''
    },
    quote: {
      type: 'string',
      "default": ''
    },
    trip: {
      type: 'string',
      "default": ''
    },
    tripurl: {
      type: 'string',
      "default": ''
    }
  },
  edit: function edit(_ref) {
    var attributes = _ref.attributes,
      setAttributes = _ref.setAttributes;
    var image = attributes.image,
      name = attributes.name,
      quote = attributes.quote,
      trip = attributes.trip,
      tripurl = attributes.tripurl;
    function onSelectMedia(media) {
      setAttributes({
        image: media
      });
    }
    function onTextChange(newtext) {
      setAttributes({
        quote: newtext
      });
    }
    function onNameChange(newtext) {
      setAttributes({
        name: newtext
      });
    }
    function onTripChange(newtrip) {
      setAttributes({
        trip: newtrip
      });
    }
    function onTripUrlChange(newurl) {
      setAttributes({
        tripurl: newurl
      });
    }
    function renderAvatarImage(array, img) {
      var rows = [];
      Object.keys(img.sizes).forEach(function (key, idx) {
        if (array.includes(key)) {
          rows.push(img.sizes[key].url + ' ' + img.sizes[key].width + 'w');
        }
      });
      return rows;
    }
    return [/*#__PURE__*/React.createElement(InspectorControls, null, /*#__PURE__*/React.createElement(PanelBody, {
      title: "Author Image"
    }, /*#__PURE__*/React.createElement(MediaUploadCheck, null, /*#__PURE__*/React.createElement("p", null, /*#__PURE__*/React.createElement("strong", null, "Upload Avatar(small)")), /*#__PURE__*/React.createElement(MediaUpload, {
      label: "Image",
      onSelect: function onSelect(media) {
        return onSelectMedia(media);
      },
      allowedTypes: ['image'],
      accept: ["image/*", "image/svg"],
      value: image.id,
      render: function render(_ref2) {
        var open = _ref2.open;
        return /*#__PURE__*/React.createElement(React.Fragment, null, /*#__PURE__*/React.createElement(Button, {
          isPrimary: true,
          onClick: function onClick(event) {
            event.stopPropagation();
            open();
          }
        }, image.id > 0 ? 'Edit Image' : 'Upload Image'));
      }
    }), /*#__PURE__*/React.createElement("p", null, /*#__PURE__*/React.createElement("strong", null, "Upload Trip Image")))), ","), /*#__PURE__*/React.createElement("div", {
      className: "rbt-testimonial-card"
    }, /*#__PURE__*/React.createElement("div", {
      className: "rbt-avatar-wrap"
    }, image.id ? /*#__PURE__*/React.createElement("img", {
      className: "rbt-avatar",
      key: image.id,
      loading: "lazy",
      src: image.sizes.hasOwnProperty("thumbnail") ? image.sizes.thumbnail.url : image.src,
      srcset: renderAvatarImage(['thumbnail', 'medium'], image),
      alt: name ? name + ' image' : 'avatar image'
    }) : /*#__PURE__*/React.createElement("img", {
      className: "rbt-avatar",
      src: theme_admin.theme_root ? theme_admin.theme_root + "/theme/assets/icons/user-solid.svg" : false
    })), /*#__PURE__*/React.createElement("div", {
      className: "rbt-testimonial-text"
    }, /*#__PURE__*/React.createElement(RichText, {
      tagName: "div",
      className: "rbt-testimonial",
      value: quote,
      onChange: onTextChange,
      placeholder: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.'
    }), /*#__PURE__*/React.createElement(RichText, {
      tagName: "h5",
      className: "rbt-author",
      value: name,
      onChange: onNameChange,
      placeholder: 'Testimonial Author'
    }), /*#__PURE__*/React.createElement(TextControl, {
      tagName: "span",
      label: "Trip Name",
      className: "rbt-trip",
      value: trip,
      onChange: onTripChange,
      placeholder: "Trip Name (optional)"
    }), /*#__PURE__*/React.createElement(TextControl, {
      label: "Trip Slug",
      tagName: "span",
      className: "rbt-trip-slug",
      value: tripurl,
      onChange: onTripUrlChange,
      placeholder: "trip-slug"
    })))];
  },
  save: function save(_ref3) {
    var attributes = _ref3.attributes;
    var image = attributes.image,
      name = attributes.name,
      quote = attributes.quote,
      trip = attributes.trip,
      tripurl = attributes.tripurl;
    function renderTrip() {
      if (trip && trip.length && tripurl && tripurl.length) {
        //we have everything
        var base_url = theme_admin.siteurl ? theme_admin.siteurl : false;
        if (!base_url) return /*#__PURE__*/React.createElement("span", {
          className: "rbt-trip"
        }, trip);
        return /*#__PURE__*/React.createElement("a", {
          href: base_url + "/trips/" + tripurl,
          target: "_blank"
        }, trip);
      }
      return trip ? /*#__PURE__*/React.createElement("span", {
        className: "rbt-trip"
      }, trip) : '';
    }
    function renderAvatarImage(array, img) {
      var rows = [];
      Object.keys(img.sizes).forEach(function (key, idx) {
        if (array.includes(key)) {
          rows.push(img.sizes[key].url + ' ' + img.sizes[key].width + 'w');
        }
      });
      return rows;
    }
    return /*#__PURE__*/React.createElement("div", {
      className: "rbt-testimonial-card"
    }, /*#__PURE__*/React.createElement("div", {
      className: "rbt-avatar-wrap"
    }, image.id ? /*#__PURE__*/React.createElement("img", {
      className: "rbt-avatar",
      key: image.id,
      loading: "lazy",
      src: image.sizes.hasOwnProperty("thumbnail") ? image.sizes.thumbnail.url : image.src,
      srcset: renderAvatarImage(['thumbnail', 'medium'], image),
      alt: name ? name + ' image' : 'avatar image'
    }) : /*#__PURE__*/React.createElement("img", {
      className: "rbt-avatar",
      src: theme_admin.theme_root ? theme_admin.theme_root + "/theme/assets/icons/user-solid.svg" : false
    })), /*#__PURE__*/React.createElement("div", {
      className: "rbt-testimonial-text"
    }, /*#__PURE__*/React.createElement(RichText.Content, {
      tagName: "p",
      className: "rbt-testimonial",
      value: quote
    }), /*#__PURE__*/React.createElement(RichText.Content, {
      tagName: "h5",
      className: "rbt-author",
      value: name
    }), renderTrip()));
  }
});

/***/ })

/******/ });
//# sourceMappingURL=testimonial-card.js.map