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
/******/ 	return __webpack_require__(__webpack_require__.s = 17);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./platform/packages/catalog/resources/assets/js/catalog.js":
/*!*****************************************************************!*\
  !*** ./platform/packages/catalog/resources/assets/js/catalog.js ***!
  \*****************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } }

function _createClass(Constructor, protoProps, staticProps) { if (protoProps) _defineProperties(Constructor.prototype, protoProps); if (staticProps) _defineProperties(Constructor, staticProps); return Constructor; }

var Catalog =
/*#__PURE__*/
function () {
  function Catalog() {
    _classCallCheck(this, Catalog);
  }

  _createClass(Catalog, null, [{
    key: "changeZone",
    value: function changeZone($element) {
      var $branch = $(document).find('select[data-type=branch]');

      if ($element.data('related-branch')) {
        $branch = $(document).find('#' + $element.data('related-branch'));
      }

      var url = $element.data('change-zone-url');

      if (url !== null && url !== '' && $element.val() !== '') {
        $.ajax({
          url: url,
          type: 'POST',
          data: {
            'zone_id': $element.val()
          },
          beforeSend: function beforeSend() {
            $element.closest('form').find('button[type=submit], input[type=submit]').prop('disabled', true);
          },
          success: function success(data) {
            // let option = '<option value="">' + ($branch.data('placeholder')) + '</option>';
            var option = '';
            $.each(data.data, function (index, item) {
              if (item.id === $branch.data('origin-value')) {
                option += '<option value="' + item.id + '" selected="selected">' + item.code + ' - ' + item.name + '</option>';
              } else {
                option += '<option value="' + item.id + '">' + item.code + ' - ' + item.name + '</option>';
              }
            });
            $branch.html(option);
            $element.closest('form').find('button[type=submit], input[type=submit]').prop('disabled', false);
          }
        });
      }
    }
  }]);

  return Catalog;
}();

$(document).ready(function () {
  var $zone_fields = $(document).find('select[data-type=zone]');

  if ($zone_fields.length > 0) {
    $.each($zone_fields, function (index, el) {
      Catalog.changeZone($(el));
    });
    $(document).on('change', 'select[data-type=zone]', function (event) {
      Catalog.changeZone($(event.currentTarget));
    });
  }
});

/***/ }),

/***/ 17:
/*!***********************************************************************!*\
  !*** multi ./platform/packages/catalog/resources/assets/js/catalog.js ***!
  \***********************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! /Users/haha8x/Project/htdocs/dao/platform/packages/catalog/resources/assets/js/catalog.js */"./platform/packages/catalog/resources/assets/js/catalog.js");


/***/ })

/******/ });