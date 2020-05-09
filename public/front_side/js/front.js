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

/***/ "./resources/js/front.js":
/*!*******************************!*\
  !*** ./resources/js/front.js ***!
  \*******************************/
/*! no static exports found */
/***/ (function(module, exports) {

function toggle_sidebar() {
  if (document.getElementById("mySidebar").style.width === "100%") {
    document.getElementById("mySidebar").style.width = "0";
  } else {
    document.getElementById("mySidebar").style.width = "100%";
  }
}

document.getElementById("openbtn").addEventListener("click", function () {
  toggle_sidebar();
});

if (document.getElementById("login_sidebar") !== null) {
  document.getElementById("login_sidebar").addEventListener("click", function () {
    toggle_sidebar();
  });
}

document.getElementById("closebtn").addEventListener("click", function () {
  toggle_sidebar();
});
$(document).on('click', '.add_to_cart', function (e) {
  var product_id = this.getAttribute('data-product-id');
  console.log(this);
  var cartItem = {
    id: product_id
  };
  var button = this;
  $.post("/cart", cartItem, function (data, status) {
    document.getElementById('carts-count').innerHTML = data.carts_count;
    document.getElementById('carts-button-count').innerHTML = data.carts_count;
    button.innerHTML = 'Щее!';
  });
});
var mybutton = document.getElementById("cart-button-dynamic");

window.onscroll = function () {
  scrollFunction();
};

function scrollFunction() {
  if (document.body.scrollTop > 100 || document.documentElement.scrollTop > 100) {
    if (mybutton !== null) {
      mybutton.style.opacity = '1';
      mybutton.style.display = 'block';
    }
  } else {
    if (mybutton !== null) {
      mybutton.style.opacity = '0';
      mybutton.style.display = 'none';
    }
  }
} // When the user clicks on the button, scroll to the top of the document


function topFunction() {
  document.body.scrollTop = 0;
  document.documentElement.scrollTop = 0;
}

$(document).on('click', '.cart-inc-dec', function (e) {
  var product_id = this.getAttribute('data-product-id');
  var button = document.getElementById('count-product-' + product_id);
  var count = parseInt(button.innerHTML);
  var route = null;
  var increase = 'increase';
  var decrease = 'decrease';

  if (this.classList.contains(increase)) {
    route = increase;
    count += 1;
  } else if (this.classList.contains(decrease)) {
    count -= 1;
    route = decrease;
  }

  var cartItem = {
    id: product_id
  };

  if (route !== null) {
    $.post("/cart/" + route, cartItem, function (data, status) {
      document.getElementById('carts-count').innerHTML = data.carts_count;

      if (data.carts_count <= 0) {
        document.getElementById('empty-cart').classList.remove('d-none');
        document.getElementById('full-cart').classList.add('d-none');
      }

      if (count <= 0) {
        var line = document.getElementById('cart-line-' + product_id);
        line.remove();
      }

      button.innerHTML = count;
    });
  }
});

/***/ }),

/***/ 2:
/*!*************************************!*\
  !*** multi ./resources/js/front.js ***!
  \*************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! /home/www/burger/app/resources/js/front.js */"./resources/js/front.js");


/***/ })

/******/ });