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
/******/ 	return __webpack_require__(__webpack_require__.s = "./src/js/blocks/block.js");
/******/ })
/************************************************************************/
/******/ ({

/***/ "./src/js/blocks/block.js":
/*!********************************!*\
  !*** ./src/js/blocks/block.js ***!
  \********************************/
/*! no static exports found */
/***/ (function(module, exports) {

eval("var __ = wp.i18n.__; // Import __() from wp.i18n\n\nvar registerBlockType = wp.blocks.registerBlockType; // Import registerBlockType() from wp.blocks\n\n/**\r\n * Register: aa Gutenberg Block.\r\n *\r\n * Registers a new block provided a unique name and an object defining its\r\n * behavior. Once registered, the block is made editor as an option to any\r\n * editor interface where blocks are implemented.\r\n *\r\n * @link https://wordpress.org/gutenberg/handbook/block-api/\r\n * @param  {string}   name     Block name.\r\n * @param  {Object}   settings Block settings.\r\n * @return {?WPBlock}          The block, if it has been successfully\r\n *                             registered; otherwise `undefined`.\r\n */\n\nregisterBlockType('cgb/block-first', {\n  // Block name. Block names must be string that contains a namespace prefix. Example: my-plugin/my-custom-block.\n  title: __('first - CGB Block'),\n  // Block title.\n  icon: 'shield',\n  // Block icon from Dashicons → https://developer.wordpress.org/resource/dashicons/.\n  category: 'common',\n  // Block category — Group blocks together based on common traits E.g. common, formatting, layout widgets, embed.\n  keywords: [__('first — CGB Block'), __('CGB Example'), __('create-guten-block')],\n\n  /**\r\n   * The edit function describes the structure of your block in the context of the editor.\r\n   * This represents what the editor will render when the block is used.\r\n   *\r\n   * The \"edit\" property must be a valid function.\r\n   *\r\n   * @link https://wordpress.org/gutenberg/handbook/block-api/block-edit-save/\r\n   *\r\n   * @param {Object} props Props.\r\n   * @returns {Mixed} JSX Component.\r\n   */\n  edit: function edit(props) {\n    // Creates a <p class='wp-block-cgb-block-first'></p>.\n    return /*#__PURE__*/React.createElement(\"div\", {\n      className: props.className\n    }, /*#__PURE__*/React.createElement(\"p\", null, \"\\u2014 Hello from the backend.\"), /*#__PURE__*/React.createElement(\"p\", null, \"CGB BLOCK: \", /*#__PURE__*/React.createElement(\"code\", null, \"first\"), \" is a new Gutenberg block\"), /*#__PURE__*/React.createElement(\"p\", null, \"It was created via\", ' ', /*#__PURE__*/React.createElement(\"code\", null, /*#__PURE__*/React.createElement(\"a\", {\n      href: \"https://github.com/ahmadawais/create-guten-block\"\n    }, \"create-guten-block\")), \".\"));\n  },\n\n  /**\r\n   * The save function defines the way in which the different attributes should be combined\r\n   * into the final markup, which is then serialized by Gutenberg into post_content.\r\n   *\r\n   * The \"save\" property must be specified and must be a valid function.\r\n   *\r\n   * @link https://wordpress.org/gutenberg/handbook/block-api/block-edit-save/\r\n   *\r\n   * @param {Object} props Props.\r\n   * @returns {Mixed} JSX Frontend HTML.\r\n   */\n  save: function save(props) {\n    return /*#__PURE__*/React.createElement(\"div\", {\n      className: props.className\n    }, /*#__PURE__*/React.createElement(\"p\", null, \"\\u2014 Hello from the frontend.\"), /*#__PURE__*/React.createElement(\"p\", null, \"CGB BLOCK: \", /*#__PURE__*/React.createElement(\"code\", null, \"first\"), \" is a new Gutenberg block.\"), /*#__PURE__*/React.createElement(\"p\", null, \"It was created via\", ' ', /*#__PURE__*/React.createElement(\"code\", null, /*#__PURE__*/React.createElement(\"a\", {\n      href: \"https://github.com/ahmadawais/create-guten-block\"\n    }, \"create-guten-block\")), \".\"));\n  }\n});\n\n//# sourceURL=webpack:///./src/js/blocks/block.js?");

/***/ })

/******/ });