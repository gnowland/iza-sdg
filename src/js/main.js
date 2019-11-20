//import $ from 'jquery';
import app from './app';
import smoothscroll from "smoothscroll-polyfill";

document.addEventListener('DOMContentLoaded', () => {
  smoothscroll.polyfill();
  app.init();
});
