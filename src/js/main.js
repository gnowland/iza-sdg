import $ from 'jquery';
import app from './app';

document.addEventListener('DOMContentLoaded', () => {
  const myConst = 'test ES6 transpiling';
  app.init(); // testing custom module
  console.log($, myConst); // testing jQuery and transpiling
});
