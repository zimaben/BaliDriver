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
/******/ 	return __webpack_require__(__webpack_require__.s = "./theme/src/js/admin.js");
/******/ })
/************************************************************************/
/******/ ({

/***/ "./theme/src/js/admin.js":
/*!*******************************!*\
  !*** ./theme/src/js/admin.js ***!
  \*******************************/
/*! no exports provided */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _admin_adminhead_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./admin/adminhead.js */ "./theme/src/js/admin/adminhead.js");

document.addEventListener('DOMContentLoaded', function () {
  var setupbutton = document.getElementById('setupbutton');
  if (setupbutton) {
    setupbutton.addEventListener('click', _admin_adminhead_js__WEBPACK_IMPORTED_MODULE_0__["run_first_setup"]);
  }
  var criticalcssbutton = document.getElementById('criticalcssbutton');
  if (criticalcssbutton) {
    criticalcssbutton.addEventListener('click', _admin_adminhead_js__WEBPACK_IMPORTED_MODULE_0__["run_critical_css"]);
  }
  var testfigmabutton = document.getElementById('figmatest');
  if (testfigmabutton) {
    testfigmabutton.addEventListener('click', _admin_adminhead_js__WEBPACK_IMPORTED_MODULE_0__["test_figma"]);
  }
  var figmaimportbutton = document.getElementById('figmaimportbutton');
  if (figmaimportbutton) {
    figmaimportbutton.addEventListener('click', _admin_adminhead_js__WEBPACK_IMPORTED_MODULE_0__["run_figma_import"]);
  }
  var syncmapbutton = document.getElementById('gmap_sync');
  if (syncmapbutton) syncmapbutton.addEventListener('click', gmap_sync);
});

/***/ }),

/***/ "./theme/src/js/admin/adminhead.js":
/*!*****************************************!*\
  !*** ./theme/src/js/admin/adminhead.js ***!
  \*****************************************/
