/******/ (function() { // webpackBootstrap
/******/ 	var __webpack_modules__ = ({

/***/ "./src/js/auth-reg.js":
/*!****************************!*\
  !*** ./src/js/auth-reg.js ***!
  \****************************/
/***/ (function() {

var regUser = function regUser() {
  var regSubmitBtn = document.querySelector('#reg-submit');
  if (regSubmitBtn) {
    var userName = document.querySelector('#user_name');
    var emailAddress = document.querySelector('#user_login');
    var password = document.querySelector('#user_pass');
    var nonce = document.querySelector('#hello_nonce');
    var regPageWarning = document.querySelector('.auth-page__warning');
    regSubmitBtn.addEventListener('click', function (e) {
      e.preventDefault();
      jQuery(document).ready(function ($) {
        $.ajax({
          type: 'POST',
          url: '/wp-admin/admin-ajax.php',
          data: {
            action: 'hello_register',
            email_reg: emailAddress.value,
            password: password.value,
            user_name: userName.value,
            nonce: nonce.value
          },
          success: function success(data) {
            console.dir(data);
            var data_fin = JSON.parse(data);
            if (data_fin.class == 'errors') {
              regPageWarning.innerHTML = '';
              for (var key in data_fin) {
                if (key !== 'class') {
                  console.log(key + ': ' + data_fin[key]);
                  regPageWarning.insertAdjacentHTML('beforeend', "\n                                      <div class=\"notification error\">\n                                        <p>".concat(data_fin[key], "</p>\n                                        <a class=\"close\" href=\"#\"></a>\n                                      </div>"));
                }
              }
            } else {
              window.location.href = '/auth';
            }
          },
          error: function error() {
            console.log('Ошибка отправки.');
          }
        });
      });
    });
  }
};
regUser();

/***/ }),

/***/ "./src/js/form.js":
/*!************************!*\
  !*** ./src/js/form.js ***!
  \************************/
/***/ (function() {

var addCandidate = function addCandidate() {
  var selects = document.querySelectorAll('.forms__item-item__select');
  if (selects.length > 0) {
    var optionsItems = document.querySelectorAll('.options-items span');
    var questionsBrancherBtn = document.querySelectorAll('#questions-brancher-btn');
    selects.forEach(function (item) {
      item.addEventListener('click', function (e) {
        item.children[2].classList.toggle('active');
      });
    });
    optionsItems.forEach(function (item) {
      item.addEventListener('click', function (e) {
        item.parentElement.parentElement.children[0].innerText = item.innerText;
        item.parentElement.parentElement.children[3].value = item.innerText;
        if (item.parentElement.parentElement.children[4]) {
          item.parentElement.parentElement.children[4].value = item.id;
        }
      });
    });
    questionsBrancherBtn.forEach(function (item) {
      item.addEventListener('click', function (e) {
        item.parentElement.style.display = 'none';
        item.parentElement.parentElement.classList.add('active');
        item.parentElement.parentElement.children[1].classList.add('active');
      });
    });
  }
  var optionsItemsEva = document.querySelectorAll('.options-items span');
  if (optionsItemsEva.length > 0) {
    optionsItemsEva.forEach(function (item) {
      item.addEventListener('click', function (e) {
        item.parentElement.parentElement.children[0].innerText = item.innerText;
        item.parentElement.parentElement.children[3].value = item.innerText;
      });
    });
  }
};
addCandidate();

/***/ }),

/***/ "./src/js/main.js":
/*!************************!*\
  !*** ./src/js/main.js ***!
  \************************/
/***/ (function() {

function _slicedToArray(arr, i) { return _arrayWithHoles(arr) || _iterableToArrayLimit(arr, i) || _unsupportedIterableToArray(arr, i) || _nonIterableRest(); }
function _nonIterableRest() { throw new TypeError("Invalid attempt to destructure non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); }
function _unsupportedIterableToArray(o, minLen) { if (!o) return; if (typeof o === "string") return _arrayLikeToArray(o, minLen); var n = Object.prototype.toString.call(o).slice(8, -1); if (n === "Object" && o.constructor) n = o.constructor.name; if (n === "Map" || n === "Set") return Array.from(o); if (n === "Arguments" || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)) return _arrayLikeToArray(o, minLen); }
function _arrayLikeToArray(arr, len) { if (len == null || len > arr.length) len = arr.length; for (var i = 0, arr2 = new Array(len); i < len; i++) arr2[i] = arr[i]; return arr2; }
function _iterableToArrayLimit(arr, i) { var _i = null == arr ? null : "undefined" != typeof Symbol && arr[Symbol.iterator] || arr["@@iterator"]; if (null != _i) { var _s, _e, _x, _r, _arr = [], _n = !0, _d = !1; try { if (_x = (_i = _i.call(arr)).next, 0 === i) { if (Object(_i) !== _i) return; _n = !1; } else for (; !(_n = (_s = _x.call(_i)).done) && (_arr.push(_s.value), _arr.length !== i); _n = !0); } catch (err) { _d = !0, _e = err; } finally { try { if (!_n && null != _i.return && (_r = _i.return(), Object(_r) !== _r)) return; } finally { if (_d) throw _e; } } return _arr; } }
function _arrayWithHoles(arr) { if (Array.isArray(arr)) return arr; }
var copyQuest = function copyQuest() {
  var writeBtn = document.querySelector('#copy-questions');
  var inputEl = document.querySelector('.to-copy');
  var title = document.querySelector('h1.entry-title');
  var name = document.querySelector('#name');
  var inputElObj = document.querySelectorAll('.to-copy p');
  var questionsIt = '';
  inputElObj.forEach(function (item) {
    questionsIt = questionsIt + item.innerText.trim() + '\r\n';
  });
  if (writeBtn) {
    writeBtn.addEventListener('click', function (e) {
      var inputElObj = document.querySelectorAll('.to-copy p');
      var questionsIt = '';
      inputElObj.forEach(function (item) {
        questionsIt = questionsIt + item.innerText.trim() + '\r\n';
      });
      if (title) {
        var text = title.innerText.trim() + '\r\n' + questionsIt;
      } else if (name) {
        var text = name.value.trim() + '\r\n' + questionsIt;
      } else {
        var text = questionsIt;
      }
      navigator.clipboard.writeText(text).then(function () {
        console.log('Text copied to clipboard');
      }).catch(function (err) {
        console.error('Error in copying text: ', err);
      });
    });
  }
};
copyQuest();
var updateCandidat = function updateCandidat() {
  var updateCandidateSubmit = document.querySelector('#update-candidate-submit');
  if (updateCandidateSubmit) {
    updateCandidateSubmit.addEventListener('click', function (e) {
      var questionsItems = document.querySelectorAll('p.question-item');
      var questions = [];
      questionsItems.forEach(function (item, i) {
        questions[i] = item.innerText;
      });
      var answer = document.querySelector('textarea#answer');
      var status = document.querySelector('#status');
      updateCand(questions, answer, status.value);
    });
  }
};
updateCandidat();
var submitEva = function submitEva() {
  var gradeQuestions = document.querySelector('#grade-questions');
  if (gradeQuestions) {
    gradeQuestions.addEventListener('click', function (e) {
      var text = document.querySelector('#answer').value;
      var position = document.querySelector('#candidates_position').value;
      var level = document.querySelector('#level').value;
      var result = document.querySelector('#result');
      var dopInfo = document.querySelector('#dop-info');
      var postId = document.querySelector('#post_id');
      var loader = document.querySelector('#js-loader');
      loader.classList.remove("no-active");
      jQuery(document).ready(function ($) {
        $.ajax({
          type: 'POST',
          url: '/wp-admin/admin-ajax.php',
          data: {
            action: 'text_generated_new',
            // text_generated
            //instructions: instruction,
            text: text,
            position: position,
            level: level,
            post_id: postId.value
            //enLsChek: enLsChek
            //number: generateNumber
          },

          //dataType: "json",
          success: function success(data) {
            loader.classList.add("no-active");
            var str = data.replace(/[0-9]/g, '');
            var num = data.replace(/[^0-9]/g, '');
            dopInfo.innerHTML = '';
            dopInfo.insertAdjacentHTML('beforeend', str);
            result.innerHTML = '';
            if (num > 2) {
              num = num.substring(0, 2);
            } else {
              num = num;
            }
            if (num <= 60) {
              result.innerHTML = 'LOW';
            } else if (num >= 90) {
              result.innerHTML = 'TOP';
            } else {
              result.innerHTML = 'MEDIUM';
            }
            //console.dir(data);
          },

          error: function error() {
            console.log('Ошибка отправки.');
            loader.classList.add("no-active");
            dopInfo.innerHTML = '';
            dopInfo.insertAdjacentHTML('beforeend', '<span style="color:red; font-weight:600;">ERROR</span>');
          }
        });
      });
    });
  }
};
submitEva();
var evaluatedCand = function evaluatedCand() {
  var selects = document.querySelectorAll('.forms__item-item__select');
  if (selects.length > 0) {
    var options = document.querySelectorAll('.options-items span');
    var currentUser = document.querySelector('#current_user_id');
    var nonce = document.querySelector('#hello_nonce');
    options.forEach(function (item) {
      item.addEventListener('click', function (e) {
        //console.dir(evaluated);
        var postId = item.parentElement.parentElement.dataset.post;
        var evaluatedVal = item.innerText;
        //console.dir(postId);
        jQuery(document).ready(function ($) {
          $.ajax({
            url: "/wp-admin/admin-ajax.php",
            method: 'post',
            data: {
              action: 'evaluated_candidates',
              evaluated: evaluatedVal,
              post_id: postId,
              author: currentUser.value,
              nonce: nonce.value
            },
            success: function success(data) {
              var data_json = JSON.parse(data);
              //console.dir(data);
            },

            error: function error(jqXHR, text, _error) {}
          });
        });
      });
    });
  }
};
evaluatedCand();
function updateCand(questions, answer, status) {
  var currentUser = document.querySelector('#current_user_id');
  var postId = document.querySelector('#post_id');
  var nonce = document.querySelector('#hello_nonce');
  var result = document.querySelector('#result');
  var dopInfo = document.querySelector('#dop-info');
  var candidatesPosition = document.querySelector('#candidates-position');
  var level = document.querySelector('#level');
  var name = document.querySelector('#name');
  var email = document.querySelector('#email');
  var form = document.querySelector('form#add-candidate');
  var formData = new FormData(form);
  formData.append('questions', questions);
  formData.append('answer', answer.value);
  formData.append('status', status);
  formData.append('action', 'update_candidates');
  formData.append('author', currentUser.value);
  formData.append('post_id', postId.value);
  formData.append('nonce', nonce.value);
  jQuery(document).ready(function ($) {
    $.ajax({
      url: "/wp-admin/admin-ajax.php",
      method: 'post',
      processData: false,
      contentType: false,
      data: formData,
      // data: {
      //     action: 'update_candidates',
      //     name: name.value,
      //     email: email.value,
      //     position: candidatesPosition.value,
      //     level: level.value,
      //     questions: questions,
      //     answer: answer.value,
      //     status: status,
      //     result: result.innerText,
      //     dopInfo: dopInfo.innerText,
      //     post_id: postId.value,
      //     author: currentUser.value,
      //     nonce: nonce.value
      // },
      success: function success(data) {
        var data_json = JSON.parse(data);
        // console.dir(data_json);
        // console.dir(data);
        location.reload();
      },
      error: function error(jqXHR, text, _error2) {}
    });
  });
}
var textareaValidate = function textareaValidate() {
  var answer = document.querySelector('textarea#answer');
  if (answer) {
    var addCandidateSubmit = document.querySelector('#add-candidate-submit');
    var gradeQuestions = document.querySelector('#grade-questions');
    var answerCount = document.querySelector('#answer-count');
    answerCount.innerText = answer.value.length;
    if (answer.checkValidity()) {
      gradeQuestions.disabled = false;
      gradeQuestions.style.pointerEvents = 'auto';
      gradeQuestions.style.cursor = 'pointer';
    } else {
      gradeQuestions.disabled = true;
      gradeQuestions.style.pointerEvents = '';
      gradeQuestions.style.cursor = 'default';
    }
    if (answer.value.length >= 8000) {
      gradeQuestions.disabled = true;
      gradeQuestions.style.pointerEvents = '';
      gradeQuestions.style.cursor = 'default';
    }
    answer.addEventListener('input', function (e) {
      //console.dir(answer.checkValidity());
      answerCount.innerText = answer.value.length;
      if (answer.checkValidity()) {
        gradeQuestions.disabled = false;
        gradeQuestions.style.pointerEvents = 'auto';
        gradeQuestions.style.cursor = 'pointer';
      } else {
        gradeQuestions.disabled = true;
        gradeQuestions.style.pointerEvents = '';
        gradeQuestions.style.cursor = 'default';
      }
      if (answer.value.length >= 8000) {
        gradeQuestions.disabled = true;
        gradeQuestions.style.pointerEvents = '';
        gradeQuestions.style.cursor = 'default';
      }
    });
  }
};
textareaValidate();
var renderQuestions = function renderQuestions() {
  var candidatesPosition = document.querySelector('#candidates_position');
  if (candidatesPosition) {
    var itemsQuestions = document.querySelector('.add-candidate__item__questions');
    candidatesPosition.addEventListener('change', function (e) {
      localStorage.setItem('position', candidatesPosition.value);
      // const date = new Date;
      // date.setDate(date.getDate() + 30);
      // setCookie('position', candidatesPosition.value, {expires: date}, {path: '/glampings'}, false);
      renderQuestionsAjax(candidatesPosition.value, itemsQuestions, '');
    });
  }
};
renderQuestions();
var renderQuestionsGenerate = function renderQuestionsGenerate() {
  var generateQuestionsBtn = document.querySelector('#generate-questions');
  if (generateQuestionsBtn) {
    var itemsQuestions = document.querySelector('.questions__block-form__content-text');
    generateQuestionsBtn.addEventListener('click', function (e) {
      var candidatesPosition = document.querySelector('#candidates_position');
      var candidatesPositionSingle = document.querySelector('#position');
      var postId = document.querySelector('#post_id');
      var position = '';
      if (candidatesPosition) {
        position = candidatesPosition.value;
      } else if (candidatesPositionSingle) {
        position = candidatesPositionSingle.innerText;
      }
      renderQuestionsAjax(position, itemsQuestions, postId.value);
    });
  }
};
renderQuestionsGenerate();
function renderQuestionsAjax(position, items, postId) {
  jQuery(document).ready(function ($) {
    $.ajax({
      url: "/wp-admin/admin-ajax.php",
      method: 'post',
      data: {
        action: 'render_questions',
        position: position,
        postId: postId
      },
      success: function success(data) {
        //console.dir(data);
        items.innerHTML = data;
      },
      error: function error(jqXHR, text, _error3) {}
    });
  });
}

// jQuery
jQuery(document).ready(function ($) {
  var addCandidateSubmit = document.querySelector('#add-candidate-submit');
  var name = document.querySelector('#name');
  var email = document.querySelector('#email');
  var candidatesPosition = document.querySelector('#candidates-position');
  var level = document.querySelector('#level');
  var answer = document.querySelector('textarea#answer');
  var currentUser = document.querySelector('#current_user_id');
  var nonce = document.querySelector('#hello_nonce');
  var dashboardWarning = document.querySelector('.dashboard__warning');
  var form = document.querySelector('form#add-candidate');
  if (addCandidateSubmit) {
    addCandidateSubmit.addEventListener('click', function (e) {
      e.preventDefault();
      var questionsItems = document.querySelectorAll('.questions__block-form__content-text p.question-item');
      var questions = [];
      questionsItems.forEach(function (item, i) {
        questions[i] = item.innerText;
      });
      //const levelChecked = document.querySelector('input[name="level"]:checked')
      var level = document.querySelector('#level');
      //console.dir(questions);

      var formData = new FormData(form);
      formData.append('action', 'add_candidates');
      formData.append('author', currentUser.value);
      formData.append('questions', questions);
      formData.append('answer', answer.value);
      formData.append('nonce', nonce.value);
      $.ajax({
        url: "/wp-admin/admin-ajax.php",
        method: 'post',
        processData: false,
        contentType: false,
        data: formData,
        // data: {
        //     action: 'add_candidates',
        //     name: name.value,
        //     email: email.value,
        //     position: candidatesPosition.value,
        //     level: level.value,
        //     questions: questions,
        //     answer: answer.value,
        //     author: currentUser.value,
        //     nonce: nonce.value
        // },
        success: function success(data) {
          var data_json = JSON.parse(data);
          console.dir(data_json);
          var data_json = JSON.parse(data);
          if (data_json.class == 'errors') {
            dashboardWarning.innerHTML = '';
            if (data_json.empty_title) {
              name.style.border = '1px solid red';
            } else {
              name.style.border = '';
            }
            if (data_json.empty_email) {
              email.style.border = '1px solid red';
            } else {
              email.style.border = '';
            }
            if (data_json.email_error) {
              email.style.border = '1px solid red';
            } else {
              email.style.border = '';
            }
            if (data_json.empty_position) {
              candidatesPosition.parentElement.style.border = '1px solid red';
            } else {
              candidatesPosition.parentElement.style.border = '';
            }
            if (data_json.empty_level) {
              level.parentElement.style.border = '1px solid red';
            } else {
              level.parentElement.style.border = '';
            }
            addItem(data_json);
            setTimeout(function () {
              removeItem();
            }, 3000);
          } else {
            window.location.href = data_json.post_url;
          }
        },
        error: function error(jqXHR, text, _error4) {}
      });
    });
  }
  function contentItem(err) {
    var dashboardWarning = document.querySelector('.dashboard__warning');
    var i = 0;
    Object.entries(err).forEach(function (entry) {
      var _entry = _slicedToArray(entry, 2),
        key = _entry[0],
        value = _entry[1];
      if (key !== 'class') {
        setTimeout(function () {
          dashboardWarning.insertAdjacentHTML('beforeEnd', "<p class=\"dashboard__warning__item\">".concat(value, "</p>")), 500 * (i + 1);
        });
      }
      i++;
    });
  }
  function addItem(err) {
    var dashboardWarning = document.querySelector('.dashboard__warning');
    var i = 0;
    Object.entries(err).forEach(function (entry) {
      var _entry2 = _slicedToArray(entry, 2),
        key = _entry2[0],
        value = _entry2[1];
      if (key !== 'class') {
        dashboardWarning.insertAdjacentHTML('beforeEnd', "<p class=\"dashboard__warning__item\">".concat(value, "</p>"));
      }
      i++;
    });
  }
  function removeItem() {
    var dashboardWarning = document.querySelectorAll('.dashboard__warning__item');
    if (dashboardWarning.length > 0) {
      dashboardWarning.forEach(function (el, i) {
        return setTimeout(function () {
          return el.remove();
        }, 200 * (i + 1));
      });
    }
  }
});

/***/ }),

/***/ "./src/scss/main.scss":
/*!****************************!*\
  !*** ./src/scss/main.scss ***!
  \****************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ })

/******/ 	});
/************************************************************************/
/******/ 	// The module cache
/******/ 	var __webpack_module_cache__ = {};
/******/ 	
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/ 		// Check if module is in cache
/******/ 		var cachedModule = __webpack_module_cache__[moduleId];
/******/ 		if (cachedModule !== undefined) {
/******/ 			return cachedModule.exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = __webpack_module_cache__[moduleId] = {
/******/ 			// no module.id needed
/******/ 			// no module.loaded needed
/******/ 			exports: {}
/******/ 		};
/******/ 	
/******/ 		// Execute the module function
/******/ 		__webpack_modules__[moduleId](module, module.exports, __webpack_require__);
/******/ 	
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/ 	
/************************************************************************/
/******/ 	/* webpack/runtime/compat get default export */
/******/ 	!function() {
/******/ 		// getDefaultExport function for compatibility with non-harmony modules
/******/ 		__webpack_require__.n = function(module) {
/******/ 			var getter = module && module.__esModule ?
/******/ 				function() { return module['default']; } :
/******/ 				function() { return module; };
/******/ 			__webpack_require__.d(getter, { a: getter });
/******/ 			return getter;
/******/ 		};
/******/ 	}();
/******/ 	
/******/ 	/* webpack/runtime/define property getters */
/******/ 	!function() {
/******/ 		// define getter functions for harmony exports
/******/ 		__webpack_require__.d = function(exports, definition) {
/******/ 			for(var key in definition) {
/******/ 				if(__webpack_require__.o(definition, key) && !__webpack_require__.o(exports, key)) {
/******/ 					Object.defineProperty(exports, key, { enumerable: true, get: definition[key] });
/******/ 				}
/******/ 			}
/******/ 		};
/******/ 	}();
/******/ 	
/******/ 	/* webpack/runtime/hasOwnProperty shorthand */
/******/ 	!function() {
/******/ 		__webpack_require__.o = function(obj, prop) { return Object.prototype.hasOwnProperty.call(obj, prop); }
/******/ 	}();
/******/ 	
/******/ 	/* webpack/runtime/make namespace object */
/******/ 	!function() {
/******/ 		// define __esModule on exports
/******/ 		__webpack_require__.r = function(exports) {
/******/ 			if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 				Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 			}
/******/ 			Object.defineProperty(exports, '__esModule', { value: true });
/******/ 		};
/******/ 	}();
/******/ 	
/************************************************************************/
var __webpack_exports__ = {};
// This entry need to be wrapped in an IIFE because it need to be in strict mode.
!function() {
"use strict";
/*!********************!*\
  !*** ./src/app.js ***!
  \********************/
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _js_main_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./js/main.js */ "./src/js/main.js");
/* harmony import */ var _js_main_js__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_js_main_js__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _js_auth_reg_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./js/auth-reg.js */ "./src/js/auth-reg.js");
/* harmony import */ var _js_auth_reg_js__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(_js_auth_reg_js__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var _js_form_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./js/form.js */ "./src/js/form.js");
/* harmony import */ var _js_form_js__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(_js_form_js__WEBPACK_IMPORTED_MODULE_2__);
/* harmony import */ var _scss_main_scss__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! .//scss/main.scss */ "./src/scss/main.scss");



// import './js/add-rating.js';
// import './js/filtr-home.js';
// import './js/filtr-archive.js';
// import './js/main/tabs.js';
// import './js/main/nav.js';

// scss

}();
/******/ })()
;
//# sourceMappingURL=bundle.js.map