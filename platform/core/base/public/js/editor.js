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

/***/ "./platform/core/base/resources/assets/js/editor.js":
/*!**********************************************************!*\
  !*** ./platform/core/base/resources/assets/js/editor.js ***!
  \**********************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } }

function _createClass(Constructor, protoProps, staticProps) { if (protoProps) _defineProperties(Constructor.prototype, protoProps); if (staticProps) _defineProperties(Constructor, staticProps); return Constructor; }

var EditorManagement =
/*#__PURE__*/
function () {
  function EditorManagement() {
    _classCallCheck(this, EditorManagement);
  }

  _createClass(EditorManagement, [{
    key: "initCkEditor",
    value: function initCkEditor(element, extraConfig) {
      var config = {
        filebrowserImageBrowseUrl: RV_MEDIA_URL.base + '?media-action=select-files&method=ckeditor&type=image',
        filebrowserImageUploadUrl: RV_MEDIA_URL.media_upload_from_editor + '?method=ckeditor&type=image&_token=' + $('meta[name="csrf-token"]').attr('content'),
        filebrowserWindowWidth: '1200',
        filebrowserWindowHeight: '750',
        height: $('#' + element).prop('rows') * 90,
        allowedContent: true
      };
      var mergeConfig = {};
      $.extend(mergeConfig, config, extraConfig);
      CKEDITOR.replace(element, mergeConfig);
    }
  }, {
    key: "initTinyMce",
    value: function initTinyMce(element) {
      tinymce.init({
        menubar: true,
        selector: '#' + element,
        skin: 'voyager',
        min_height: $('#' + element).prop('rows') * 75,
        resize: 'vertical',
        plugins: 'code autolink advlist visualchars link image media table charmap hr pagebreak nonbreaking anchor insertdatetime lists textcolor wordcount imagetools  contextmenu  visualblocks',
        extended_valid_elements: 'input[id|name|value|type|class|style|required|placeholder|autocomplete|onclick]',
        file_browser_callback: function file_browser_callback(field_name, url, type) {
          if (type === 'image') {
            $('#upload_file').trigger('click');
          }
        },
        toolbar: 'formatselect | bold italic strikethrough forecolor backcolor | link image table | alignleft aligncenter alignright alignjustify  | numlist bullist indent  |  visualblocks code',
        convert_urls: false,
        image_caption: true,
        image_advtab: true,
        image_title: true,
        entity_encoding: 'raw',
        content_style: '.mce-content-body {padding: 10px}',
        contextmenu: 'link image inserttable | cell row column deletetable',
        bootstrapConfig: {
          imagesPath: '/uploads'
        }
      });
    }
  }, {
    key: "initEditor",
    value: function initEditor(element, extraConfig, type) {
      var current = this;

      if (element.length) {
        switch (type) {
          case 'ckeditor':
            $.each(element, function (index, item) {
              current.initCkEditor($(item).prop('id'), extraConfig);
            });
            break;

          case 'tinymce':
            $.each(element, function (index, item) {
              current.initTinyMce($(item).prop('id'));
            });
            break;
        }
      }
    }
  }, {
    key: "init",
    value: function init() {
      var $ckEditor = $('.editor-ckeditor');
      var $tinyMce = $('.editor-tinymce');

      if ($ckEditor.length > 0) {
        this.initEditor($ckEditor, {}, 'ckeditor');
      }

      if ($tinyMce.length > 0) {
        this.initEditor($tinyMce, {}, 'tinymce');
      }

      var current = this;
      $(document).on('click', '.show-hide-editor-btn', function (event) {
        event.preventDefault();

        var _self = $(event.currentTarget);

        var $result = $('#' + _self.data('result'));

        if ($result.hasClass('editor-ckeditor')) {
          if (CKEDITOR.instances[_self.data('result')] && typeof CKEDITOR.instances[_self.data('result')] !== 'undefined') {
            CKEDITOR.instances[_self.data('result')].updateElement();

            CKEDITOR.instances[_self.data('result')].destroy();

            $('.editor-action-item').not('.action-show-hide-editor').hide();
          } else {
            current.initCkEditor(_self.data('result'), {}, 'ckeditor');
            $('.editor-action-item').not('.action-show-hide-editor').show();
          }
        } else if ($result.hasClass('editor-tinymce')) {
          tinymce.execCommand('mceToggleEditor', false, _self.data('result'));
        }
      });
    }
  }]);

  return EditorManagement;
}();

$(document).ready(function () {
  new EditorManagement().init();
});

/***/ }),

/***/ 2:
/*!****************************************************************!*\
  !*** multi ./platform/core/base/resources/assets/js/editor.js ***!
  \****************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! D:\xampp\htdocs\dao\platform\core\base\resources\assets\js\editor.js */"./platform/core/base/resources/assets/js/editor.js");


/***/ })

/******/ });