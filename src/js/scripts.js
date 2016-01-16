(function ($, window, document, undefined) {

  'use strict';

// socket.io
var socket = new io();
  socket.connect('http://localhost:3000', {
  autoConnect: true
});

})(jQuery, window, document);