/*! exports provided: test_figma, run_figma_import, get_figma_item, test_figma_item, gmap_sync, run_first_setup, run_critical_css */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "test_figma", function() { return test_figma; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "run_figma_import", function() { return run_figma_import; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "get_figma_item", function() { return get_figma_item; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "test_figma_item", function() { return test_figma_item; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "gmap_sync", function() { return gmap_sync; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "run_first_setup", function() { return run_first_setup; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "run_critical_css", function() { return run_critical_css; });
function _typeof(obj) { "@babel/helpers - typeof"; return _typeof = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function (obj) { return typeof obj; } : function (obj) { return obj && "function" == typeof Symbol && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : typeof obj; }, _typeof(obj); }
function _regeneratorRuntime() { "use strict"; /*! regenerator-runtime -- Copyright (c) 2014-present, Facebook, Inc. -- license (MIT): https://github.com/facebook/regenerator/blob/main/LICENSE */ _regeneratorRuntime = function _regeneratorRuntime() { return exports; }; var exports = {}, Op = Object.prototype, hasOwn = Op.hasOwnProperty, defineProperty = Object.defineProperty || function (obj, key, desc) { obj[key] = desc.value; }, $Symbol = "function" == typeof Symbol ? Symbol : {}, iteratorSymbol = $Symbol.iterator || "@@iterator", asyncIteratorSymbol = $Symbol.asyncIterator || "@@asyncIterator", toStringTagSymbol = $Symbol.toStringTag || "@@toStringTag"; function define(obj, key, value) { return Object.defineProperty(obj, key, { value: value, enumerable: !0, configurable: !0, writable: !0 }), obj[key]; } try { define({}, ""); } catch (err) { define = function define(obj, key, value) { return obj[key] = value; }; } function wrap(innerFn, outerFn, self, tryLocsList) { var protoGenerator = outerFn && outerFn.prototype instanceof Generator ? outerFn : Generator, generator = Object.create(protoGenerator.prototype), context = new Context(tryLocsList || []); return defineProperty(generator, "_invoke", { value: makeInvokeMethod(innerFn, self, context) }), generator; } function tryCatch(fn, obj, arg) { try { return { type: "normal", arg: fn.call(obj, arg) }; } catch (err) { return { type: "throw", arg: err }; } } exports.wrap = wrap; var ContinueSentinel = {}; function Generator() {} function GeneratorFunction() {} function GeneratorFunctionPrototype() {} var IteratorPrototype = {}; define(IteratorPrototype, iteratorSymbol, function () { return this; }); var getProto = Object.getPrototypeOf, NativeIteratorPrototype = getProto && getProto(getProto(values([]))); NativeIteratorPrototype && NativeIteratorPrototype !== Op && hasOwn.call(NativeIteratorPrototype, iteratorSymbol) && (IteratorPrototype = NativeIteratorPrototype); var Gp = GeneratorFunctionPrototype.prototype = Generator.prototype = Object.create(IteratorPrototype); function defineIteratorMethods(prototype) { ["next", "throw", "return"].forEach(function (method) { define(prototype, method, function (arg) { return this._invoke(method, arg); }); }); } function AsyncIterator(generator, PromiseImpl) { function invoke(method, arg, resolve, reject) { var record = tryCatch(generator[method], generator, arg); if ("throw" !== record.type) { var result = record.arg, value = result.value; return value && "object" == _typeof(value) && hasOwn.call(value, "__await") ? PromiseImpl.resolve(value.__await).then(function (value) { invoke("next", value, resolve, reject); }, function (err) { invoke("throw", err, resolve, reject); }) : PromiseImpl.resolve(value).then(function (unwrapped) { result.value = unwrapped, resolve(result); }, function (error) { return invoke("throw", error, resolve, reject); }); } reject(record.arg); } var previousPromise; defineProperty(this, "_invoke", { value: function value(method, arg) { function callInvokeWithMethodAndArg() { return new PromiseImpl(function (resolve, reject) { invoke(method, arg, resolve, reject); }); } return previousPromise = previousPromise ? previousPromise.then(callInvokeWithMethodAndArg, callInvokeWithMethodAndArg) : callInvokeWithMethodAndArg(); } }); } function makeInvokeMethod(innerFn, self, context) { var state = "suspendedStart"; return function (method, arg) { if ("executing" === state) throw new Error("Generator is already running"); if ("completed" === state) { if ("throw" === method) throw arg; return doneResult(); } for (context.method = method, context.arg = arg;;) { var delegate = context.delegate; if (delegate) { var delegateResult = maybeInvokeDelegate(delegate, context); if (delegateResult) { if (delegateResult === ContinueSentinel) continue; return delegateResult; } } if ("next" === context.method) context.sent = context._sent = context.arg;else if ("throw" === context.method) { if ("suspendedStart" === state) throw state = "completed", context.arg; context.dispatchException(context.arg); } else "return" === context.method && context.abrupt("return", context.arg); state = "executing"; var record = tryCatch(innerFn, self, context); if ("normal" === record.type) { if (state = context.done ? "completed" : "suspendedYield", record.arg === ContinueSentinel) continue; return { value: record.arg, done: context.done }; } "throw" === record.type && (state = "completed", context.method = "throw", context.arg = record.arg); } }; } function maybeInvokeDelegate(delegate, context) { var methodName = context.method, method = delegate.iterator[methodName]; if (undefined === method) return context.delegate = null, "throw" === methodName && delegate.iterator["return"] && (context.method = "return", context.arg = undefined, maybeInvokeDelegate(delegate, context), "throw" === context.method) || "return" !== methodName && (context.method = "throw", context.arg = new TypeError("The iterator does not provide a '" + methodName + "' method")), ContinueSentinel; var record = tryCatch(method, delegate.iterator, context.arg); if ("throw" === record.type) return context.method = "throw", context.arg = record.arg, context.delegate = null, ContinueSentinel; var info = record.arg; return info ? info.done ? (context[delegate.resultName] = info.value, context.next = delegate.nextLoc, "return" !== context.method && (context.method = "next", context.arg = undefined), context.delegate = null, ContinueSentinel) : info : (context.method = "throw", context.arg = new TypeError("iterator result is not an object"), context.delegate = null, ContinueSentinel); } function pushTryEntry(locs) { var entry = { tryLoc: locs[0] }; 1 in locs && (entry.catchLoc = locs[1]), 2 in locs && (entry.finallyLoc = locs[2], entry.afterLoc = locs[3]), this.tryEntries.push(entry); } function resetTryEntry(entry) { var record = entry.completion || {}; record.type = "normal", delete record.arg, entry.completion = record; } function Context(tryLocsList) { this.tryEntries = [{ tryLoc: "root" }], tryLocsList.forEach(pushTryEntry, this), this.reset(!0); } function values(iterable) { if (iterable) { var iteratorMethod = iterable[iteratorSymbol]; if (iteratorMethod) return iteratorMethod.call(iterable); if ("function" == typeof iterable.next) return iterable; if (!isNaN(iterable.length)) { var i = -1, next = function next() { for (; ++i < iterable.length;) if (hasOwn.call(iterable, i)) return next.value = iterable[i], next.done = !1, next; return next.value = undefined, next.done = !0, next; }; return next.next = next; } } return { next: doneResult }; } function doneResult() { return { value: undefined, done: !0 }; } return GeneratorFunction.prototype = GeneratorFunctionPrototype, defineProperty(Gp, "constructor", { value: GeneratorFunctionPrototype, configurable: !0 }), defineProperty(GeneratorFunctionPrototype, "constructor", { value: GeneratorFunction, configurable: !0 }), GeneratorFunction.displayName = define(GeneratorFunctionPrototype, toStringTagSymbol, "GeneratorFunction"), exports.isGeneratorFunction = function (genFun) { var ctor = "function" == typeof genFun && genFun.constructor; return !!ctor && (ctor === GeneratorFunction || "GeneratorFunction" === (ctor.displayName || ctor.name)); }, exports.mark = function (genFun) { return Object.setPrototypeOf ? Object.setPrototypeOf(genFun, GeneratorFunctionPrototype) : (genFun.__proto__ = GeneratorFunctionPrototype, define(genFun, toStringTagSymbol, "GeneratorFunction")), genFun.prototype = Object.create(Gp), genFun; }, exports.awrap = function (arg) { return { __await: arg }; }, defineIteratorMethods(AsyncIterator.prototype), define(AsyncIterator.prototype, asyncIteratorSymbol, function () { return this; }), exports.AsyncIterator = AsyncIterator, exports.async = function (innerFn, outerFn, self, tryLocsList, PromiseImpl) { void 0 === PromiseImpl && (PromiseImpl = Promise); var iter = new AsyncIterator(wrap(innerFn, outerFn, self, tryLocsList), PromiseImpl); return exports.isGeneratorFunction(outerFn) ? iter : iter.next().then(function (result) { return result.done ? result.value : iter.next(); }); }, defineIteratorMethods(Gp), define(Gp, toStringTagSymbol, "Generator"), define(Gp, iteratorSymbol, function () { return this; }), define(Gp, "toString", function () { return "[object Generator]"; }), exports.keys = function (val) { var object = Object(val), keys = []; for (var key in object) keys.push(key); return keys.reverse(), function next() { for (; keys.length;) { var key = keys.pop(); if (key in object) return next.value = key, next.done = !1, next; } return next.done = !0, next; }; }, exports.values = values, Context.prototype = { constructor: Context, reset: function reset(skipTempReset) { if (this.prev = 0, this.next = 0, this.sent = this._sent = undefined, this.done = !1, this.delegate = null, this.method = "next", this.arg = undefined, this.tryEntries.forEach(resetTryEntry), !skipTempReset) for (var name in this) "t" === name.charAt(0) && hasOwn.call(this, name) && !isNaN(+name.slice(1)) && (this[name] = undefined); }, stop: function stop() { this.done = !0; var rootRecord = this.tryEntries[0].completion; if ("throw" === rootRecord.type) throw rootRecord.arg; return this.rval; }, dispatchException: function dispatchException(exception) { if (this.done) throw exception; var context = this; function handle(loc, caught) { return record.type = "throw", record.arg = exception, context.next = loc, caught && (context.method = "next", context.arg = undefined), !!caught; } for (var i = this.tryEntries.length - 1; i >= 0; --i) { var entry = this.tryEntries[i], record = entry.completion; if ("root" === entry.tryLoc) return handle("end"); if (entry.tryLoc <= this.prev) { var hasCatch = hasOwn.call(entry, "catchLoc"), hasFinally = hasOwn.call(entry, "finallyLoc"); if (hasCatch && hasFinally) { if (this.prev < entry.catchLoc) return handle(entry.catchLoc, !0); if (this.prev < entry.finallyLoc) return handle(entry.finallyLoc); } else if (hasCatch) { if (this.prev < entry.catchLoc) return handle(entry.catchLoc, !0); } else { if (!hasFinally) throw new Error("try statement without catch or finally"); if (this.prev < entry.finallyLoc) return handle(entry.finallyLoc); } } } }, abrupt: function abrupt(type, arg) { for (var i = this.tryEntries.length - 1; i >= 0; --i) { var entry = this.tryEntries[i]; if (entry.tryLoc <= this.prev && hasOwn.call(entry, "finallyLoc") && this.prev < entry.finallyLoc) { var finallyEntry = entry; break; } } finallyEntry && ("break" === type || "continue" === type) && finallyEntry.tryLoc <= arg && arg <= finallyEntry.finallyLoc && (finallyEntry = null); var record = finallyEntry ? finallyEntry.completion : {}; return record.type = type, record.arg = arg, finallyEntry ? (this.method = "next", this.next = finallyEntry.finallyLoc, ContinueSentinel) : this.complete(record); }, complete: function complete(record, afterLoc) { if ("throw" === record.type) throw record.arg; return "break" === record.type || "continue" === record.type ? this.next = record.arg : "return" === record.type ? (this.rval = this.arg = record.arg, this.method = "return", this.next = "end") : "normal" === record.type && afterLoc && (this.next = afterLoc), ContinueSentinel; }, finish: function finish(finallyLoc) { for (var i = this.tryEntries.length - 1; i >= 0; --i) { var entry = this.tryEntries[i]; if (entry.finallyLoc === finallyLoc) return this.complete(entry.completion, entry.afterLoc), resetTryEntry(entry), ContinueSentinel; } }, "catch": function _catch(tryLoc) { for (var i = this.tryEntries.length - 1; i >= 0; --i) { var entry = this.tryEntries[i]; if (entry.tryLoc === tryLoc) { var record = entry.completion; if ("throw" === record.type) { var thrown = record.arg; resetTryEntry(entry); } return thrown; } } throw new Error("illegal catch attempt"); }, delegateYield: function delegateYield(iterable, resultName, nextLoc) { return this.delegate = { iterator: values(iterable), resultName: resultName, nextLoc: nextLoc }, "next" === this.method && (this.arg = undefined), ContinueSentinel; } }, exports; }
function asyncGeneratorStep(gen, resolve, reject, _next, _throw, key, arg) { try { var info = gen[key](arg); var value = info.value; } catch (error) { reject(error); return; } if (info.done) { resolve(value); } else { Promise.resolve(value).then(_next, _throw); } }
function _asyncToGenerator(fn) { return function () { var self = this, args = arguments; return new Promise(function (resolve, reject) { var gen = fn.apply(self, args); function _next(value) { asyncGeneratorStep(gen, resolve, reject, _next, _throw, "next", value); } function _throw(err) { asyncGeneratorStep(gen, resolve, reject, _next, _throw, "throw", err); } _next(undefined); }); }; }
/* Theme Options - Utility Tab Button clicks */
var test_figma = /*#__PURE__*/function () {
  var _ref = _asyncToGenerator( /*#__PURE__*/_regeneratorRuntime().mark(function _callee(e) {
    var button, url, nonce, buttonwrap, responsearea, response;
    return _regeneratorRuntime().wrap(function _callee$(_context) {
      while (1) switch (_context.prev = _context.next) {
        case 0:
          e.preventDefault();
          /* This button should only live within the WP Admin Theme Options
           - ajaxurl is already defined in the WP Admin, but I'm putting 
           everything I need in one localized admin object */
          button = e.target.tagName === 'BUTTON' ? e.target : e.target.closest('button');
          url = theme_admin.ajaxurl + '/?action=test_figma';
          nonce = theme_admin.nonce;
          buttonwrap = button.closest('.buttonwrap');
          responsearea = buttonwrap ? buttonwrap.querySelector('.responsearea') : false;
          if (responsearea) {
            _context.next = 9;
            break;
          }
          console.log("No form response area found");
          return _context.abrupt("return", false);
        case 9:
          if (!(url && nonce)) {
            _context.next = 16;
            break;
          }
          _context.next = 12;
          return postit(url, 'nonce=' + nonce);
        case 12:
          response = _context.sent;
          if (response.status === 200) {
            responsearea.classList.remove('error', 'warning');
            responsearea.classList.add('success');
            responsearea.innerHTML = response.message;
          } else {
            if (response.message) {
              responsearea.classList.remove('success', 'warning');
              responsearea.classList.add('error');
              responsearea.innerHTML = response.message;
            } else {
              responsearea.classList.remove('success', 'warning');
              responsearea.classList.add('error');
              responsearea.innerHTML = "There was a problem with your request";
            }
          }
          _context.next = 17;
          break;
        case 16:
          console.log("Tried to run first setup but could not find URL or Nonce");
        case 17:
        case "end":
          return _context.stop();
      }
    }, _callee);
  }));
  return function test_figma(_x) {
    return _ref.apply(this, arguments);
  };
}();
var run_figma_import = /*#__PURE__*/function () {
  var _ref2 = _asyncToGenerator( /*#__PURE__*/_regeneratorRuntime().mark(function _callee2(e) {
    var button, url, item, nonce, buttonwrap, responsearea, response;
    return _regeneratorRuntime().wrap(function _callee2$(_context2) {
      while (1) switch (_context2.prev = _context2.next) {
        case 0:
          e.preventDefault();
          /* This button should only live within the WP Admin Theme Options
           - ajaxurl is already defined in the WP Admin, but I'm putting 
           everything I need in one localized admin object */
          button = e.target.tagName === 'BUTTON' ? e.target : e.target.closest('button');
          url = theme_admin.ajaxurl + '/?action=import_figma_styleguide';
          item = button.dataset.item;
          nonce = theme_admin.nonce;
          buttonwrap = button.closest('.buttonwrap');
          responsearea = buttonwrap ? buttonwrap.querySelector('.responsearea') : false;
          if (responsearea) {
            _context2.next = 10;
            break;
          }
          console.log("No form response area found");
          return _context2.abrupt("return", false);
        case 10:
          if (!(url && nonce)) {
            _context2.next = 17;
            break;
          }
          _context2.next = 13;
          return postit(url, 'nonce=' + nonce + '&item=' + item);
        case 13:
          response = _context2.sent;
          if (response.status === 200) {
            responsearea.classList.remove('error', 'warning');
            responsearea.classList.add('success');
            responsearea.innerHTML = response.message;
          } else {
            if (response.message) {
              responsearea.classList.remove('success', 'warning');
              responsearea.classList.add('error');
              responsearea.innerHTML = response.message;
            } else {
              responsearea.classList.remove('success', 'warning');
              responsearea.classList.add('error');
              responsearea.innerHTML = "There was a problem with your request";
            }
          }
          _context2.next = 18;
          break;
        case 17:
          console.log("Tried to run Figma import but could not find URL or Nonce");
        case 18:
        case "end":
          return _context2.stop();
      }
    }, _callee2);
  }));
  return function run_figma_import(_x2) {
    return _ref2.apply(this, arguments);
  };
}();
var get_figma_item = /*#__PURE__*/function () {
  var _ref3 = _asyncToGenerator( /*#__PURE__*/_regeneratorRuntime().mark(function _callee3(e) {
    var button, url, item, nonce, buttonwrap, responsearea, response;
    return _regeneratorRuntime().wrap(function _callee3$(_context3) {
      while (1) switch (_context3.prev = _context3.next) {
        case 0:
          e.preventDefault();
          /* This button should only live within the WP Admin Theme Options
           - ajaxurl is already defined in the WP Admin, but I'm putting 
           everything I need in one localized admin object */
          button = e.target.tagName === 'BUTTON' ? e.target : e.target.closest('button');
          url = theme_admin.ajaxurl + '/?action=get_figma_item';
          item = button.dataset.item;
          nonce = theme_admin.nonce;
          buttonwrap = button.closest('.buttonwrap');
          responsearea = buttonwrap ? buttonwrap.querySelector('.responsearea') : false;
          if (responsearea) {
            _context3.next = 10;
            break;
          }
          console.log("No form response area found");
          return _context3.abrupt("return", false);
        case 10:
          if (!(url && nonce)) {
            _context3.next = 17;
            break;
          }
          _context3.next = 13;
          return postit(url, 'nonce=' + nonce + '&item=' + item);
        case 13:
          response = _context3.sent;
          if (response.status === 200) {
            responsearea.classList.remove('error', 'warning');
            responsearea.classList.add('success');
            responsearea.innerHTML = response.message;
          } else {
            if (response.message) {
              responsearea.classList.remove('success', 'warning');
              responsearea.classList.add('error');
              responsearea.innerHTML = response.message;
            } else {
              responsearea.classList.remove('success', 'warning');
              responsearea.classList.add('error');
              responsearea.innerHTML = "There was a problem with your request";
            }
          }
          _context3.next = 18;
          break;
        case 17:
          console.log("Tried to run first setup but could not find URL or Nonce");
        case 18:
        case "end":
          return _context3.stop();
      }
    }, _callee3);
  }));
  return function get_figma_item(_x3) {
    return _ref3.apply(this, arguments);
  };
}();
var test_figma_item = /*#__PURE__*/function () {
  var _ref4 = _asyncToGenerator( /*#__PURE__*/_regeneratorRuntime().mark(function _callee4(e) {
    var button, url, item, nonce, buttonwrap, responsearea, response;
    return _regeneratorRuntime().wrap(function _callee4$(_context4) {
      while (1) switch (_context4.prev = _context4.next) {
        case 0:
          e.preventDefault();
          /* This button should only live within the WP Admin Theme Options
           - ajaxurl is already defined in the WP Admin, but I'm putting 
           everything I need in one localized admin object */
          button = e.target.tagName === 'BUTTON' ? e.target : e.target.closest('button');
          url = theme_admin.ajaxurl + '/?action=test_figma_item';
          item = button.dataset.item;
          nonce = theme_admin.nonce;
          buttonwrap = button.closest('.buttonwrap');
          responsearea = buttonwrap ? buttonwrap.querySelector('.responsearea') : false;
          if (responsearea) {
            _context4.next = 10;
            break;
          }
          console.log("No form response area found");
          return _context4.abrupt("return", false);
        case 10:
          if (!(url && nonce)) {
            _context4.next = 18;
            break;
          }
          console.log("doig test item");
          _context4.next = 14;
          return postit(url, 'nonce=' + nonce + '&item=' + item);
        case 14:
          response = _context4.sent;
          if (response.status === 200) {
            responsearea.classList.remove('error', 'warning');
            responsearea.classList.add('success');
            responsearea.innerHTML = response.message;
          } else {
            if (response.message) {
              responsearea.classList.remove('success', 'warning');
              responsearea.classList.add('error');
              responsearea.innerHTML = response.message;
            } else {
              responsearea.classList.remove('success', 'warning');
              responsearea.classList.add('error');
              responsearea.innerHTML = "There was a problem with your request";
            }
          }
          _context4.next = 19;
          break;
        case 18:
          console.log("Tried to run first setup but could not find URL or Nonce");
        case 19:
        case "end":
          return _context4.stop();
      }
    }, _callee4);
  }));
  return function test_figma_item(_x4) {
    return _ref4.apply(this, arguments);
  };
}();
var gmap_sync = /*#__PURE__*/function () {
  var _ref5 = _asyncToGenerator( /*#__PURE__*/_regeneratorRuntime().mark(function _callee5(e) {
    var button, url, nonce, buttonwrap, responsearea, response;
    return _regeneratorRuntime().wrap(function _callee5$(_context5) {
      while (1) switch (_context5.prev = _context5.next) {
        case 0:
          e.preventDefault();
          /* This button should only live within the WP Admin Theme Options
           - ajaxurl is already defined in the WP Admin, but I'm putting 
           everything I need in one localized admin object */
          button = e.target.tagName === 'BUTTON' ? e.target : e.target.closest('button');
          url = theme_admin.ajaxurl + '/?action=sync_map_data';
          nonce = theme_admin.nonce;
          buttonwrap = button.closest('.buttonwrap');
          responsearea = buttonwrap ? buttonwrap.querySelector('.responsearea') : false;
          if (responsearea) {
            _context5.next = 9;
            break;
          }
          console.log("No form response area found");
          return _context5.abrupt("return", false);
        case 9:
          if (!(url && nonce)) {
            _context5.next = 16;
            break;
          }
          _context5.next = 12;
          return postit(url, 'nonce=' + nonce);
        case 12:
          response = _context5.sent;
          if (response.status === 200) {
            responsearea.classList.remove('error', 'warning');
            responsearea.classList.add('success');
            responsearea.innerHTML = response.message;
          } else {
            if (response.message) {
              responsearea.classList.remove('success', 'warning');
              responsearea.classList.add('error');
              responsearea.innerHTML = response.message;
            } else {
              responsearea.classList.remove('success', 'warning');
              responsearea.classList.add('error');
              responsearea.innerHTML = "There was a problem with your request";
            }
          }
          _context5.next = 17;
          break;
        case 16:
          console.log("Tried to run sync data but could not find URL or Nonce");
        case 17:
        case "end":
          return _context5.stop();
      }
    }, _callee5);
  }));
  return function gmap_sync(_x5) {
    return _ref5.apply(this, arguments);
  };
}();
var run_first_setup = /*#__PURE__*/function () {
  var _ref6 = _asyncToGenerator( /*#__PURE__*/_regeneratorRuntime().mark(function _callee6(e) {
    var button, url, nonce, buttonwrap, responsearea, response;
    return _regeneratorRuntime().wrap(function _callee6$(_context6) {
      while (1) switch (_context6.prev = _context6.next) {
        case 0:
          e.preventDefault();
          /* This button should only live within the WP Admin Theme Options
           - ajaxurl is already defined in the WP Admin, but I'm putting 
           everything I need in one localized admin object */
          button = e.target.tagName === 'BUTTON' ? e.target : e.target.closest('button');
          url = theme_admin.ajaxurl + '/?action=run_setup';
          nonce = theme_admin.nonce;
          buttonwrap = button.closest('.buttonwrap');
          responsearea = buttonwrap ? buttonwrap.querySelector('.responsearea') : false;
          if (responsearea) {
            _context6.next = 9;
            break;
          }
          console.log("No form response area found");
          return _context6.abrupt("return", false);
        case 9:
          if (!(url && nonce)) {
            _context6.next = 16;
            break;
          }
          _context6.next = 12;
          return postit(url, 'nonce=' + nonce);
        case 12:
          response = _context6.sent;
          if (response.status === 200) {
            responsearea.classList.remove('error', 'warning');
            responsearea.classList.add('success');
            responsearea.innerHTML = response.message;
          } else {
            if (response.message) {
              responsearea.classList.remove('success', 'warning');
              responsearea.classList.add('error');
              responsearea.innerHTML = response.message;
            } else {
              responsearea.classList.remove('success', 'warning');
              responsearea.classList.add('error');
              responsearea.innerHTML = "There was a problem with your request";
            }
          }
          _context6.next = 17;
          break;
        case 16:
          console.log("Tried to run first setup but could not find URL or Nonce");
        case 17:
        case "end":
          return _context6.stop();
      }
    }, _callee6);
  }));
  return function run_first_setup(_x6) {
    return _ref6.apply(this, arguments);
  };
}();
var run_critical_css = /*#__PURE__*/function () {
  var _ref7 = _asyncToGenerator( /*#__PURE__*/_regeneratorRuntime().mark(function _callee7(e) {
    var button, url, nonce, buttonwrap, responsearea, response;
    return _regeneratorRuntime().wrap(function _callee7$(_context7) {
      while (1) switch (_context7.prev = _context7.next) {
        case 0:
          e.preventDefault();
          button = e.target.tagName === 'BUTTON' ? e.target : e.target.closest('button');
          url = theme_admin.ajaxurl + '/?action=run_critical_css';
          nonce = theme_admin.nonce;
          buttonwrap = button.closest('.buttonwrap');
          responsearea = buttonwrap ? buttonwrap.querySelector('.responsearea') : false;
          if (responsearea) {
            _context7.next = 9;
            break;
          }
          console.log("No form response area found");
          return _context7.abrupt("return", false);
        case 9:
          if (!(url && nonce)) {
            _context7.next = 16;
            break;
          }
          _context7.next = 12;
          return postit(url, 'nonce=' + nonce);
        case 12:
          response = _context7.sent;
          if (response.status === 200) {
            responsearea.classList.remove('error', 'warning');
            responsearea.classList.add('success');
            responsearea.innerHTML = response.message;
          } else {
            if (response.message) {
              responsearea.classList.remove('success', 'warning');
              responsearea.classList.add('error');
              responsearea.innerHTML = response.message;
            } else {
              responsearea.classList.remove('success', 'warning');
              responsearea.classList.add('error');
              responsearea.innerHTML = "There was a problem with your request";
            }
          }
          _context7.next = 17;
          break;
        case 16:
          console.log("Tried to create Critical CSS but could not find URL or Nonce");
        case 17:
        case "end":
          return _context7.stop();
      }
    }, _callee7);
  }));
  return function run_critical_css(_x7) {
    return _ref7.apply(this, arguments);
  };
}();

/* Standard Wordpress POST request via native fetch using form-urlencoded data */
var postit = /*#__PURE__*/function () {
  var _ref8 = _asyncToGenerator( /*#__PURE__*/_regeneratorRuntime().mark(function _callee8(location, senddata) {
    var settings, fetchResponse, receivedata;
    return _regeneratorRuntime().wrap(function _callee8$(_context8) {
      while (1) switch (_context8.prev = _context8.next) {
        case 0:
          settings = {
            method: 'POST',
            headers: {
              'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: senddata
          };
          _context8.prev = 1;
          _context8.next = 4;
          return fetch(location, settings);
        case 4:
          fetchResponse = _context8.sent;
          _context8.next = 7;
          return fetchResponse.json();
        case 7:
          receivedata = _context8.sent;
          return _context8.abrupt("return", receivedata);
        case 11:
          _context8.prev = 11;
          _context8.t0 = _context8["catch"](1);
          console.log(_context8.t0);
          return _context8.abrupt("return", _context8.t0);
        case 15:
        case "end":
          return _context8.stop();
      }
    }, _callee8, null, [[1, 11]]);
  }));
  return function postit(_x8, _x9) {
    return _ref8.apply(this, arguments);
  };
}();

/***/ })

/******/ });
//# sourceMappingURL=admin.js.map