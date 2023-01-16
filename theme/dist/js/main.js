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
/******/ 	return __webpack_require__(__webpack_require__.s = "./theme/src/js/head.js");
/******/ })
/************************************************************************/
/******/ ({

/***/ "./theme/src/js/frontend/global.js":
/*!*****************************************!*\
  !*** ./theme/src/js/frontend/global.js ***!
  \*****************************************/
/*! exports provided: doDismiss, mobileExpand, menuClick, doMenuClicks, doMobileMenuClick, accordionClick, doAccordionClicks, sendit */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "doDismiss", function() { return doDismiss; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "mobileExpand", function() { return mobileExpand; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "menuClick", function() { return menuClick; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "doMenuClicks", function() { return doMenuClicks; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "doMobileMenuClick", function() { return doMobileMenuClick; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "accordionClick", function() { return accordionClick; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "doAccordionClicks", function() { return doAccordionClicks; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "sendit", function() { return sendit; });
function _typeof(obj) { "@babel/helpers - typeof"; return _typeof = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function (obj) { return typeof obj; } : function (obj) { return obj && "function" == typeof Symbol && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : typeof obj; }, _typeof(obj); }
function _regeneratorRuntime() { "use strict"; /*! regenerator-runtime -- Copyright (c) 2014-present, Facebook, Inc. -- license (MIT): https://github.com/facebook/regenerator/blob/main/LICENSE */ _regeneratorRuntime = function _regeneratorRuntime() { return exports; }; var exports = {}, Op = Object.prototype, hasOwn = Op.hasOwnProperty, defineProperty = Object.defineProperty || function (obj, key, desc) { obj[key] = desc.value; }, $Symbol = "function" == typeof Symbol ? Symbol : {}, iteratorSymbol = $Symbol.iterator || "@@iterator", asyncIteratorSymbol = $Symbol.asyncIterator || "@@asyncIterator", toStringTagSymbol = $Symbol.toStringTag || "@@toStringTag"; function define(obj, key, value) { return Object.defineProperty(obj, key, { value: value, enumerable: !0, configurable: !0, writable: !0 }), obj[key]; } try { define({}, ""); } catch (err) { define = function define(obj, key, value) { return obj[key] = value; }; } function wrap(innerFn, outerFn, self, tryLocsList) { var protoGenerator = outerFn && outerFn.prototype instanceof Generator ? outerFn : Generator, generator = Object.create(protoGenerator.prototype), context = new Context(tryLocsList || []); return defineProperty(generator, "_invoke", { value: makeInvokeMethod(innerFn, self, context) }), generator; } function tryCatch(fn, obj, arg) { try { return { type: "normal", arg: fn.call(obj, arg) }; } catch (err) { return { type: "throw", arg: err }; } } exports.wrap = wrap; var ContinueSentinel = {}; function Generator() {} function GeneratorFunction() {} function GeneratorFunctionPrototype() {} var IteratorPrototype = {}; define(IteratorPrototype, iteratorSymbol, function () { return this; }); var getProto = Object.getPrototypeOf, NativeIteratorPrototype = getProto && getProto(getProto(values([]))); NativeIteratorPrototype && NativeIteratorPrototype !== Op && hasOwn.call(NativeIteratorPrototype, iteratorSymbol) && (IteratorPrototype = NativeIteratorPrototype); var Gp = GeneratorFunctionPrototype.prototype = Generator.prototype = Object.create(IteratorPrototype); function defineIteratorMethods(prototype) { ["next", "throw", "return"].forEach(function (method) { define(prototype, method, function (arg) { return this._invoke(method, arg); }); }); } function AsyncIterator(generator, PromiseImpl) { function invoke(method, arg, resolve, reject) { var record = tryCatch(generator[method], generator, arg); if ("throw" !== record.type) { var result = record.arg, value = result.value; return value && "object" == _typeof(value) && hasOwn.call(value, "__await") ? PromiseImpl.resolve(value.__await).then(function (value) { invoke("next", value, resolve, reject); }, function (err) { invoke("throw", err, resolve, reject); }) : PromiseImpl.resolve(value).then(function (unwrapped) { result.value = unwrapped, resolve(result); }, function (error) { return invoke("throw", error, resolve, reject); }); } reject(record.arg); } var previousPromise; defineProperty(this, "_invoke", { value: function value(method, arg) { function callInvokeWithMethodAndArg() { return new PromiseImpl(function (resolve, reject) { invoke(method, arg, resolve, reject); }); } return previousPromise = previousPromise ? previousPromise.then(callInvokeWithMethodAndArg, callInvokeWithMethodAndArg) : callInvokeWithMethodAndArg(); } }); } function makeInvokeMethod(innerFn, self, context) { var state = "suspendedStart"; return function (method, arg) { if ("executing" === state) throw new Error("Generator is already running"); if ("completed" === state) { if ("throw" === method) throw arg; return doneResult(); } for (context.method = method, context.arg = arg;;) { var delegate = context.delegate; if (delegate) { var delegateResult = maybeInvokeDelegate(delegate, context); if (delegateResult) { if (delegateResult === ContinueSentinel) continue; return delegateResult; } } if ("next" === context.method) context.sent = context._sent = context.arg;else if ("throw" === context.method) { if ("suspendedStart" === state) throw state = "completed", context.arg; context.dispatchException(context.arg); } else "return" === context.method && context.abrupt("return", context.arg); state = "executing"; var record = tryCatch(innerFn, self, context); if ("normal" === record.type) { if (state = context.done ? "completed" : "suspendedYield", record.arg === ContinueSentinel) continue; return { value: record.arg, done: context.done }; } "throw" === record.type && (state = "completed", context.method = "throw", context.arg = record.arg); } }; } function maybeInvokeDelegate(delegate, context) { var methodName = context.method, method = delegate.iterator[methodName]; if (undefined === method) return context.delegate = null, "throw" === methodName && delegate.iterator["return"] && (context.method = "return", context.arg = undefined, maybeInvokeDelegate(delegate, context), "throw" === context.method) || "return" !== methodName && (context.method = "throw", context.arg = new TypeError("The iterator does not provide a '" + methodName + "' method")), ContinueSentinel; var record = tryCatch(method, delegate.iterator, context.arg); if ("throw" === record.type) return context.method = "throw", context.arg = record.arg, context.delegate = null, ContinueSentinel; var info = record.arg; return info ? info.done ? (context[delegate.resultName] = info.value, context.next = delegate.nextLoc, "return" !== context.method && (context.method = "next", context.arg = undefined), context.delegate = null, ContinueSentinel) : info : (context.method = "throw", context.arg = new TypeError("iterator result is not an object"), context.delegate = null, ContinueSentinel); } function pushTryEntry(locs) { var entry = { tryLoc: locs[0] }; 1 in locs && (entry.catchLoc = locs[1]), 2 in locs && (entry.finallyLoc = locs[2], entry.afterLoc = locs[3]), this.tryEntries.push(entry); } function resetTryEntry(entry) { var record = entry.completion || {}; record.type = "normal", delete record.arg, entry.completion = record; } function Context(tryLocsList) { this.tryEntries = [{ tryLoc: "root" }], tryLocsList.forEach(pushTryEntry, this), this.reset(!0); } function values(iterable) { if (iterable) { var iteratorMethod = iterable[iteratorSymbol]; if (iteratorMethod) return iteratorMethod.call(iterable); if ("function" == typeof iterable.next) return iterable; if (!isNaN(iterable.length)) { var i = -1, next = function next() { for (; ++i < iterable.length;) if (hasOwn.call(iterable, i)) return next.value = iterable[i], next.done = !1, next; return next.value = undefined, next.done = !0, next; }; return next.next = next; } } return { next: doneResult }; } function doneResult() { return { value: undefined, done: !0 }; } return GeneratorFunction.prototype = GeneratorFunctionPrototype, defineProperty(Gp, "constructor", { value: GeneratorFunctionPrototype, configurable: !0 }), defineProperty(GeneratorFunctionPrototype, "constructor", { value: GeneratorFunction, configurable: !0 }), GeneratorFunction.displayName = define(GeneratorFunctionPrototype, toStringTagSymbol, "GeneratorFunction"), exports.isGeneratorFunction = function (genFun) { var ctor = "function" == typeof genFun && genFun.constructor; return !!ctor && (ctor === GeneratorFunction || "GeneratorFunction" === (ctor.displayName || ctor.name)); }, exports.mark = function (genFun) { return Object.setPrototypeOf ? Object.setPrototypeOf(genFun, GeneratorFunctionPrototype) : (genFun.__proto__ = GeneratorFunctionPrototype, define(genFun, toStringTagSymbol, "GeneratorFunction")), genFun.prototype = Object.create(Gp), genFun; }, exports.awrap = function (arg) { return { __await: arg }; }, defineIteratorMethods(AsyncIterator.prototype), define(AsyncIterator.prototype, asyncIteratorSymbol, function () { return this; }), exports.AsyncIterator = AsyncIterator, exports.async = function (innerFn, outerFn, self, tryLocsList, PromiseImpl) { void 0 === PromiseImpl && (PromiseImpl = Promise); var iter = new AsyncIterator(wrap(innerFn, outerFn, self, tryLocsList), PromiseImpl); return exports.isGeneratorFunction(outerFn) ? iter : iter.next().then(function (result) { return result.done ? result.value : iter.next(); }); }, defineIteratorMethods(Gp), define(Gp, toStringTagSymbol, "Generator"), define(Gp, iteratorSymbol, function () { return this; }), define(Gp, "toString", function () { return "[object Generator]"; }), exports.keys = function (val) { var object = Object(val), keys = []; for (var key in object) keys.push(key); return keys.reverse(), function next() { for (; keys.length;) { var key = keys.pop(); if (key in object) return next.value = key, next.done = !1, next; } return next.done = !0, next; }; }, exports.values = values, Context.prototype = { constructor: Context, reset: function reset(skipTempReset) { if (this.prev = 0, this.next = 0, this.sent = this._sent = undefined, this.done = !1, this.delegate = null, this.method = "next", this.arg = undefined, this.tryEntries.forEach(resetTryEntry), !skipTempReset) for (var name in this) "t" === name.charAt(0) && hasOwn.call(this, name) && !isNaN(+name.slice(1)) && (this[name] = undefined); }, stop: function stop() { this.done = !0; var rootRecord = this.tryEntries[0].completion; if ("throw" === rootRecord.type) throw rootRecord.arg; return this.rval; }, dispatchException: function dispatchException(exception) { if (this.done) throw exception; var context = this; function handle(loc, caught) { return record.type = "throw", record.arg = exception, context.next = loc, caught && (context.method = "next", context.arg = undefined), !!caught; } for (var i = this.tryEntries.length - 1; i >= 0; --i) { var entry = this.tryEntries[i], record = entry.completion; if ("root" === entry.tryLoc) return handle("end"); if (entry.tryLoc <= this.prev) { var hasCatch = hasOwn.call(entry, "catchLoc"), hasFinally = hasOwn.call(entry, "finallyLoc"); if (hasCatch && hasFinally) { if (this.prev < entry.catchLoc) return handle(entry.catchLoc, !0); if (this.prev < entry.finallyLoc) return handle(entry.finallyLoc); } else if (hasCatch) { if (this.prev < entry.catchLoc) return handle(entry.catchLoc, !0); } else { if (!hasFinally) throw new Error("try statement without catch or finally"); if (this.prev < entry.finallyLoc) return handle(entry.finallyLoc); } } } }, abrupt: function abrupt(type, arg) { for (var i = this.tryEntries.length - 1; i >= 0; --i) { var entry = this.tryEntries[i]; if (entry.tryLoc <= this.prev && hasOwn.call(entry, "finallyLoc") && this.prev < entry.finallyLoc) { var finallyEntry = entry; break; } } finallyEntry && ("break" === type || "continue" === type) && finallyEntry.tryLoc <= arg && arg <= finallyEntry.finallyLoc && (finallyEntry = null); var record = finallyEntry ? finallyEntry.completion : {}; return record.type = type, record.arg = arg, finallyEntry ? (this.method = "next", this.next = finallyEntry.finallyLoc, ContinueSentinel) : this.complete(record); }, complete: function complete(record, afterLoc) { if ("throw" === record.type) throw record.arg; return "break" === record.type || "continue" === record.type ? this.next = record.arg : "return" === record.type ? (this.rval = this.arg = record.arg, this.method = "return", this.next = "end") : "normal" === record.type && afterLoc && (this.next = afterLoc), ContinueSentinel; }, finish: function finish(finallyLoc) { for (var i = this.tryEntries.length - 1; i >= 0; --i) { var entry = this.tryEntries[i]; if (entry.finallyLoc === finallyLoc) return this.complete(entry.completion, entry.afterLoc), resetTryEntry(entry), ContinueSentinel; } }, "catch": function _catch(tryLoc) { for (var i = this.tryEntries.length - 1; i >= 0; --i) { var entry = this.tryEntries[i]; if (entry.tryLoc === tryLoc) { var record = entry.completion; if ("throw" === record.type) { var thrown = record.arg; resetTryEntry(entry); } return thrown; } } throw new Error("illegal catch attempt"); }, delegateYield: function delegateYield(iterable, resultName, nextLoc) { return this.delegate = { iterator: values(iterable), resultName: resultName, nextLoc: nextLoc }, "next" === this.method && (this.arg = undefined), ContinueSentinel; } }, exports; }
function asyncGeneratorStep(gen, resolve, reject, _next, _throw, key, arg) { try { var info = gen[key](arg); var value = info.value; } catch (error) { reject(error); return; } if (info.done) { resolve(value); } else { Promise.resolve(value).then(_next, _throw); } }
function _asyncToGenerator(fn) { return function () { var self = this, args = arguments; return new Promise(function (resolve, reject) { var gen = fn.apply(self, args); function _next(value) { asyncGeneratorStep(gen, resolve, reject, _next, _throw, "next", value); } function _throw(err) { asyncGeneratorStep(gen, resolve, reject, _next, _throw, "throw", err); } _next(undefined); }); }; }
function _createForOfIteratorHelper(o, allowArrayLike) { var it = typeof Symbol !== "undefined" && o[Symbol.iterator] || o["@@iterator"]; if (!it) { if (Array.isArray(o) || (it = _unsupportedIterableToArray(o)) || allowArrayLike && o && typeof o.length === "number") { if (it) o = it; var i = 0; var F = function F() {}; return { s: F, n: function n() { if (i >= o.length) return { done: true }; return { done: false, value: o[i++] }; }, e: function e(_e) { throw _e; }, f: F }; } throw new TypeError("Invalid attempt to iterate non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); } var normalCompletion = true, didErr = false, err; return { s: function s() { it = it.call(o); }, n: function n() { var step = it.next(); normalCompletion = step.done; return step; }, e: function e(_e2) { didErr = true; err = _e2; }, f: function f() { try { if (!normalCompletion && it["return"] != null) it["return"](); } finally { if (didErr) throw err; } } }; }
function _unsupportedIterableToArray(o, minLen) { if (!o) return; if (typeof o === "string") return _arrayLikeToArray(o, minLen); var n = Object.prototype.toString.call(o).slice(8, -1); if (n === "Object" && o.constructor) n = o.constructor.name; if (n === "Map" || n === "Set") return Array.from(o); if (n === "Arguments" || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)) return _arrayLikeToArray(o, minLen); }
function _arrayLikeToArray(arr, len) { if (len == null || len > arr.length) len = arr.length; for (var i = 0, arr2 = new Array(len); i < len; i++) arr2[i] = arr[i]; return arr2; }
/* STILL NEED TO FINISH THESE */
var doDismiss = function doDismiss(event) {
  var dismissable = document.querySelectorAll(".active.dismissable");
  var protectedlist = event.target.querySelectorAll(".active.dismissable");
  var _iterator = _createForOfIteratorHelper(dismissable),
    _step;
  try {
    for (_iterator.s(); !(_step = _iterator.n()).done;) {
      var item = _step.value;
      var dismiss = true;
      var _iterator2 = _createForOfIteratorHelper(protectedlist),
        _step2;
      try {
        for (_iterator2.s(); !(_step2 = _iterator2.n()).done;) {
          var plitem = _step2.value;
          if (plitem === item) dismiss = false;
        }
      } catch (err) {
        _iterator2.e(err);
      } finally {
        _iterator2.f();
      }
      if (dismiss) item.classList.remove("active", "dismissable");
    }
  } catch (err) {
    _iterator.e(err);
  } finally {
    _iterator.f();
  }
};
var mobileExpand = function mobileExpand(event) {
  var button = event.target;
  var header = button.closest("HEADER");
  var body = document.querySelector("BODY");
  var mobilemenu = button.dataset.menuTarget ? document.getElementById(button.dataset.menuTarget) : false;
  if (mobilemenu) {
    //lock body scroll. see layout css
    body.classList.toggle("mobile-menu-expanded");
    if (!mobilemenu.classList.contains("active")) {
      //first time popping menu;
      mobilemenu.classList.add("active");
      mobilemenu.classList.add("slidein");
      mobilemenu.classList.remove("slideout");
    } else {
      //timeout to remove active class;
      mobilemenu.classList.add("slideout");
      mobilemenu.classList.remove("slidein");
      setTimeout(function () {
        var mm = document.querySelector('.slideout');
        mm.classList.remove("active");
      }, 400);
    }
  }
};
var mobileMenuClick = function mobileMenuClick(event) {
  var button = event.target;
  var header = button.closest("HEADER");
  var body = document.querySelector("BODY");
  var mobilemenu = header.querySelector('.mobile-menu');
  if (mobilemenu) {
    body.classList.toggle("mobile-menu-expanded");
    mobilemenu.classList.toggle("active");
    if (mobilemenu.classList.contains("active")) {
      mobilemenu.classList.remove("slideout");
      mobilemenu.classList.add("slidein");
    } else {
      mobilemenu.classList.remove("slidein");
      mobilemenu.classList.add("slideout");
    }
  }
};
var menuClick = function menuClick(event) {
  var li = event.target.tagName === "LI" ? event.target : event.target.closest("LI");
  var menuitems = document.getElementsByClassName('menu-item');
  var _iterator3 = _createForOfIteratorHelper(menuitems),
    _step3;
  try {
    for (_iterator3.s(); !(_step3 = _iterator3.n()).done;) {
      var item = _step3.value;
      if (item === li) {
        if (li.classList.contains("active")) {
          li.classList.remove("active");
          li.classList.remove("dismissable");
        } else {
          li.classList.add("active");
          li.classList.add("dismissable");
          event.stopPropagation();
        }
      } else {
        item.classList.remove("active");
        item.classList.remove("dismissable");
      }
    }
  } catch (err) {
    _iterator3.e(err);
  } finally {
    _iterator3.f();
  }
};
var doMenuClicks = function doMenuClicks() {
  var menuitems = document.getElementsByClassName('menu-item');
  var _iterator4 = _createForOfIteratorHelper(menuitems),
    _step4;
  try {
    for (_iterator4.s(); !(_step4 = _iterator4.n()).done;) {
      var menuitem = _step4.value;
      menuitem.addEventListener('click', menuClick);
    }
  } catch (err) {
    _iterator4.e(err);
  } finally {
    _iterator4.f();
  }
};
var doMobileMenuClick = function doMobileMenuClick() {
  var burger = document.querySelectorAll('.hamburger-menu.mobile-only');
  if (burger) {
    var _iterator5 = _createForOfIteratorHelper(burger),
      _step5;
    try {
      for (_iterator5.s(); !(_step5 = _iterator5.n()).done;) {
        var bg = _step5.value;
        bg.addEventListener('click', mobileMenuClick);
      }
    } catch (err) {
      _iterator5.e(err);
    } finally {
      _iterator5.f();
    }
  }
};
var accordionClick = function accordionClick(event) {
  //just in case the plus icon is clicked on this event should cover both with bubbling
  var title = event.target.tagName === "H4" ? event.target : event.target.closest("H4");
  var parent = title.closest(".tpt-accordion");
  var panel = parent ? parent.querySelector(".tpt-accordion-panel") : false;
  if (title && panel) {
    title.classList.toggle("expanded");
    if (panel.style.maxHeight) {
      panel.style.maxHeight = null;
    } else {
      panel.style.maxHeight = panel.scrollHeight + "px";
    }
  }
};
var doAccordionClicks = function doAccordionClicks() {
  var accordions = document.getElementsByClassName("tpt-accordion");
  if (accordions.length) {
    var _iterator6 = _createForOfIteratorHelper(accordions),
      _step6;
    try {
      for (_iterator6.s(); !(_step6 = _iterator6.n()).done;) {
        var accordion = _step6.value;
        var title = accordion.querySelector(".accordion");
        title.addEventListener('click', accordionClick);
      }
    } catch (err) {
      _iterator6.e(err);
    } finally {
      _iterator6.f();
    }
  }
};
var sendit = /*#__PURE__*/function () {
  var _ref = _asyncToGenerator( /*#__PURE__*/_regeneratorRuntime().mark(function _callee(location, senddata) {
    var settings, fetchResponse, receivedata;
    return _regeneratorRuntime().wrap(function _callee$(_context) {
      while (1) switch (_context.prev = _context.next) {
        case 0:
          settings = {
            method: 'POST',
            headers: {
              'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: senddata
          };
          _context.prev = 1;
          _context.next = 4;
          return fetch(location, settings);
        case 4:
          fetchResponse = _context.sent;
          _context.next = 7;
          return fetchResponse.json();
        case 7:
          receivedata = _context.sent;
          return _context.abrupt("return", receivedata);
        case 11:
          _context.prev = 11;
          _context.t0 = _context["catch"](1);
          console.log(_context.t0);
          return _context.abrupt("return", _context.t0);
        case 15:
        case "end":
          return _context.stop();
      }
    }, _callee, null, [[1, 11]]);
  }));
  return function sendit(_x, _x2) {
    return _ref.apply(this, arguments);
  };
}();

/***/ }),

/***/ "./theme/src/js/frontend/progressive-header.js":
/*!*****************************************************!*\
  !*** ./theme/src/js/frontend/progressive-header.js ***!
  \*****************************************************/
/*! exports provided: setUpCanvas, pageHeaderVideo, progressiveHeaderCheck, paintImage, loadImages, loadImage, doProgressiveHeader */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "setUpCanvas", function() { return setUpCanvas; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "pageHeaderVideo", function() { return pageHeaderVideo; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "progressiveHeaderCheck", function() { return progressiveHeaderCheck; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "paintImage", function() { return paintImage; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "loadImages", function() { return loadImages; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "loadImage", function() { return loadImage; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "doProgressiveHeader", function() { return doProgressiveHeader; });
function _typeof(obj) { "@babel/helpers - typeof"; return _typeof = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function (obj) { return typeof obj; } : function (obj) { return obj && "function" == typeof Symbol && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : typeof obj; }, _typeof(obj); }
function _regeneratorRuntime() { "use strict"; /*! regenerator-runtime -- Copyright (c) 2014-present, Facebook, Inc. -- license (MIT): https://github.com/facebook/regenerator/blob/main/LICENSE */ _regeneratorRuntime = function _regeneratorRuntime() { return exports; }; var exports = {}, Op = Object.prototype, hasOwn = Op.hasOwnProperty, defineProperty = Object.defineProperty || function (obj, key, desc) { obj[key] = desc.value; }, $Symbol = "function" == typeof Symbol ? Symbol : {}, iteratorSymbol = $Symbol.iterator || "@@iterator", asyncIteratorSymbol = $Symbol.asyncIterator || "@@asyncIterator", toStringTagSymbol = $Symbol.toStringTag || "@@toStringTag"; function define(obj, key, value) { return Object.defineProperty(obj, key, { value: value, enumerable: !0, configurable: !0, writable: !0 }), obj[key]; } try { define({}, ""); } catch (err) { define = function define(obj, key, value) { return obj[key] = value; }; } function wrap(innerFn, outerFn, self, tryLocsList) { var protoGenerator = outerFn && outerFn.prototype instanceof Generator ? outerFn : Generator, generator = Object.create(protoGenerator.prototype), context = new Context(tryLocsList || []); return defineProperty(generator, "_invoke", { value: makeInvokeMethod(innerFn, self, context) }), generator; } function tryCatch(fn, obj, arg) { try { return { type: "normal", arg: fn.call(obj, arg) }; } catch (err) { return { type: "throw", arg: err }; } } exports.wrap = wrap; var ContinueSentinel = {}; function Generator() {} function GeneratorFunction() {} function GeneratorFunctionPrototype() {} var IteratorPrototype = {}; define(IteratorPrototype, iteratorSymbol, function () { return this; }); var getProto = Object.getPrototypeOf, NativeIteratorPrototype = getProto && getProto(getProto(values([]))); NativeIteratorPrototype && NativeIteratorPrototype !== Op && hasOwn.call(NativeIteratorPrototype, iteratorSymbol) && (IteratorPrototype = NativeIteratorPrototype); var Gp = GeneratorFunctionPrototype.prototype = Generator.prototype = Object.create(IteratorPrototype); function defineIteratorMethods(prototype) { ["next", "throw", "return"].forEach(function (method) { define(prototype, method, function (arg) { return this._invoke(method, arg); }); }); } function AsyncIterator(generator, PromiseImpl) { function invoke(method, arg, resolve, reject) { var record = tryCatch(generator[method], generator, arg); if ("throw" !== record.type) { var result = record.arg, value = result.value; return value && "object" == _typeof(value) && hasOwn.call(value, "__await") ? PromiseImpl.resolve(value.__await).then(function (value) { invoke("next", value, resolve, reject); }, function (err) { invoke("throw", err, resolve, reject); }) : PromiseImpl.resolve(value).then(function (unwrapped) { result.value = unwrapped, resolve(result); }, function (error) { return invoke("throw", error, resolve, reject); }); } reject(record.arg); } var previousPromise; defineProperty(this, "_invoke", { value: function value(method, arg) { function callInvokeWithMethodAndArg() { return new PromiseImpl(function (resolve, reject) { invoke(method, arg, resolve, reject); }); } return previousPromise = previousPromise ? previousPromise.then(callInvokeWithMethodAndArg, callInvokeWithMethodAndArg) : callInvokeWithMethodAndArg(); } }); } function makeInvokeMethod(innerFn, self, context) { var state = "suspendedStart"; return function (method, arg) { if ("executing" === state) throw new Error("Generator is already running"); if ("completed" === state) { if ("throw" === method) throw arg; return doneResult(); } for (context.method = method, context.arg = arg;;) { var delegate = context.delegate; if (delegate) { var delegateResult = maybeInvokeDelegate(delegate, context); if (delegateResult) { if (delegateResult === ContinueSentinel) continue; return delegateResult; } } if ("next" === context.method) context.sent = context._sent = context.arg;else if ("throw" === context.method) { if ("suspendedStart" === state) throw state = "completed", context.arg; context.dispatchException(context.arg); } else "return" === context.method && context.abrupt("return", context.arg); state = "executing"; var record = tryCatch(innerFn, self, context); if ("normal" === record.type) { if (state = context.done ? "completed" : "suspendedYield", record.arg === ContinueSentinel) continue; return { value: record.arg, done: context.done }; } "throw" === record.type && (state = "completed", context.method = "throw", context.arg = record.arg); } }; } function maybeInvokeDelegate(delegate, context) { var methodName = context.method, method = delegate.iterator[methodName]; if (undefined === method) return context.delegate = null, "throw" === methodName && delegate.iterator["return"] && (context.method = "return", context.arg = undefined, maybeInvokeDelegate(delegate, context), "throw" === context.method) || "return" !== methodName && (context.method = "throw", context.arg = new TypeError("The iterator does not provide a '" + methodName + "' method")), ContinueSentinel; var record = tryCatch(method, delegate.iterator, context.arg); if ("throw" === record.type) return context.method = "throw", context.arg = record.arg, context.delegate = null, ContinueSentinel; var info = record.arg; return info ? info.done ? (context[delegate.resultName] = info.value, context.next = delegate.nextLoc, "return" !== context.method && (context.method = "next", context.arg = undefined), context.delegate = null, ContinueSentinel) : info : (context.method = "throw", context.arg = new TypeError("iterator result is not an object"), context.delegate = null, ContinueSentinel); } function pushTryEntry(locs) { var entry = { tryLoc: locs[0] }; 1 in locs && (entry.catchLoc = locs[1]), 2 in locs && (entry.finallyLoc = locs[2], entry.afterLoc = locs[3]), this.tryEntries.push(entry); } function resetTryEntry(entry) { var record = entry.completion || {}; record.type = "normal", delete record.arg, entry.completion = record; } function Context(tryLocsList) { this.tryEntries = [{ tryLoc: "root" }], tryLocsList.forEach(pushTryEntry, this), this.reset(!0); } function values(iterable) { if (iterable) { var iteratorMethod = iterable[iteratorSymbol]; if (iteratorMethod) return iteratorMethod.call(iterable); if ("function" == typeof iterable.next) return iterable; if (!isNaN(iterable.length)) { var i = -1, next = function next() { for (; ++i < iterable.length;) if (hasOwn.call(iterable, i)) return next.value = iterable[i], next.done = !1, next; return next.value = undefined, next.done = !0, next; }; return next.next = next; } } return { next: doneResult }; } function doneResult() { return { value: undefined, done: !0 }; } return GeneratorFunction.prototype = GeneratorFunctionPrototype, defineProperty(Gp, "constructor", { value: GeneratorFunctionPrototype, configurable: !0 }), defineProperty(GeneratorFunctionPrototype, "constructor", { value: GeneratorFunction, configurable: !0 }), GeneratorFunction.displayName = define(GeneratorFunctionPrototype, toStringTagSymbol, "GeneratorFunction"), exports.isGeneratorFunction = function (genFun) { var ctor = "function" == typeof genFun && genFun.constructor; return !!ctor && (ctor === GeneratorFunction || "GeneratorFunction" === (ctor.displayName || ctor.name)); }, exports.mark = function (genFun) { return Object.setPrototypeOf ? Object.setPrototypeOf(genFun, GeneratorFunctionPrototype) : (genFun.__proto__ = GeneratorFunctionPrototype, define(genFun, toStringTagSymbol, "GeneratorFunction")), genFun.prototype = Object.create(Gp), genFun; }, exports.awrap = function (arg) { return { __await: arg }; }, defineIteratorMethods(AsyncIterator.prototype), define(AsyncIterator.prototype, asyncIteratorSymbol, function () { return this; }), exports.AsyncIterator = AsyncIterator, exports.async = function (innerFn, outerFn, self, tryLocsList, PromiseImpl) { void 0 === PromiseImpl && (PromiseImpl = Promise); var iter = new AsyncIterator(wrap(innerFn, outerFn, self, tryLocsList), PromiseImpl); return exports.isGeneratorFunction(outerFn) ? iter : iter.next().then(function (result) { return result.done ? result.value : iter.next(); }); }, defineIteratorMethods(Gp), define(Gp, toStringTagSymbol, "Generator"), define(Gp, iteratorSymbol, function () { return this; }), define(Gp, "toString", function () { return "[object Generator]"; }), exports.keys = function (val) { var object = Object(val), keys = []; for (var key in object) keys.push(key); return keys.reverse(), function next() { for (; keys.length;) { var key = keys.pop(); if (key in object) return next.value = key, next.done = !1, next; } return next.done = !0, next; }; }, exports.values = values, Context.prototype = { constructor: Context, reset: function reset(skipTempReset) { if (this.prev = 0, this.next = 0, this.sent = this._sent = undefined, this.done = !1, this.delegate = null, this.method = "next", this.arg = undefined, this.tryEntries.forEach(resetTryEntry), !skipTempReset) for (var name in this) "t" === name.charAt(0) && hasOwn.call(this, name) && !isNaN(+name.slice(1)) && (this[name] = undefined); }, stop: function stop() { this.done = !0; var rootRecord = this.tryEntries[0].completion; if ("throw" === rootRecord.type) throw rootRecord.arg; return this.rval; }, dispatchException: function dispatchException(exception) { if (this.done) throw exception; var context = this; function handle(loc, caught) { return record.type = "throw", record.arg = exception, context.next = loc, caught && (context.method = "next", context.arg = undefined), !!caught; } for (var i = this.tryEntries.length - 1; i >= 0; --i) { var entry = this.tryEntries[i], record = entry.completion; if ("root" === entry.tryLoc) return handle("end"); if (entry.tryLoc <= this.prev) { var hasCatch = hasOwn.call(entry, "catchLoc"), hasFinally = hasOwn.call(entry, "finallyLoc"); if (hasCatch && hasFinally) { if (this.prev < entry.catchLoc) return handle(entry.catchLoc, !0); if (this.prev < entry.finallyLoc) return handle(entry.finallyLoc); } else if (hasCatch) { if (this.prev < entry.catchLoc) return handle(entry.catchLoc, !0); } else { if (!hasFinally) throw new Error("try statement without catch or finally"); if (this.prev < entry.finallyLoc) return handle(entry.finallyLoc); } } } }, abrupt: function abrupt(type, arg) { for (var i = this.tryEntries.length - 1; i >= 0; --i) { var entry = this.tryEntries[i]; if (entry.tryLoc <= this.prev && hasOwn.call(entry, "finallyLoc") && this.prev < entry.finallyLoc) { var finallyEntry = entry; break; } } finallyEntry && ("break" === type || "continue" === type) && finallyEntry.tryLoc <= arg && arg <= finallyEntry.finallyLoc && (finallyEntry = null); var record = finallyEntry ? finallyEntry.completion : {}; return record.type = type, record.arg = arg, finallyEntry ? (this.method = "next", this.next = finallyEntry.finallyLoc, ContinueSentinel) : this.complete(record); }, complete: function complete(record, afterLoc) { if ("throw" === record.type) throw record.arg; return "break" === record.type || "continue" === record.type ? this.next = record.arg : "return" === record.type ? (this.rval = this.arg = record.arg, this.method = "return", this.next = "end") : "normal" === record.type && afterLoc && (this.next = afterLoc), ContinueSentinel; }, finish: function finish(finallyLoc) { for (var i = this.tryEntries.length - 1; i >= 0; --i) { var entry = this.tryEntries[i]; if (entry.finallyLoc === finallyLoc) return this.complete(entry.completion, entry.afterLoc), resetTryEntry(entry), ContinueSentinel; } }, "catch": function _catch(tryLoc) { for (var i = this.tryEntries.length - 1; i >= 0; --i) { var entry = this.tryEntries[i]; if (entry.tryLoc === tryLoc) { var record = entry.completion; if ("throw" === record.type) { var thrown = record.arg; resetTryEntry(entry); } return thrown; } } throw new Error("illegal catch attempt"); }, delegateYield: function delegateYield(iterable, resultName, nextLoc) { return this.delegate = { iterator: values(iterable), resultName: resultName, nextLoc: nextLoc }, "next" === this.method && (this.arg = undefined), ContinueSentinel; } }, exports; }
function asyncGeneratorStep(gen, resolve, reject, _next, _throw, key, arg) { try { var info = gen[key](arg); var value = info.value; } catch (error) { reject(error); return; } if (info.done) { resolve(value); } else { Promise.resolve(value).then(_next, _throw); } }
function _asyncToGenerator(fn) { return function () { var self = this, args = arguments; return new Promise(function (resolve, reject) { var gen = fn.apply(self, args); function _next(value) { asyncGeneratorStep(gen, resolve, reject, _next, _throw, "next", value); } function _throw(err) { asyncGeneratorStep(gen, resolve, reject, _next, _throw, "throw", err); } _next(undefined); }); }; }
/* Utility Functions */

/* setUpCanvas 
  sets height and width of canvas element placeholding the header image
  accepts:
    canvas - DOMElement: canvas element with predetermined data attributes
    vw - integer: viewport width of screen 
  returns:
    na
/*/

var setUpCanvas = function setUpCanvas(canvas, vw) {
  var aspect_w = canvas.dataset.aspectWidth;
  var aspect_h = canvas.dataset.aspectHeight;
  var minheight = canvas.hasAttribute('data-min-height') ? canvas.dataset.minHeight : 0;
  var canvas_height_multiplier;
  if (aspect_h !== "auto") {
    canvas_height_multiplier = aspect_w && aspect_h ? aspect_h / aspect_w : false;
  } else {
    canvas_height_multiplier = "auto";
  }

  /* Give canvas dimensions */
  if (canvas_height_multiplier) {
    if (canvas_height_multiplier === "auto") {
      //setting height to 0 will set this image height to auto during print
      canvas.height = 0;
    } else {
      canvas.height = Math.round(Math.max(Math.floor(vw * canvas_height_multiplier), minheight));
    }
  } else {
    canvas.height = minheight;
  }
  canvas.width = vw;
};

/* pageHeaderVideo 
  loads video element if available from data attributes
  accepts:
    na
  returns:
    na
/*/
var pageHeaderVideo = function pageHeaderVideo() {
  var phv = document.getElementById('pageheadervideo');
  if (phv) {
    var vw = Math.max(document.documentElement.clientWidth || 0, window.innerWidth || 0);
    var source = vw < 768 ? phv.dataset.mobileSource : phv.dataset.desktopSource;
    if (source) {
      var el = document.createElement('source');
      var extension = source.split('.');
      extension = Array.isArray(extension) ? extension[extension.length - 1] : false;
      var type = 'video/mp4';
      if (extension !== 'mp4') {
        //only ogg and webm will benefit from not having an mp4 tag
        //.mov, .qt, and all other unsupported video types may use the same codec as mp4 
        // and not need conversion
        if (extension == 'ogg') type = 'video/ogg';
        if (extension == 'webm') type = 'video/webm';
      }
      el.setAttribute('type', type);
      el.setAttribute('src', source);
      phv.appendChild(el);
      phv.onloadeddata = function () {
        var holder = phv.closest('.hero-holder');
        if (holder) {
          phv.width = holder.clientWidth;
          phv.height = holder.clientHeight;
        }
      };
      phv.setAttribute('src', source);
    }
  }
};
/* progressiveHeaderCheck 
  checks canvas element for required data attributes
  accepts:
    canvas - DOMElement
  returns:
    Boolean FALSE or canvas - DOMElement 
/*/
var progressiveHeaderCheck = function progressiveHeaderCheck(canvas) {
  console.log("checking", canvas);
  if (!canvas.tagName || canvas.tagName !== "CANVAS") {
    canvas = canvas.querySelector('canvas');
    if (!canvas) {
      canvas = false;
    }
    ;
  }
  if (canvas.id === "pageheader-0") {
    var header = canvas.closest('.hero-holder');
    if (header) header.classList.add('notfound');
    console.log('No Featured Image');
    canvas = false;
  }
  if (canvas) {
    if (!canvas.hasAttribute('data-aspect-width') || !canvas.hasAttribute('data-aspect-height') || !canvas.hasAttribute('data-img-sm-desktop')) {
      console.log('Missing required data attributes');
      canvas = false;
    }
  }
  if (!canvas) {
    var holder = document.querySelector('.aspectRatioPlaceholder');
    var spinner = holder ? holder.querySelector('.logo-spinner') : false;
    if (spinner) spinner.remove();
  }
  return canvas;
};
/* paintImage
  takes a loaded image and canvas with height/width and paints a cropped image to match the canvas
  dimensions in a similar fashion as CSS object-fit:cover 
  accepts:
    canvas - DOMElement
    img - loaded IMG Element (not attached to DOM)
    blurlevel - how much blur to use painting the image to canvas
  returns:
    img - loaded IMG Element
/*/
var paintImage = function paintImage(canvas, img, blurlevel) {
  var ctx = canvas.getContext("2d");
  var adjusted_natural_height;
  if (img.naturalWidth >= canvas.width) {
    //need to get smaller
    var travel = img.naturalWidth - canvas.width;
    adjusted_natural_height = Math.round(img.naturalHeight - travel * (img.naturalHeight / img.naturalWidth));
  } else {
    //need to get bigger
    var _travel = canvas.width - img.naturalWidth;
    adjusted_natural_height = Math.round(img.naturalHeight + _travel * (img.naturalHeight / img.naturalWidth));
  }
  //if no canvas height set, treat canvas height as "auto" - ie appropriate natural height for width
  if (canvas.height == 0) canvas.height = adjusted_natural_height;
  //so now we have coords are canvas.width and adjusted_natural_height
  //we need to blow that up to uncropped cover size
  var y_diff = adjusted_natural_height - canvas.height;
  var expanded_width;
  var expanded_height;
  switch (y_diff !== Math.abs(y_diff)) {
    case true:
      //the width is the same and the height difference is negative
      //console.log("we are cropping X");
      expanded_width = canvas.width + Math.abs(y_diff) * (img.naturalWidth / img.naturalHeight);
      expanded_height = canvas.height;
      var size_x_multiplier = img.naturalWidth / expanded_width;
      var x_diff = expanded_width - canvas.width;
      ctx.clearRect(0, 0, canvas.width, canvas.height);
      ctx.filter = 'blur(' + blurlevel + 'px)';
      ctx.drawImage(img, x_diff / 2, 0, canvas.width * size_x_multiplier, img.naturalHeight, 0, 0, canvas.width, canvas.height);
      break;
    case false:
      //the width is the same and the height difference is equal or positive
      //console.log("we are cropping Y");
      expanded_width = canvas.width;
      expanded_height = adjusted_natural_height;
      var size_y_multiplier = img.naturalHeight / expanded_height;
      var draw_y_diff = expanded_height - canvas.height;
      ctx.clearRect(0, 0, canvas.width, canvas.height);
      ctx.filter = 'blur(' + blurlevel + 'px)';
      // If you want to crop equally from top and bottom use this drawImage
      // ctx.drawImage(final, 0, (draw_y_diff / 2), final.naturalWidth, (canvas.height * size_y_multiplier), 0, 0, canvas.width, canvas.height); 
      //This crops from the top
      ctx.drawImage(img, 0, 0, img.naturalWidth, canvas.height * size_y_multiplier, 0, 0, canvas.width, canvas.height);
      break;
    default:
      break;
  }
  return img;
};
/* loadImages
  returns Promise of a queue of URLS that will paint the canvas  
  accepts:
    array - array of URL strings to synchronously paint on the canvas
    canvas - DOMElement to draw the images on
    blurlevel - initial blur to set on the drawImage. After each successfull 
  returns:
    Boolean FALSE or canvas - DOMElement 
/*/
var loadImages = function loadImages(array, canvas, blurlevel) {
  return new Promise(function (resolve, reject) {
    //recursively calls itself until array queue is down to 1 then resolves
    var lasturl = array[array.length - 1];
    var url = array[0];
    var lastimage;
    loadImage(url).then(function (img) {
      lastimage = paintImage(canvas, img, blurlevel);
      blurlevel = parseInt(blurlevel / 2);
      if (img.src === lasturl) {
        while (blurlevel >= 0) {
          blurlevel--;
          paintImage(canvas, lastimage, blurlevel);
        }
        resolve(img);
      } else {
        array.shift();
        loadImages(array, canvas, blurlevel);
      }
    })["catch"](function (err) {
      reject(err);
    });
  });
};
var loadImage = function loadImage(url) {
  return new Promise(function (resolve, reject) {
    var img = new Image();
    img.addEventListener('load', function () {
      return resolve(img);
    });
    img.addEventListener('error', function (err) {
      return reject(err);
    });
    img.src = url;
  });
};
var doProgressiveHeader = /*#__PURE__*/function () {
  var _ref = _asyncToGenerator( /*#__PURE__*/_regeneratorRuntime().mark(function _callee(canvas) {
    var vw, queue, mobile_one, mobile_two, desktop_one, desktop_two, desktop_three, wide_two, wide_three, wide_four;
    return _regeneratorRuntime().wrap(function _callee$(_context) {
      while (1) switch (_context.prev = _context.next) {
        case 0:
          canvas = progressiveHeaderCheck(canvas);
          if (canvas) {
            _context.next = 3;
            break;
          }
          return _context.abrupt("return", false);
        case 3:
          //get viewport width;
          vw = Math.max(document.documentElement.clientWidth || 0, window.innerWidth || 0); //sets canvas height & width and returns multiplier ( I don't think I need multiplier)
          setUpCanvas(canvas, vw);
          queue = [];
          _context.t0 = true;
          _context.next = _context.t0 === vw <= 767 ? 9 : _context.t0 === (vw > 767 && vw <= 1700) ? 13 : _context.t0 === vw > 1700 ? 20 : 27;
          break;
        case 9:
          //mobile tree
          mobile_one = canvas.dataset.imgSmMobile;
          mobile_two = canvas.dataset.imgLgMobile;
          if (!mobile_one && !mobile_two) {
            //no mobile images added, use small & medium desktop (will autocrop, probably badly)
            mobile_one = canvas.dataset.imgSmDesktop;
            mobile_two = canvas.dataset.imgMdDesktop;
            if (mobile_one) queue.push(mobile_one);
            if (mobile_two) queue.push(mobile_two);
          } else {
            //we have mobile images
            if (mobile_one) queue.push(mobile_one);
            if (mobile_two) queue.push(mobile_two);
          }
          return _context.abrupt("break", 27);
        case 13:
          //desktop
          desktop_one = canvas.dataset.imgSmDesktop;
          desktop_two = canvas.dataset.imgMdDesktop;
          desktop_three = canvas.dataset.imgLgDesktop;
          if (desktop_one) queue.push(desktop_one);
          if (desktop_two) queue.push(desktop_two);
          if (desktop_three) queue.push(desktop_three);
          return _context.abrupt("break", 27);
        case 20:
          //wide
          wide_two = canvas.dataset.imgMdDesktop;
          wide_three = canvas.dataset.imgLgDesktop;
          wide_four = canvas.dataset.imgFull;
          if (wide_two) queue.push(wide_two);
          if (wide_three) queue.push(wide_three);
          if (wide_four) queue.push(wide_four);
          return _context.abrupt("break", 27);
        case 27:
          //queue, canvas, blurLevel to start at
          loadImages(queue, canvas, 25).then(function (img) {
            //handle Video  
            pageHeaderVideo();
          })["catch"](function (err) {
            console.log(err);
            //try video 
            pageHeaderVideo();
          });
        case 28:
        case "end":
          return _context.stop();
      }
    }, _callee);
  }));
  return function doProgressiveHeader(_x) {
    return _ref.apply(this, arguments);
  };
}();

/***/ }),

/***/ "./theme/src/js/frontend/query.js":
/*!****************************************!*\
  !*** ./theme/src/js/frontend/query.js ***!
  \****************************************/
/*! exports provided: do_post_cat_pagination, do_generic_post_category, doOnloadQuery */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "do_post_cat_pagination", function() { return do_post_cat_pagination; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "do_generic_post_category", function() { return do_generic_post_category; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "doOnloadQuery", function() { return doOnloadQuery; });
function _typeof(obj) { "@babel/helpers - typeof"; return _typeof = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function (obj) { return typeof obj; } : function (obj) { return obj && "function" == typeof Symbol && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : typeof obj; }, _typeof(obj); }
function _createForOfIteratorHelper(o, allowArrayLike) { var it = typeof Symbol !== "undefined" && o[Symbol.iterator] || o["@@iterator"]; if (!it) { if (Array.isArray(o) || (it = _unsupportedIterableToArray(o)) || allowArrayLike && o && typeof o.length === "number") { if (it) o = it; var i = 0; var F = function F() {}; return { s: F, n: function n() { if (i >= o.length) return { done: true }; return { done: false, value: o[i++] }; }, e: function e(_e) { throw _e; }, f: F }; } throw new TypeError("Invalid attempt to iterate non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); } var normalCompletion = true, didErr = false, err; return { s: function s() { it = it.call(o); }, n: function n() { var step = it.next(); normalCompletion = step.done; return step; }, e: function e(_e2) { didErr = true; err = _e2; }, f: function f() { try { if (!normalCompletion && it["return"] != null) it["return"](); } finally { if (didErr) throw err; } } }; }
function _unsupportedIterableToArray(o, minLen) { if (!o) return; if (typeof o === "string") return _arrayLikeToArray(o, minLen); var n = Object.prototype.toString.call(o).slice(8, -1); if (n === "Object" && o.constructor) n = o.constructor.name; if (n === "Map" || n === "Set") return Array.from(o); if (n === "Arguments" || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)) return _arrayLikeToArray(o, minLen); }
function _arrayLikeToArray(arr, len) { if (len == null || len > arr.length) len = arr.length; for (var i = 0, arr2 = new Array(len); i < len; i++) arr2[i] = arr[i]; return arr2; }
var do_cat_click = function do_cat_click(li) {
  var ul = li.tagName == 'LI' ? li.parentElement : false;
  //error with markup
  if (!ul) return false;
  if (li.hasAttribute('data-slug') && li.dataset.slug == '*') {
    //clicking All on active All does nothing
    if (li.classList.contains('active')) return false;
    var _iterator = _createForOfIteratorHelper(ul.children),
      _step;
    try {
      for (_iterator.s(); !(_step = _iterator.n()).done;) {
        var listitem = _step.value;
        if (listitem === li) {
          listitem.classList.toggle('active');
        } else {
          listitem.classList.remove('active');
        }
      }
    } catch (err) {
      _iterator.e(err);
    } finally {
      _iterator.f();
    }
    return true;
  } else {
    li.classList.toggle('active');
    var all = ul.querySelector('[data-slug="*"]');
    if (all) all.classList.remove('active');
    return true;
  }
};
var do_post_cat_pagination = function do_post_cat_pagination(event) {
  //update the parent data attributes
  var paged = event.target.hasAttribute('data-paged') ? event.target.dataset.paged : false;
  var parent = event.target.closest('.querywrap');
  if (parent && paged) parent.setAttribute('data-paged', paged);
  //pass the click - easy peasy
  doOnloadQuery(parent, true);
};
var do_generic_post_category = function do_generic_post_category(event) {
  var parent = event.target.closest('.querywrap');
  //first toggle active 
  var this_li = event.target.classList.contains('post-category') ? event.target : event.target.closest('.post-category');
  var good_click = do_cat_click(this_li);
  var selected = [];
  if (good_click) {
    var categorylist = event.target.closest('.query-controls');
    Array.from(categorylist.children).forEach(function (li) {
      if (li.classList.contains('active')) {
        selected.push(li.dataset.slug);
      }
    });
  }
  console.log(selected);

  /* collect category slugs */

  var query = parent.hasAttribute('data-query') ? parent.dataset.query : false;
  var posttype = parent.hasAttribute('data-posttype') ? parent.dataset.posttype : 'post';
  var args = parent.hasAttribute('data-args') ? parent.dataset.args : false;
  if (parent.hasAttribute('data-categories-selected')) parent.dataset.categoriesSelected = selected;
  var nonce = window.theme_vars.nonce;
  var url = window.theme_vars.ajaxurl;
  if (nonce && url && query) {
    url += '?action=' + query + '&nonce=' + nonce;
    var senddata = '&nonce=' + nonce;
    senddata += '&post_type=' + encodeURIComponent(posttype);
    if (selected) {
      //categories will be in comma separated slugs which means arrays and single both work the same
      senddata += '&categories_selected=' + encodeURIComponent(selected);
    }
    /* pagination */
    var perpage = parent.hasAttribute('data-posts-per-page') ? parent.dataset.postsPerPage : false;
    if (perpage) senddata += '&posts_per_page=' + encodeURIComponent(perpage);
    if (args) {
      //are the args in JSON
      var jsonargs = toJSON(args);
      if (jsonargs) {
        senddata += '&args=' + encodeURIComponent(args);
      } else {
        //otherwise try to make sense of the array
        senddata += '&args=' + new URLSearchParams(args);
      }
    }
    var showcontrols = parent.hasAttribute('data-show-controls') ? parent.dataset.showControls : false;
    if (showcontrols && showcontrols.length) senddata += '&showcontrols=' + encodeURIComponent(showcontrols);
    var showpagination = parent.hasAttribute('data-show-pagination') ? parent.dataset.showPagination : false;
    if (showpagination && showpagination.length) senddata += '&showpagination=' + encodeURIComponent(showpagination);
    var postin = parent.hasAttribute('data-post-in') ? parent.dataset.postIn : false;
    if (postin && postin.length) senddata += '&postin=' + encodeURIComponent(postin);
    console.log(senddata);
    sendit(url, senddata).then(function (r) {
      var html;
      if (r.status === 200) {
        html = r.payload;
      } else {
        html = r.message ? r.message : "Something went wrong with this request.";
      }
      parent.innerHTML = html;
    });
  }
};
var doOnloadQuery = function doOnloadQuery(elem) {
  var scrollto = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : false;
  var query = elem.hasAttribute('data-query') ? elem.dataset.query : false;
  var posttype = elem.hasAttribute('data-posttype') ? elem.dataset.posttype : 'post';
  var args = elem.hasAttribute('data-args') ? elem.dataset.args : false;
  var categories = elem.hasAttribute('data-categories-selected') ? elem.dataset.categoriesSelected : false;
  var nonce = window.theme_vars.nonce;
  var url = window.theme_vars.ajaxurl;
  if (nonce && url && query) {
    url += '?action=' + query + '&nonce=' + nonce;
    var senddata = '&nonce=' + nonce;
    senddata += '&post_type=' + encodeURIComponent(posttype);
    if (categories) {
      //categories will be in comma separated slugs which means arrays and single both work the same
      senddata += '&categories_selected=' + new URLSearchParams(categories);
    }
    /* pagination */
    var perpage = elem.hasAttribute('data-posts-per-page') ? elem.dataset.postsPerPage : false;
    var paged = elem.hasAttribute('data-paged') ? elem.dataset.paged : false;
    if (args) {
      //are the args in JSON
      var jsonargs = toJSON(args);
      if (jsonargs) {
        senddata += '&args=' + encodeURIComponent(args);
      } else {
        //otherwise try to make sense of the array
        senddata += '&args=' + new URLSearchParams(args);
      }
    }
    if (perpage) senddata += '&posts_per_page=' + encodeURIComponent(perpage);
    if (paged) senddata += '&paged=' + encodeURIComponent(paged);
    var showcontrols = elem.hasAttribute('data-show-controls') ? elem.dataset.showControls : false;
    if (showcontrols && showcontrols.length) senddata += '&showcontrols=' + encodeURIComponent(showcontrols);
    var showpagination = elem.hasAttribute('data-show-pagination') ? elem.dataset.showPagination : false;
    if (showpagination && showpagination.length) senddata += '&showpagination=' + encodeURIComponent(showpagination);
    var postin = elem.hasAttribute('data-post-in') ? elem.dataset.postIn : false;
    if (postin && postin.length) senddata += '&postin=' + encodeURIComponent(postin);
    console.log(senddata);
    sendit(url, senddata).then(function (r) {
      var wrap = elem.closest('.querywrap');
      var html;
      if (r.status === 200) {
        html = r.payload;
      } else {
        html = r.message ? r.message : "Something went wrong with this request.";
      }
      wrap.innerHTML = html;
      if (scrollto) {
        var box = elem.getBoundingClientRect();
        var body = document.body;
        var docEl = document.documentElement;
        var scrollTop = window.pageYOffset || docEl.scrollTop || body.scrollTop;
        var clientTop = docEl.clientTop || body.clientTop || 0;
        var top = box.top + scrollTop - clientTop;
        window.scrollTo({
          top: top,
          left: 0,
          behavior: 'smooth'
        });
      }
    });
  }
};
function toJSON(str) {
  try {
    var obj = JSON.parse(str);
    if (obj && _typeof(obj) === "object") {
      return obj;
    }
  } catch (e) {
    console.log(e);
    return false;
  }
}

/***/ }),

/***/ "./theme/src/js/head.js":
/*!******************************!*\
  !*** ./theme/src/js/head.js ***!
  \******************************/
/*! no exports provided */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _frontend_global_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./frontend/global.js */ "./theme/src/js/frontend/global.js");
/* harmony import */ var _frontend_query_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./frontend/query.js */ "./theme/src/js/frontend/query.js");
/* harmony import */ var _frontend_progressive_header_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./frontend/progressive-header.js */ "./theme/src/js/frontend/progressive-header.js");
function _typeof(obj) { "@babel/helpers - typeof"; return _typeof = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function (obj) { return typeof obj; } : function (obj) { return obj && "function" == typeof Symbol && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : typeof obj; }, _typeof(obj); }
function _createForOfIteratorHelper(o, allowArrayLike) { var it = typeof Symbol !== "undefined" && o[Symbol.iterator] || o["@@iterator"]; if (!it) { if (Array.isArray(o) || (it = _unsupportedIterableToArray(o)) || allowArrayLike && o && typeof o.length === "number") { if (it) o = it; var i = 0; var F = function F() {}; return { s: F, n: function n() { if (i >= o.length) return { done: true }; return { done: false, value: o[i++] }; }, e: function e(_e) { throw _e; }, f: F }; } throw new TypeError("Invalid attempt to iterate non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); } var normalCompletion = true, didErr = false, err; return { s: function s() { it = it.call(o); }, n: function n() { var step = it.next(); normalCompletion = step.done; return step; }, e: function e(_e2) { didErr = true; err = _e2; }, f: function f() { try { if (!normalCompletion && it["return"] != null) it["return"](); } finally { if (didErr) throw err; } } }; }
function _unsupportedIterableToArray(o, minLen) { if (!o) return; if (typeof o === "string") return _arrayLikeToArray(o, minLen); var n = Object.prototype.toString.call(o).slice(8, -1); if (n === "Object" && o.constructor) n = o.constructor.name; if (n === "Map" || n === "Set") return Array.from(o); if (n === "Arguments" || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)) return _arrayLikeToArray(o, minLen); }
function _arrayLikeToArray(arr, len) { if (len == null || len > arr.length) len = arr.length; for (var i = 0, arr2 = new Array(len); i < len; i++) arr2[i] = arr[i]; return arr2; }
function _regeneratorRuntime() { "use strict"; /*! regenerator-runtime -- Copyright (c) 2014-present, Facebook, Inc. -- license (MIT): https://github.com/facebook/regenerator/blob/main/LICENSE */ _regeneratorRuntime = function _regeneratorRuntime() { return exports; }; var exports = {}, Op = Object.prototype, hasOwn = Op.hasOwnProperty, defineProperty = Object.defineProperty || function (obj, key, desc) { obj[key] = desc.value; }, $Symbol = "function" == typeof Symbol ? Symbol : {}, iteratorSymbol = $Symbol.iterator || "@@iterator", asyncIteratorSymbol = $Symbol.asyncIterator || "@@asyncIterator", toStringTagSymbol = $Symbol.toStringTag || "@@toStringTag"; function define(obj, key, value) { return Object.defineProperty(obj, key, { value: value, enumerable: !0, configurable: !0, writable: !0 }), obj[key]; } try { define({}, ""); } catch (err) { define = function define(obj, key, value) { return obj[key] = value; }; } function wrap(innerFn, outerFn, self, tryLocsList) { var protoGenerator = outerFn && outerFn.prototype instanceof Generator ? outerFn : Generator, generator = Object.create(protoGenerator.prototype), context = new Context(tryLocsList || []); return defineProperty(generator, "_invoke", { value: makeInvokeMethod(innerFn, self, context) }), generator; } function tryCatch(fn, obj, arg) { try { return { type: "normal", arg: fn.call(obj, arg) }; } catch (err) { return { type: "throw", arg: err }; } } exports.wrap = wrap; var ContinueSentinel = {}; function Generator() {} function GeneratorFunction() {} function GeneratorFunctionPrototype() {} var IteratorPrototype = {}; define(IteratorPrototype, iteratorSymbol, function () { return this; }); var getProto = Object.getPrototypeOf, NativeIteratorPrototype = getProto && getProto(getProto(values([]))); NativeIteratorPrototype && NativeIteratorPrototype !== Op && hasOwn.call(NativeIteratorPrototype, iteratorSymbol) && (IteratorPrototype = NativeIteratorPrototype); var Gp = GeneratorFunctionPrototype.prototype = Generator.prototype = Object.create(IteratorPrototype); function defineIteratorMethods(prototype) { ["next", "throw", "return"].forEach(function (method) { define(prototype, method, function (arg) { return this._invoke(method, arg); }); }); } function AsyncIterator(generator, PromiseImpl) { function invoke(method, arg, resolve, reject) { var record = tryCatch(generator[method], generator, arg); if ("throw" !== record.type) { var result = record.arg, value = result.value; return value && "object" == _typeof(value) && hasOwn.call(value, "__await") ? PromiseImpl.resolve(value.__await).then(function (value) { invoke("next", value, resolve, reject); }, function (err) { invoke("throw", err, resolve, reject); }) : PromiseImpl.resolve(value).then(function (unwrapped) { result.value = unwrapped, resolve(result); }, function (error) { return invoke("throw", error, resolve, reject); }); } reject(record.arg); } var previousPromise; defineProperty(this, "_invoke", { value: function value(method, arg) { function callInvokeWithMethodAndArg() { return new PromiseImpl(function (resolve, reject) { invoke(method, arg, resolve, reject); }); } return previousPromise = previousPromise ? previousPromise.then(callInvokeWithMethodAndArg, callInvokeWithMethodAndArg) : callInvokeWithMethodAndArg(); } }); } function makeInvokeMethod(innerFn, self, context) { var state = "suspendedStart"; return function (method, arg) { if ("executing" === state) throw new Error("Generator is already running"); if ("completed" === state) { if ("throw" === method) throw arg; return doneResult(); } for (context.method = method, context.arg = arg;;) { var delegate = context.delegate; if (delegate) { var delegateResult = maybeInvokeDelegate(delegate, context); if (delegateResult) { if (delegateResult === ContinueSentinel) continue; return delegateResult; } } if ("next" === context.method) context.sent = context._sent = context.arg;else if ("throw" === context.method) { if ("suspendedStart" === state) throw state = "completed", context.arg; context.dispatchException(context.arg); } else "return" === context.method && context.abrupt("return", context.arg); state = "executing"; var record = tryCatch(innerFn, self, context); if ("normal" === record.type) { if (state = context.done ? "completed" : "suspendedYield", record.arg === ContinueSentinel) continue; return { value: record.arg, done: context.done }; } "throw" === record.type && (state = "completed", context.method = "throw", context.arg = record.arg); } }; } function maybeInvokeDelegate(delegate, context) { var methodName = context.method, method = delegate.iterator[methodName]; if (undefined === method) return context.delegate = null, "throw" === methodName && delegate.iterator["return"] && (context.method = "return", context.arg = undefined, maybeInvokeDelegate(delegate, context), "throw" === context.method) || "return" !== methodName && (context.method = "throw", context.arg = new TypeError("The iterator does not provide a '" + methodName + "' method")), ContinueSentinel; var record = tryCatch(method, delegate.iterator, context.arg); if ("throw" === record.type) return context.method = "throw", context.arg = record.arg, context.delegate = null, ContinueSentinel; var info = record.arg; return info ? info.done ? (context[delegate.resultName] = info.value, context.next = delegate.nextLoc, "return" !== context.method && (context.method = "next", context.arg = undefined), context.delegate = null, ContinueSentinel) : info : (context.method = "throw", context.arg = new TypeError("iterator result is not an object"), context.delegate = null, ContinueSentinel); } function pushTryEntry(locs) { var entry = { tryLoc: locs[0] }; 1 in locs && (entry.catchLoc = locs[1]), 2 in locs && (entry.finallyLoc = locs[2], entry.afterLoc = locs[3]), this.tryEntries.push(entry); } function resetTryEntry(entry) { var record = entry.completion || {}; record.type = "normal", delete record.arg, entry.completion = record; } function Context(tryLocsList) { this.tryEntries = [{ tryLoc: "root" }], tryLocsList.forEach(pushTryEntry, this), this.reset(!0); } function values(iterable) { if (iterable) { var iteratorMethod = iterable[iteratorSymbol]; if (iteratorMethod) return iteratorMethod.call(iterable); if ("function" == typeof iterable.next) return iterable; if (!isNaN(iterable.length)) { var i = -1, next = function next() { for (; ++i < iterable.length;) if (hasOwn.call(iterable, i)) return next.value = iterable[i], next.done = !1, next; return next.value = undefined, next.done = !0, next; }; return next.next = next; } } return { next: doneResult }; } function doneResult() { return { value: undefined, done: !0 }; } return GeneratorFunction.prototype = GeneratorFunctionPrototype, defineProperty(Gp, "constructor", { value: GeneratorFunctionPrototype, configurable: !0 }), defineProperty(GeneratorFunctionPrototype, "constructor", { value: GeneratorFunction, configurable: !0 }), GeneratorFunction.displayName = define(GeneratorFunctionPrototype, toStringTagSymbol, "GeneratorFunction"), exports.isGeneratorFunction = function (genFun) { var ctor = "function" == typeof genFun && genFun.constructor; return !!ctor && (ctor === GeneratorFunction || "GeneratorFunction" === (ctor.displayName || ctor.name)); }, exports.mark = function (genFun) { return Object.setPrototypeOf ? Object.setPrototypeOf(genFun, GeneratorFunctionPrototype) : (genFun.__proto__ = GeneratorFunctionPrototype, define(genFun, toStringTagSymbol, "GeneratorFunction")), genFun.prototype = Object.create(Gp), genFun; }, exports.awrap = function (arg) { return { __await: arg }; }, defineIteratorMethods(AsyncIterator.prototype), define(AsyncIterator.prototype, asyncIteratorSymbol, function () { return this; }), exports.AsyncIterator = AsyncIterator, exports.async = function (innerFn, outerFn, self, tryLocsList, PromiseImpl) { void 0 === PromiseImpl && (PromiseImpl = Promise); var iter = new AsyncIterator(wrap(innerFn, outerFn, self, tryLocsList), PromiseImpl); return exports.isGeneratorFunction(outerFn) ? iter : iter.next().then(function (result) { return result.done ? result.value : iter.next(); }); }, defineIteratorMethods(Gp), define(Gp, toStringTagSymbol, "Generator"), define(Gp, iteratorSymbol, function () { return this; }), define(Gp, "toString", function () { return "[object Generator]"; }), exports.keys = function (val) { var object = Object(val), keys = []; for (var key in object) keys.push(key); return keys.reverse(), function next() { for (; keys.length;) { var key = keys.pop(); if (key in object) return next.value = key, next.done = !1, next; } return next.done = !0, next; }; }, exports.values = values, Context.prototype = { constructor: Context, reset: function reset(skipTempReset) { if (this.prev = 0, this.next = 0, this.sent = this._sent = undefined, this.done = !1, this.delegate = null, this.method = "next", this.arg = undefined, this.tryEntries.forEach(resetTryEntry), !skipTempReset) for (var name in this) "t" === name.charAt(0) && hasOwn.call(this, name) && !isNaN(+name.slice(1)) && (this[name] = undefined); }, stop: function stop() { this.done = !0; var rootRecord = this.tryEntries[0].completion; if ("throw" === rootRecord.type) throw rootRecord.arg; return this.rval; }, dispatchException: function dispatchException(exception) { if (this.done) throw exception; var context = this; function handle(loc, caught) { return record.type = "throw", record.arg = exception, context.next = loc, caught && (context.method = "next", context.arg = undefined), !!caught; } for (var i = this.tryEntries.length - 1; i >= 0; --i) { var entry = this.tryEntries[i], record = entry.completion; if ("root" === entry.tryLoc) return handle("end"); if (entry.tryLoc <= this.prev) { var hasCatch = hasOwn.call(entry, "catchLoc"), hasFinally = hasOwn.call(entry, "finallyLoc"); if (hasCatch && hasFinally) { if (this.prev < entry.catchLoc) return handle(entry.catchLoc, !0); if (this.prev < entry.finallyLoc) return handle(entry.finallyLoc); } else if (hasCatch) { if (this.prev < entry.catchLoc) return handle(entry.catchLoc, !0); } else { if (!hasFinally) throw new Error("try statement without catch or finally"); if (this.prev < entry.finallyLoc) return handle(entry.finallyLoc); } } } }, abrupt: function abrupt(type, arg) { for (var i = this.tryEntries.length - 1; i >= 0; --i) { var entry = this.tryEntries[i]; if (entry.tryLoc <= this.prev && hasOwn.call(entry, "finallyLoc") && this.prev < entry.finallyLoc) { var finallyEntry = entry; break; } } finallyEntry && ("break" === type || "continue" === type) && finallyEntry.tryLoc <= arg && arg <= finallyEntry.finallyLoc && (finallyEntry = null); var record = finallyEntry ? finallyEntry.completion : {}; return record.type = type, record.arg = arg, finallyEntry ? (this.method = "next", this.next = finallyEntry.finallyLoc, ContinueSentinel) : this.complete(record); }, complete: function complete(record, afterLoc) { if ("throw" === record.type) throw record.arg; return "break" === record.type || "continue" === record.type ? this.next = record.arg : "return" === record.type ? (this.rval = this.arg = record.arg, this.method = "return", this.next = "end") : "normal" === record.type && afterLoc && (this.next = afterLoc), ContinueSentinel; }, finish: function finish(finallyLoc) { for (var i = this.tryEntries.length - 1; i >= 0; --i) { var entry = this.tryEntries[i]; if (entry.finallyLoc === finallyLoc) return this.complete(entry.completion, entry.afterLoc), resetTryEntry(entry), ContinueSentinel; } }, "catch": function _catch(tryLoc) { for (var i = this.tryEntries.length - 1; i >= 0; --i) { var entry = this.tryEntries[i]; if (entry.tryLoc === tryLoc) { var record = entry.completion; if ("throw" === record.type) { var thrown = record.arg; resetTryEntry(entry); } return thrown; } } throw new Error("illegal catch attempt"); }, delegateYield: function delegateYield(iterable, resultName, nextLoc) { return this.delegate = { iterator: values(iterable), resultName: resultName, nextLoc: nextLoc }, "next" === this.method && (this.arg = undefined), ContinueSentinel; } }, exports; }
function asyncGeneratorStep(gen, resolve, reject, _next, _throw, key, arg) { try { var info = gen[key](arg); var value = info.value; } catch (error) { reject(error); return; } if (info.done) { resolve(value); } else { Promise.resolve(value).then(_next, _throw); } }
function _asyncToGenerator(fn) { return function () { var self = this, args = arguments; return new Promise(function (resolve, reject) { var gen = fn.apply(self, args); function _next(value) { asyncGeneratorStep(gen, resolve, reject, _next, _throw, "next", value); } function _throw(err) { asyncGeneratorStep(gen, resolve, reject, _next, _throw, "throw", err); } _next(undefined); }); }; }



var onload_data_fetch = function onload_data_fetch() {
  var fetchable = document.querySelectorAll('[data-fetch-posttype]');
  if (!fetchable) {
    console.log("nothing fetchable");
    return false;
  }
  var url = window.theme_vars.ajaxurl;
  var nonce = window.theme_vars.nonce;
  if (!url || !nonce) return false;
  Array.from(fetchable).map(function (dofetch) {
    var posttype = dofetch.dataset.fetchPosttype;
    var target = dofetch.dataset.fetchTarget;
    var filters = get_filters(dofetch);
    var senddata = '&nonce=' + nonce;
    if (dofetch.hasAttribute('data-fetch-action') && dofetch.dataset.fetchAction) {
      url += '?action=' + dofetch.dataset.fetchAction + '&nonce=' + nonce;
      senddata += filters ? '&' + filters : '';
      var response_target = document.getElementById(target) ? document.getElementById(target) : dofetch.querySelector('.data-target');
      if (!response_target) {
        console.log("no data target");
        return false;
      }
      console.log(url, senddata);
      sendit(url, senddata).then(function (r) {
        console.log("doing postit");
        if (r.status === 200) {
          console.log(r);
          response_target.innerHTML = r.payload;
        } else {
          console.log(r);
        }
      });
    } else {
      console.log('no data fetch action');
    }
    ;
  });
};
/* Standard Wordpress POST request via native fetch using form-urlencoded data */
var postit = /*#__PURE__*/function () {
  var _ref = _asyncToGenerator( /*#__PURE__*/_regeneratorRuntime().mark(function _callee(location, senddata) {
    var settings, fetchResponse, receivedata;
    return _regeneratorRuntime().wrap(function _callee$(_context) {
      while (1) switch (_context.prev = _context.next) {
        case 0:
          settings = {
            method: 'POST',
            headers: {
              'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: senddata
          };
          _context.prev = 1;
          _context.next = 4;
          return fetch(location, settings);
        case 4:
          fetchResponse = _context.sent;
          _context.next = 7;
          return fetchResponse.json();
        case 7:
          receivedata = _context.sent;
          return _context.abrupt("return", receivedata);
        case 11:
          _context.prev = 11;
          _context.t0 = _context["catch"](1);
          console.log(_context.t0);
          return _context.abrupt("return", _context.t0);
        case 15:
        case "end":
          return _context.stop();
      }
    }, _callee, null, [[1, 11]]);
  }));
  return function postit(_x, _x2) {
    return _ref.apply(this, arguments);
  };
}();
var setupModals = function setupModals() {
  //tingle is the modal library I'm trying out
  //https://tingle.robinparisi.com/
  var links = document.querySelectorAll('[data-modal-link]');
  if (links) {
    var _iterator = _createForOfIteratorHelper(links),
      _step;
    try {
      for (_iterator.s(); !(_step = _iterator.n()).done;) {
        var link = _step.value;
        link.addEventListener('click', function (e) {
          var target = e.target.dataset.modalLink;
          var targetelement = target ? document.getElementById(target) : false;
          if (targetelement) {
            var clone = targetelement.cloneNode();
            var md = new tingle.modal({
              closeMethods: ['overlay', 'button', 'escape'],
              closeLabel: "X",
              cssClass: ['nopad'],
              onOpen: function onOpen() {
                console.log('modal open');
              },
              onClose: function onClose() {
                clone.remove();
              },
              beforeClose: function beforeClose() {
                // here's goes some logic
                // e.g. save content before closing the modal
                return true; // close the modal
                return false; // nothing happens
              }
            });

            clone.setAttribute("controls", "controls");
            md.setContent(clone);
            md.open();
            clone.play();
          }
        });
      }
    } catch (err) {
      _iterator.e(err);
    } finally {
      _iterator.f();
    }
  }
};

/* sorry webpack */
window.setupModals = setupModals;
window.postit = postit;
window.onload_data_fetch = onload_data_fetch;
window.accordionClick = _frontend_global_js__WEBPACK_IMPORTED_MODULE_0__["accordionClick"];
window.doAccordionClicks = _frontend_global_js__WEBPACK_IMPORTED_MODULE_0__["doAccordionClicks"];
window.menuClick = _frontend_global_js__WEBPACK_IMPORTED_MODULE_0__["menuClick"];
window.doMenuClicks = _frontend_global_js__WEBPACK_IMPORTED_MODULE_0__["doMenuClicks"];
window.mobileExpand = _frontend_global_js__WEBPACK_IMPORTED_MODULE_0__["mobileExpand"];
window.setUpCanvas = _frontend_progressive_header_js__WEBPACK_IMPORTED_MODULE_2__["setUpCanvas"];
window.pageHeaderVideo = _frontend_progressive_header_js__WEBPACK_IMPORTED_MODULE_2__["pageHeaderVideo"];
window.progressiveHeaderCheck = _frontend_progressive_header_js__WEBPACK_IMPORTED_MODULE_2__["progressiveHeaderCheck"];
window.paintImage = _frontend_progressive_header_js__WEBPACK_IMPORTED_MODULE_2__["paintImage"];
window.loadImages = _frontend_progressive_header_js__WEBPACK_IMPORTED_MODULE_2__["loadImages"];
window.doProgressiveHeader = _frontend_progressive_header_js__WEBPACK_IMPORTED_MODULE_2__["doProgressiveHeader"];
window.do_generic_post_category = _frontend_query_js__WEBPACK_IMPORTED_MODULE_1__["do_generic_post_category"];
window.do_post_cat_pagination = _frontend_query_js__WEBPACK_IMPORTED_MODULE_1__["do_post_cat_pagination"];
//window.doMobileMenuClick = doMobileMenuClick;

/***/ })

/******/ });
//# sourceMappingURL=main.js.map