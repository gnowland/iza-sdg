!function(t){function e(o){if(n[o])return n[o].exports;var i=n[o]={i:o,l:!1,exports:{}};return t[o].call(i.exports,i,i.exports,e),i.l=!0,i.exports}var n={};e.m=t,e.c=n,e.d=function(t,n,o){e.o(t,n)||Object.defineProperty(t,n,{configurable:!1,enumerable:!0,get:o})},e.n=function(t){var n=t&&t.__esModule?function(){return t.default}:function(){return t};return e.d(n,"a",n),n},e.o=function(t,e){return Object.prototype.hasOwnProperty.call(t,e)},e.p="",e(e.s=0)}([function(t,e,n){"use strict";var o=n(1),i=function(t){return t&&t.__esModule?t:{default:t}}(o);document.addEventListener("DOMContentLoaded",function(){i.default.init()})},function(t,e,n){"use strict";var o=function(){function t(t){for(var e=0;e<d.length;e++)d[e].classList.toggle("visible",e==t)}function e(e){u[e-1].classList.add("active"),t(e)}function n(t,n){for(var o=0;o<u.length;o++)u[o].classList.remove("active");for(var i=a.classList,r=i.length;r>0;r--)i.remove(i[0]);i.add("at-"+t),!0===n&&e(t)}function o(){n(1),t(0),setTimeout(function(){r.classList.remove("loading"),r.classList.add("loaded")},1e3);for(var e=0;e<u.length;e++)!function(t){var e=u[t],o=t+1;e.setAttribute("tabindex",0),e.setAttribute("focusable","true"),e.addEventListener("click",function(){n(o,!0)}),e.addEventListener("keyup",function(t){13===t.keyCode&&n(o,!0)})}(e)}function i(){setTimeout(function(){r.style.opacity=1,r.classList.add("loading"),s.style.opacity=1,o()},200)}var r=document.getElementById("iza-sdg-app"),s=document.getElementById("iza-sdg"),a=document.getElementById("sdgs"),u=a.getElementsByTagName("g"),c=document.getElementById("sdg-info"),d=c.getElementsByTagName("div");return{init:i}}();t.exports=o}]);