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
/******/ 	return __webpack_require__(__webpack_require__.s = 1);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/modoNocturnoDiurno.ts":
/*!********************************************!*\
  !*** ./resources/js/modoNocturnoDiurno.ts ***!
  \********************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";

/**
 * Html elements que contienen los links de los css diurno y nocturno
 */
var light = document.getElementById('light-css');
var dark = document.getElementById('dark-css');
// comprobar si existe o no la cookie, y poner su modo
if (checkCookie()) {
    ver(true);
}
else {
    setCookie('modo', 'nocturno', 7); // diurno o nocturno
    ver(true);
}
// listener del boton de cambiar el modo
try {
    // @ts-ignore
    document.getElementById('modo-nocturno-diurno').addEventListener('click', function () {
        ver(false);
        location.reload();
    });
}
catch (e) {
    //console.log('en login no hace falta');
}
function ver(opcional) {
    // cambiar el valor de la cookie a nocturno/diurno
    var c = getCookie('modo');
    if (c != null && c != "") {
        if (c === "diurno") {
            // cambiar link del css
            light.disabled = true;
            dark.disabled = false;
            if (!opcional) {
                setCookie('modo', 'nocturno', 7);
            }
        }
        else {
            light.disabled = false;
            dark.disabled = true;
            if (!opcional) {
                setCookie('modo', 'diurno', 7);
            }
        }
    }
}
/**
 * Crear la cookie
 * @param nombreCookie
 * @param valorCookie
 * @param diasDeVida
 */
function setCookie(nombreCookie, valorCookie, diasDeVida) {
    var d = new Date();
    d.setTime(d.getTime() + (diasDeVida * 24 * 60 * 60 * 1000));
    var expires = "expires=" + d.toUTCString();
    document.cookie = nombreCookie + "=" + valorCookie + ";" + expires + ";path=/";
}
/**
 * Devuelve un string
 * @param nombreCookie
 */
function getCookie(nombreCookie) {
    var name = nombreCookie + "=";
    var decodedCookie = decodeURIComponent(document.cookie);
    var ca = decodedCookie.split(';');
    for (var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}
/**
 * Comprueba si la cookie ya tiene valor o no
 * @return boolean
 */
function checkCookie() {
    var username = getCookie("modo");
    return username !== "";
}


/***/ }),

/***/ 1:
/*!**************************************************!*\
  !*** multi ./resources/js/modoNocturnoDiurno.ts ***!
  \**************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! /home/vagrant/code/CloudRoad/resources/js/modoNocturnoDiurno.ts */"./resources/js/modoNocturnoDiurno.ts");


/***/ })

/******/ });